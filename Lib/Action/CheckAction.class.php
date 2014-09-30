<?php
class CheckAction extends Action {

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
            echo '<a style="color:red">==============================================</a><br/>uid='.$uid.'<br/>';
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
                $where = "teamid=$teamid AND workdate1<='$tt' AND workdate2>='$tt'";
                //echo "where = $where";
                $worktime = $worktimeModel->where($where)->select();
                if(!$worktime) {
                    echo "no worktime set by the $tt";
                    return;
                }
                $worktime1 = $worktime[0]['worktime1'];
                $worktime2 = $worktime[0]['worktime2'];
                echo "tt=<a style=\"color:red\">$tt</a>  worktime1=$worktime1   worktime2=$worktime2 <br/>";

                if(strtotime($worktime1)<strtotime($worktime2)) {
                    /***************************************************正常考勤时段***************************************************/
                    echo '---正常考勤时段---<br/>';

                    //计算时间中间点
                    $worktime_mid = date('H:i:s',(strtotime($worktime2)-strtotime($worktime1))/2);

                    $worktime1_last2hour = date('H:i:s',(strtotime($worktime1) - 60*60*2));
                    $worktime2_next2hour = date('H:i:s',(strtotime($worktime2) + 60*60*2));
                    echo "worktime_mid=$worktime_mid <br/> worktime1_last2hour=$worktime1_last2hour <br/> worktime2_next2hour=$worktime2_next2hour <br/>";

                    //查询当天打卡信息
                    $Model = M('clocktime');
                    $where = "clockdate BETWEEN '$tt' AND '$tt' AND clocktime>='$worktime1_last2hour' AND clocktime<='$worktime2_next2hour' AND uid = '$uid'";
                    $rs = $Model->where($where)->order('clocktime')->select();
                    //echo $Model->getLastSql()."<br>";
                    echo '+++++++++++++++++++++++++++++++++++当天打卡信息++++++++++++++++++++++++++++++++++++++++<br/>';
                    print_r($rs);
                    echo '<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>';

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
                        echo $uid.':'."未打卡(上班)"."<br/>";
                        $row['static'] = '未打卡(上班)';
                        $row['vacid'] = 0;
                        $row['clocktime'] = "00:00:00";
                        $unusualModel->add($row);
                    } elseif (strtotime($rs[0]['clocktime'])>strtotime($worktime1)+10*60) {
                        //迟到
                        echo $uid.':'.$rs[0]['clocktime'].">".$worktime1;
                        echo "迟到"."<br/>";
                        $row['static'] = '迟到';
                        $unusualModel->add($row);
                    } else {
                        //正常
                        echo $uid.':'.$rs[0]['clocktime']."<".$worktime1."正常<br/>";
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
                        echo $uid.':'."未打卡(下班)"."<br/>";
                        $row['static'] = '未打卡(下班)';
                        $row['vacid'] = 0;
                        $row['clocktime'] = "00:00:00";
                        $unusualModel->add($row);
                    } elseif (strtotime($rs[$k]['clocktime'])<strtotime($worktime2)) {
                        //早退
                        echo $uid.':'.$rs[$k]['clocktime']."<".$worktime2;
                        echo "早退"."<br/>";
                        $row['static'] = '早退';
                        $unusualModel->add($row);
                    } else {
                        //正常
                        echo $uid.':'.$rs[$k]['clocktime'].">".$worktime2."正常<br/>";
                        $row['static'] = '正常';
                        $unusualModel->add($row);
                    }
                } else {
                    /***************************************************跨天考勤时段***************************************************/
                    echo '---跨天考勤时段---<br/>';
                    //计算时间中间点
                    $worktime_mid = date('H:i:s',(strtotime($worktime2)+60*60*24+strtotime($worktime1))/2);

                    $worktime1_last2hour = date('H:i:s',(strtotime($worktime1) - 60*60*2));
                    $worktime2_next2hour = date('H:i:s',(strtotime($worktime2) + 60*60*2));
                    echo "worktime_mid=$worktime_mid <br/> worktime1_last2hour=$worktime1_last2hour  <br/> worktime2_next2hour=$worktime2_next2hour <br/>";
                    
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
                    echo '+++++++++++++++++++++++++++++++++++上班打卡信息++++++++++++++++++++++++++++++++++++++++<br/>';
                    print_r($rs);
                    echo '<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>';

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
                            echo $uid.':'.$rs[0]['clocktime']."<".$worktime1."正常<br/>";
                            $row['static'] = '正常';
                            $unusualModel->add($row);
                        } else {
                            //迟到
                            echo $uid.':'.$rs[0]['clocktime'].">".$worktime1;
                            echo "迟到"."<br/>";
                            $row['static'] = '迟到';
                            $unusualModel->add($row);
                        }
                    } else {
                        //未打卡
                        echo $uid.':'."未打卡(上班)"."<br/>";
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
                    
                    echo '+++++++++++++++++++++++++++++++++++下班打卡信息++++++++++++++++++++++++++++++++++++++++<br/>';
                    print_r($rs);
                    echo '<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>';

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
                            echo $uid.':'.$_clockdatetime.">=".$_workdatetime2."正常<br/>";
                            $row['static'] = '正常';
                            $row['clockdate'] = $rs[$k]['clockdate'];
                            $unusualModel->add($row);
                        } else {
                            //迟到
                            echo $uid.':'.$_clockdatetime."<".$_workdatetime2;
                            echo "早退"."<br/>";
                            $row['static'] = '早退';
                            $row['clockdate'] = $rs[$k]['clockdate'];
                            $unusualModel->add($row);
                        }
                    } else {
                        //未打卡
                        echo $uid.':'."未打卡(下班)"."<br/>";
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
    	echo 'ok';
    }

    //休假、出差条检测
    public function checkVacation($start,$end,$uid) {
    	$vacModel = M('vacationstatus');
    	//查询所有请假条
    	$vacList = $vacModel->where("uid='$uid' AND isapproved=1 AND transtype IN (2,3) AND begindate BETWEEN '$start' AND '$end' ")->order('applytime')->select();
    	//print_r($vacList);
    	for($i=0;$i<count($vacList);$i++) {
    		$unusModel = M('unusualtime');
    		//查询请假时段异常记录
    		$beginDatetime = $vacList[$i]['begindate'].' '.$vacList[$i]['begintime'];
    		$endDatetime = $vacList[$i]['enddate'].' '.$vacList[$i]['endtime'];
    		$unsuList = $unusModel->where("uid='$uid' AND static<>'正常' AND CONCAT(clockdate,' ',standardtime) BETWEEN '$beginDatetime' AND '$endDatetime'")->select();
    		//echo $unusModel->getLastSql();
    		//print_r($unsuList);
    		for($j=0;$j<count($unsuList);$j++) {
    			$unsuList[$j]['static'] = '正常';
    			if($vacList[$i]['transtype']==3) {
    				$unsuList[$j]['ps'] = '休假';
    			} else {
    				$unsuList[$j]['ps'] = '出差';
    			}
    			$unsuList[$j]['vacid'] = $vacList[$i]['id'];
    			$rs = $unusModel->save($unsuList[$j]);
    			//print_r($unsuList[$j]);
    			if(!$rs) {
    				echo 'error';
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
    	$vacModel = M('vacationstatus');
    	//查询所有请假条
    	$vacList = $vacModel->where("uid='$uid' AND isapproved=1 AND transtype=1 AND begindate BETWEEN '$start' AND '$end' ")->order('applytime')->select();
    	//print_r($vacList);
    	for($i=0;$i<count($vacList);$i++) {

            $_vacBegindate = $vacList[$i]['begindate'];
            $_vacBegintime = $vacList[$i]['begintime'];
            $_vacEnddate = $vacList[$i]['enddate'];
            $_vacEndtime = $vacList[$i]['endtime'];

    		$unusModel = M('unusualtime');
    		//查询请假时段异常记录
    		$beginDatetime = $vacList[$i]['begindate'].' '.$vacList[$i]['begintime'];
    		$endDatetime = $vacList[$i]['enddate'].' '.$vacList[$i]['endtime'];
    		$unsuList = $unusModel
            ->where("type=1 AND uid='$uid' AND CONCAT(clockdate,' ',standardtime) BETWEEN '$beginDatetime' AND '$endDatetime'")
            ->order('clockdate,clocktime')->select();
    		echo "============================考勤记录======================<br/>";
            print_r($unsuList);
            echo "<br/>===========================================================<br/>";
    		for($j=0;$j<count($unsuList);$j++) {
                /*
    			$unsuList[$j]['vacid'] = $vacList[$i]['id'];
    			//判断该条是上午 or 下午
    			if(strtotime($unsuList[$j]['standardtime'])<strtotime('12:00:00')) {
    				//如果是上午
    				//更改standardtime
    				$unsuList[$j]['standardtime'] = $vacList[$i]['begintime'];
    				if(strtotime($unsuList[$j]['clocktime'])>strtotime($vacList[$i]['begintime'])) {
    					//迟到
    					$unsuList[$j]['static'] = '迟到';
    					$unsuList[$j]['ps'] = '加班';
    				} else {
    					$unsuList[$j]['static'] = '正常';
    					$unsuList[$j]['ps'] = '加班';
    				}
    			} else {
    				//如果是下午
    				//更改standardtime
    				$unsuList[$j]['standardtime'] = $vacList[$i]['endtime'];
    				if(strtotime($unsuList[$j]['clocktime'])<strtotime($vacList[$i]['endtime'])) {
    					//迟到
    					$unsuList[$j]['static'] = '早退';
    					$unsuList[$j]['ps'] = '加班';
    				} else {
    					$unsuList[$j]['static'] = '正常';
    					$unsuList[$j]['ps'] = '加班';
    				}
    			}
                */
                $cl_startDatetime = $unsuList[$j]['clockdate'].' '.$_vacEndtime;
                $cl_endDatetime = date('Y-m-d H:i:s',(strtotime($cl_startDatetime)+60*60));
                //在clocktime表里查询新下班打卡时间段
                $clockModel = M('clocktime');
                $rs = $clockModel
                ->where("uid='$uid' AND CONCAT(clockdate,' ',clocktime) BETWEEN '$cl_startDatetime' AND '$cl_endDatetime'")
                ->order('clockdate,clocktime')
                ->select();
                echo "============================打卡记录======================<br/>";
                echo "SQL:".$clockModel->getLastSql()."<br/>";
                print_r($rs);
                echo "<br/>===========================================================<br/>";
                if(!$rs) {
                    $unsuList[$j]['static'] = '早退';
                    $unsuList[$j]['ps'] = '加班';
                } else {
                    $k = count($rs) - 1;
                    $unsuList[$j]['clocktime'] = $rs[$k]['clocktime'];
                    $unsuList[$j]['static'] = '正常';
                    $unsuList[$j]['ps'] = '加班';
                }
                $unsuList[$j]['standardtime'] = $vacList[$i]['endtime'];
    			$rs = $unusModel->save($unsuList[$j]);
    			//print_r($unsuList[$j]);
    			if(!$rs) {
    				echo 'error';
	    		}
    		}
    		
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