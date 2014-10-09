<?php

class CheckAction extends Action {
    //调试输出
    //private $wingsDebug = 1;

	//打卡检测
    public function checkClock($start,$end) {
		//$start_time = $this->_get('start_time').' 00:00:00';
		//$end_time = $this->_get('end_time').' 00:00:00';
		if(count($start)<1 || count($end)<1) {
			return;
		}
		$start_time = $start.' 00:00:00';
		$end_time = $end.' 00:00:00';
		
		$time1 = strtotime($start_time);
		$time2 = strtotime($end_time);
		$day = ($time2-$time1)/86400;
		//删除该时段记录
		$unusualModel = M('unusualtime');
		$unusualModel->where("clockdate BETWEEN '$start' AND '$end'")->delete();
		//echo $unusualModel->getLastSql();

		//获取所有员工UID
		$Model = M('staffinfo');
		$uids = $Model->field('uid,teamid')->select();
		//每一个UID
		for ($i=0; $i < count($uids); $i++) { 
			$uid = $uids[$i]['uid'];
			$teamid = $uids[$i]['teamid'];
            if(isset($this->wingsDebug)) {
                echo '<a style="color:red">==============================================</a><br/>uid='.$uid.'<br/>';
            }
            $worktimeModel = M('worktime');
			//每一天
			for ($j=0; $j <= $day; $j++) { 
				$tt = date("Y-m-d",$time1 + 86400 * $j);
                //排除周末
                /*
                //echo $tt."星期：".date('w',strtotime($tt.' 12:00:00'))."<br/>";
                if(date('w',strtotime($tt.' 12:00:00'))==6 || date('w',strtotime($tt.' 12:00:00'))==0) {
                    continue;
                }
                */
                
                //查询排班时间
                $where = "(teamid=$teamid OR uid='$uid') AND workdate1<='$tt' AND workdate2>='$tt'";
                //echo "where = $where";
                //查询当天排班情况，如果uid字段有值，则取该条。
                $worktime = $worktimeModel
                ->where($where)
                ->order("uid desc")
                ->select();
                if(!$worktime) {
                    if(isset($this->wingsDebug)) {
                        echo "uid=$uid has no worktime set by the $tt<br/>";
                    }
                    continue;
                }
                $worktime1 = $worktime[0]['worktime1'];
                $worktime2 = $worktime[0]['worktime2'];
                if(isset($this->wingsDebug)) {
                    echo "tt=<a style=\"color:red\">$tt</a>  worktime1=$worktime1   worktime2=$worktime2 <br/>";
                }

                if(strtotime($worktime1)<strtotime($worktime2)) {
                    /***************************************************正常考勤时段***************************************************/
                    if(isset($this->wingsDebug)) {
                        echo '---正常考勤时段---<br/>';
                    }
                    //计算时间中间点
                    $worktime_mid = date('H:i:s',(strtotime($worktime2)-strtotime($worktime1))/2);

                    $worktime1_last2hour = date('H:i:s',(strtotime($worktime1) - 60*60*2));
                    $worktime2_next2hour = date('H:i:s',(strtotime($worktime2) + 60*60*2));
                    if(isset($this->wingsDebug)) {
                        echo "worktime_mid=$worktime_mid <br/> worktime1_last2hour=$worktime1_last2hour <br/> worktime2_next2hour=$worktime2_next2hour <br/>";
                    }
                    //查询当天打卡信息
                    $Model = M('clocktime');
                    $where = "clockdate BETWEEN '$tt' AND '$tt' AND clocktime>='$worktime1_last2hour' AND clocktime<='$worktime2_next2hour' AND uid = '$uid'";
                    $rs = $Model->where($where)->order('clocktime')->select();
                    //echo $Model->getLastSql()."<br>";
                    if(isset($this->wingsDebug)) {
                        echo '+++++++++++++++++++++++++++++++++++当天打卡信息++++++++++++++++++++++++++++++++++++++++<br/>';
                        print_r($rs);
                        echo '<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>';
                    }
                    $row['type'] = 0;
                    $row['vacid'] = $rs[0]['id'];
                    $row['uid'] = $uid;
                    $row['clockdate'] = $tt;
                    $row['clocktime'] = $rs[0]['clocktime'];
                    $row['standarddate'] = $tt;
                    $row['standardtime'] = $worktime1;

                    //如果表中含有相同记录
                    //$rs = $unusualModel->where("clockdate BETWEEN '$tt' AND '$tt' AND uid = '$uid'")->delete();

                    //上班考勤
                    if (!$rs || $rs[0]<=0 || strtotime($rs[0]['clocktime'])>strtotime($worktime_mid)) {
                        //未打卡
                        if(isset($this->wingsDebug)) {
                            echo $uid.':'."未打卡(上班)"."<br/>";
                        }
                        $row['static'] = '未打卡(上班)';
                        $row['vacid'] = 0;
                        $row['clocktime'] = "00:00:00";
                        $unusualModel->add($row);
                    } elseif (strtotime($rs[0]['clocktime'])>strtotime($worktime1)+10*60) {
                        //迟到
                        if(isset($this->wingsDebug)) {
                            echo $uid.':'.$rs[0]['clocktime'].">".$worktime1;
                            echo "迟到"."<br/>";
                        }
                        $row['static'] = '迟到';
                        $unusualModel->add($row);
                    } else {
                        //正常
                        if(isset($this->wingsDebug)) {
                            echo $uid.':'.$rs[0]['clocktime']."<".$worktime1."正常<br/>";
                        }
                        $row['static'] = '正常';
                        $unusualModel->add($row);
                    }

                    //最后打卡时间
                    $k = count($rs)-1;
                    $row['type'] = 1;
                    $row['vacid'] = $rs[$k]['id'];
                    $row['clocktime'] = $rs[$k]['clocktime'];
                    $row['standardtime'] = $worktime2;
                    //下班考勤
                    if (!$rs || $rs[$k]<=0 || strtotime($rs[$k]['clocktime'])<strtotime($worktime_mid)) {
                        //未打卡
                        if(isset($this->wingsDebug)) {
                            echo $uid.':'."未打卡(下班)"."<br/>";
                        }
                        $row['static'] = '未打卡(下班)';
                        $row['vacid'] = 0;
                        $row['clocktime'] = "00:00:00";
                        $unusualModel->add($row);
                    } elseif (strtotime($rs[$k]['clocktime'])<strtotime($worktime2)) {
                        //早退
                        if(isset($this->wingsDebug)) {
                            echo $uid.':'.$rs[$k]['clocktime']."<".$worktime2;
                            echo "早退"."<br/>";
                        }
                        $row['static'] = '早退';
                        $unusualModel->add($row);
                    } else {
                        //正常
                        if(isset($this->wingsDebug)) {
                            echo $uid.':'.$rs[$k]['clocktime'].">".$worktime2."正常<br/>";
                        }
                        $row['static'] = '正常';
                        $unusualModel->add($row);
                    }
                } else {
                    /***************************************************跨天考勤时段***************************************************/
                    if(isset($this->wingsDebug)) {
                        echo '---跨天考勤时段---<br/>';
                    }
                    //计算时间中间点
                    $worktime_mid = date('H:i:s',(strtotime($worktime2)+60*60*24+strtotime($worktime1))/2);

                    $worktime1_last2hour = date('H:i:s',(strtotime($worktime1) - 60*60*2));
                    $worktime2_next2hour = date('H:i:s',(strtotime($worktime2) + 60*60*2));
                    if(isset($this->wingsDebug)) {
                        echo "worktime_mid=$worktime_mid <br/> worktime1_last2hour=$worktime1_last2hour  <br/> worktime2_next2hour=$worktime2_next2hour <br/>";
                    }
                    //上班考勤
                    if(strtotime($worktime_mid)>strtotime($worktime1)) {
                        //中间时间在第一天
                        $_endtime = $worktime_mid;
                    } else {
                        //中间时间在第二天
                        $_endtime = '23:59:59';
                    }
                    $Model = M('clocktime');
                    $rs = $Model
                    ->where("clockdate BETWEEN '$tt' AND '$tt' AND clocktime BETWEEN '$worktime1_last2hour' AND '$_endtime' AND uid='$uid'")
                    ->order('clocktime')
                    ->select();
                    if(isset($this->wingsDebug)) {
                        echo '+++++++++++++++++++++++++++++++++++上班打卡信息++++++++++++++++++++++++++++++++++++++++<br/>';
                        print_r($rs);
                        echo '<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>';
                    }
                    $row['type'] = 0;
                    $row['vacid'] = $rs[0]['id'];
                    $row['uid'] = $uid;
                    $row['clockdate'] = $tt;
                    $row['clocktime'] = $rs[0]['clocktime'];
                    $row['standarddate'] = $tt;
                    $row['standardtime'] = $worktime1;

                    if($rs) {
                        if(strtotime($rs[0]['clocktime'])<=strtotime($worktime1)+60*10) {
                            //正常
                            if(isset($this->wingsDebug)) {
                                echo $uid.':'.$rs[0]['clocktime']."<".$worktime1."正常<br/>";
                            }
                            $row['static'] = '正常';
                            $unusualModel->add($row);
                        } else {
                            //迟到
                            if(isset($this->wingsDebug)) {
                                echo $uid.':'.$rs[0]['clocktime'].">".$worktime1;
                                echo "迟到"."<br/>";
                            }
                            $row['static'] = '迟到';
                            $unusualModel->add($row);
                        }
                    } else {
                        //未打卡
                        if(isset($this->wingsDebug)) {
                            echo $uid.':'."未打卡(上班)"."<br/>";
                        }
                        $row['static'] = '未打卡(上班)';
                        $row['vacid'] = 0;
                        $row['clocktime'] = "00:00:00";
                        $unusualModel->add($row);
                    }

                    //下班考勤
                    $tt_nextday = date('Y-m-d',strtotime($tt)+60*60*24);
                    if(strtotime($worktime_mid)>strtotime($worktime1)) {
                        //中间时间在第一天
                        $Model = M('clocktime');
                        $rs = $Model
                        ->where("clockdate BETWEEN '$tt' AND '$tt' AND clocktime BETWEEN '$worktime_mid' AND '23:59:59' AND uid='$uid'")
                        ->union("SELECT * FROM op_clocktime WHERE clockdate BETWEEN '$tt_nextday' AND '$tt_nextday' AND clocktime BETWEEN '00:00:00' AND '$worktime2_next2hour' AND uid='$uid'")
                        //->order('clockdate,clocktime')
                        ->select();
                        //echo $Model->getLastSql();
                    } else {
                        //中间时间在第二天
                        $Model = M('clocktime');
                        $rs = $Model
                        ->where("clockdate BETWEEN '$tt_nextday' AND '$tt_nextday' AND clocktime BETWEEN '$worktime_mid' AND '$worktime2_next2hour'")
                        ->order('clockdate,clocktime')
                        ->select();
                    }
                    if(isset($this->wingsDebug)) {
                        echo '+++++++++++++++++++++++++++++++++++下班打卡信息++++++++++++++++++++++++++++++++++++++++<br/>';
                        print_r($rs);
                        echo '<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>';
                    }
                    $k = count($rs) - 1;
                    $row['type'] = 1;
                    $row['vacid'] = $rs[$k]['id'];
                    $row['clocktime'] = $rs[$k]['clocktime'];
                    $row['standardtime'] = $worktime2;

                    $_clockdatetime = $rs[$k]['clockdate'].' '.$rs[$k]['clocktime'];
                    $_workdatetime2 = $tt_nextday.' '.$worktime2;
                    if($rs) {
                        if(strtotime($_clockdatetime)>=strtotime($_workdatetime2)) {
                            //正常
                            if(isset($this->wingsDebug)) {
                                echo $uid.':'.$_clockdatetime.">=".$_workdatetime2."正常<br/>";
                            }
                            $row['static'] = '正常';
                            $row['clockdate'] = $rs[$k]['clockdate'];
                            $unusualModel->add($row);
                        } else {
                            //迟到
                            if(isset($this->wingsDebug)) {
                                echo $uid.':'.$_clockdatetime."<".$_workdatetime2;
                                echo "早退"."<br/>";
                            }
                            $row['static'] = '早退';
                            $row['clockdate'] = $rs[$k]['clockdate'];
                            $unusualModel->add($row);
                        }
                    } else {
                        //未打卡
                        if(isset($this->wingsDebug)) {
                            echo $uid.':'."未打卡(下班)"."<br/>";
                        }
                        $row['static'] = '未打卡(下班)';
                        $row['vacid'] = 0;
                        $row['clockdate'] = $tt_nextday;
                        $row['clocktime'] = "00:00:00";
                        $unusualModel->add($row);
                    }
                }
			}
            $this->checkOverwork($start,$end,$uid);
		}
    }

    public function doCheck() {
    	$start = $this->_get('start');
    	$end = $this->_get('end');
    	R('Check/checkClock',array($start,$end));
        if(isset($this->wingsDebug)) {
    	   echo 'ok';
        }
    }

    //休假、出差条检测
    public function checkVacation($start,$end,$uid) {
    	$vacModel = M('vacationstatus');
    	//查询所有请假条
    	$vacList = $vacModel
        ->where("uid='$uid' AND isapproved=1 AND transtype IN (2,3) AND (
            (begindate >= '$start' AND begindate <= '$end' AND enddate >= '$end') OR 
            (enddate <= '$end' AND begindate <= '$start' AND enddate >= '$start') OR
            (begindate >= '$start' AND enddate <= '$end') OR
            (begindate <= '$start' AND enddate >= '$start' AND begindate <= '$end' AND enddate >= '$end')
            )")
        ->order('applytime')
        ->select();
    	//print_r($vacList);
    	for($i=0;$i<count($vacList);$i++) {
    		$unusualModel = M('unusualtime');
    		//查询请假时段异常记录
    		$beginDatetime = $vacList[$i]['begindate'].' '.$vacList[$i]['begintime'];
    		$endDatetime = $vacList[$i]['enddate'].' '.$vacList[$i]['endtime'];
    		$unsuList = $unusualModel->where("uid='$uid' AND static<>'正常' AND CONCAT(clockdate,' ',standardtime) BETWEEN '$beginDatetime' AND '$endDatetime'")->select();
    		//echo $unusualModel->getLastSql();
    		//print_r($unsuList);
    		for($j=0;$j<count($unsuList);$j++) {
    			$unsuList[$j]['static'] = '正常';
    			if($vacList[$i]['transtype']==3) {
    				$unsuList[$j]['ps'] = '休假';
    			} else {
    				$unsuList[$j]['ps'] = '出差';
    			}
    			$unsuList[$j]['vacid'] = $vacList[$i]['id'];
    			$rs = $unusualModel->save($unsuList[$j]);
    			//print_r($unsuList[$j]);
    			if(!$rs) {
                    if(isset($this->wingsDebug)) {
    				    echo 'error';
                    }
	    		}
    		}
    		
    	}

    }

    public function doCheckVacation() {
    	$start = $this->_get('start');
    	$end = $this->_get('end');
    	$uid = $this->_get('uid');
    	R('Check/checkVacation',array($start,$end,$uid));
    	//echo 'ok';
    }
   
   //加班条检测
    public function checkOverwork($start,$end,$uid) {
        if(isset($this->wingsDebug)) {
            echo '<span style="color:orange">加班条检测开始</span><br/>';
        }
    	$vacModel = M('vacationstatus');
    	//查询所有加班条
    	$vacList = $vacModel
        //->where("uid='$uid' AND isapproved=1 AND transtype=1 AND begindate BETWEEN '$start' AND '$end' ")
        ->where("uid='$uid' AND isapproved=1 AND transtype=1 AND (
            (begindate >= '$start' AND begindate <= '$end' AND enddate >= '$end') OR 
            (enddate <= '$end' AND begindate <= '$start' AND enddate >= '$start') OR
            (begindate >= '$start' AND enddate <= '$end') OR
            (begindate <= '$start' AND enddate >= '$start' AND begindate <= '$end' AND enddate >= '$end')
            )")
        ->order('applytime')
        ->select();
        //echo $vacModel->getLastSql()."<br/>";
    	//print_r($vacList);
    	for($i=0;$i<count($vacList);$i++) {

            $_vacBegindate = $vacList[$i]['begindate'];
            $_vacBegintime = $vacList[$i]['begintime'];
            $_vacEnddate = $vacList[$i]['enddate'];
            $_vacEndtime = $vacList[$i]['endtime'];
            if(isset($this->wingsDebug)) {
                echo "加班开始时间:$_vacBegindate $_vacBegintime<br/>";
                echo "加班结束时间:$_vacEnddate $_vacEndtime<br/>";
            }
    		$unusualModel = M('unusualtime');
            if($vacList[$i]['flag']!=1) {
                //正常加班申请的情况
                //查询加班时段异常记录
                $unsualList = $unusualModel
                ->where("uid='$uid' AND type=1 AND clockdate BETWEEN '$_vacBegindate' AND '$_vacEnddate'")
                ->order("clockdate,standardtime")
                ->select();
                if(isset($this->wingsDebug)) {
                    echo "============================考勤记录======================<br/>";
                    print_r($unsualList);
                    echo "<br/>===========================================================<br/>";
                }
                for($j=0;$j<count($unsualList);$j++) {
                    
                    $cl_startDatetime = $unsualList[$j]['clockdate'].' '.$_vacEndtime;
                    $cl_endDatetime = date('Y-m-d H:i:s',(strtotime($cl_startDatetime)+60*60*2));
                    //在clocktime表里查询新下班打卡时间段
                    $clockModel = M('clocktime');
                    $rs = $clockModel
                    ->where("uid='$uid' AND CONCAT(clockdate,' ',clocktime) BETWEEN '$cl_startDatetime' AND '$cl_endDatetime'")
                    ->order('clockdate,clocktime')
                    ->select();
                    if(isset($this->wingsDebug)) {
                        echo "============================打卡记录======================<br/>";
                        //echo "SQL:".$clockModel->getLastSql()."<br/>";
                        print_r($rs);
                        echo "<br/>===========================================================<br/>";
                    }
                    if(!$rs) {
                        $unsualList[$j]['static'] = '早退';
                        $unsualList[$j]['ps'] = '加班';
                    } else {
                        $k = count($rs) - 1;
                        $unsualList[$j]['clocktime'] = $rs[$k]['clocktime'];
                        $unsualList[$j]['static'] = '正常';
                        $unsualList[$j]['ps'] = '加班';
                    }
                    $unsualList[$j]['standardtime'] = $vacList[$i]['endtime'];
                    $unsualList[$j]['vacid'] = $vacList[$i]['id'];
                    //计算加班小时
                    $setupDatetime = $_vacBegindate.' '.$_vacBegintime;
                    $setdownDatetime = $_vacEnddate.' '.$_vacEndtime;
                    $setdownDatetime_real = $unsualList[$j]['clockdate'].' '.$unsualList[$j]['clocktime'];
                    //如果实际下班时间比标准下班时间小，则计算为实际下班时间
                    if(strtotime($setdownDatetime_real) < strtotime($setdownDatetime)) {
                        $setdownDatetime = $setdownDatetime_real;
                    }
                    $timestamp = strtotime($setdownDatetime) - strtotime($setupDatetime);
                    $days = ceil(($timestamp/3600)*10)/10;
                    if(isset($this->wingsDebug)) {
                        echo "加班开始：$setupDatetime 加班结束：$setdownDatetime 小时：$days<br/>";
                    }
                    
                    $staffModel = M('staffinfo');
                    $row = $staffModel->getByUid($uid);
                    if($row['teamid']=1) {
                        //如果为办公室则加入调休
                        $row['TRest'] += $days;
                        $rs = $staffModel->save($row);
                    } else {
                        //如果为产线则存为days
                        $vacList[$i]['days'] = $days;
                        $rs = $vacModel->save($vacList[$i]);
                    }
                    if(!$rs) {
                        if(isset($this->wingsDebug)) {
                            echo 'days save error<br/>';
                        }
                    }
                    //储存unusual
                    $rs = $unusualModel->save($unsualList[$j]);
                    if(!$rs) {
                        if(isset($this->wingsDebug)) {
                            echo 'unusual save error<br/>';
                        }
                    }
                }
            } else {
                //跨天加班申请的情况
                //查询加班时段异常记录
                $beginDatetime = $_vacBegindate.' '.$_vacBegintime;
                $endDatetime = $_vacEnddate.' '.$_vacEndtime;
                $unsualList = $unusualModel
                ->where("uid='$uid' AND clockdate BETWEEN '$_vacBegindate' AND '$_vacEnddate'")
                ->order("clockdate,standardtime")
                ->select();
                if(isset($this->wingsDebug)) {
                    echo "============================考勤记录======================<br/>";
                    print_r($unsualList);
                    echo "<br/>===========================================================<br/>";
                }
                $days = 0;
                for($j=0;$j<count($unsualList);$j+=2) {
                    $setup = $j;
                    $setdown = $j+1;
                    //更新unsual为加班类型
                    $unsualList[$setup]['ps'] = "加班";
                    $unsualList[$setup]['vacid'] = $vacList[$i]['id'];
                    $unsualList[$setdown]['ps'] = "加班";
                    $unsualList[$setdown]['vacid'] = $vacList[$i]['id'];
                    //计算加班小时
                    $setupDatetime = $unsualList[$setup]['clockdate'].' '.$unsualList[$setup]['clocktime'];
                    $setdownDatetime = $unsualList[$setdown]['clockdate'].' '.$unsualList[$setdown]['standardtime'];
                    $setdownDatetime_real = $unsualList[$setdown]['clockdate'].' '.$unsualList[$setdown]['clocktime'];
                    //如果实际下班时间比标准下班时间小，则计算为实际下班时间
                    if(strtotime($setdownDatetime_real) < strtotime($setdownDatetime)) {
                        $setdownDatetime = $setdownDatetime_real;
                    }
                    $timestamp = strtotime($setdownDatetime) - strtotime($setupDatetime);
                    $dd = ceil(($timestamp/3600)*10)/10;
                    $days += $dd;
                    if(isset($this->wingsDebug)) {
                        echo "加班开始：$setupDatetime 加班结束：$setdownDatetime 小时：$dd<br/>";
                    }
                    //储存unusual
                    $rs = $unusualModel->save($unsualList[$setup]);
                    if(!$rs) {
                        if(isset($this->wingsDebug)) {
                            echo 'sestup unusual save error<br/>';
                        }
                    }
                    $rs = $unusualModel->save($unsualList[$setdown]);
                    if(!$rs) {
                        if(isset($this->wingsDebug)) {
                            echo 'setdown unusual save error<br/>';
                        }
                    }
                }
                //修正加班小时数
                $days -= 0.5;
                //储存调休
                $staffModel = M('staffinfo');
                $row = $staffModel->getByUid($uid);
                $row['TRest'] += $days;
                $rs = $staffModel->save($row);
                if(!$rs) {
                    if(isset($this->wingsDebug)) {
                        echo 'days save error<br/>';
                    }
                }
            }
    		
    	}
        if(isset($this->wingsDebug)) {
            echo '<span style="color:orange">==================================</span><br/>';
        }
    }

    public function doCheckOverwork() {
    	$start = $this->_get('start');
    	$end = $this->_get('end');
    	$uid = $this->_get('uid');
    	R('Check/checkOverwork',array($start,$end,$uid));
    	//echo 'ok';
    }

    public function doCheckAll() {
        $start = $this->_get('start');
        $end = $this->_get('end');
        $staffModel = M('staffinfo');
        $staffList = $staffModel->field('uid')->select();
        for($i=0;$i<count($staffList);$i++) {
            R('Check/checkOverwork',array($start,$end,$staffList[$i]['uid']));
            R('Check/checkVacation',array($start,$end,$staffList[$i]['uid']));
        }
    }
}

?>