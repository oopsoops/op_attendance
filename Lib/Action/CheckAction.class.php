<?php

define('ATIME',60*60*4);        //打卡有效时间
define('STIME',60*5);           //缓冲时间

class CheckAction extends Action {
    //调试输出
    private $wingsDebug = 1;
    private $LOG_DIR = './log/';
    private $fpLog = null;

    //打卡检测
    public function checkClock($start,$end) {
        set_time_limit(0);
        if(isset($this->wingsDebug)) {
            //日志
            $this->initLog();
        }
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
        $unusualModel = M('unusualtime');
        /*
        //删除该时段记录
        
        $unusualModel->where("standarddate BETWEEN '$start' AND '$end'")->delete();
        //$this->logToFile($unusualModel->getLastSql());;
        */
        //获取所有员工UID
        $Model = M('staffinfo');
        $uids = $Model->field('uid,teamid')->select();
        //每一个UID
        for ($i=0; $i < count($uids); $i++) { 
            $uid = $uids[$i]['uid'];
            $teamid = $uids[$i]['teamid'];
            if(isset($this->wingsDebug)) {
                $this->logToFile('<a style="color:red">==============================================</a><br/>uid='.$uid.'<br/>');
            }
            $worktimeModel = M('worktime');
            //每一天
            for ($j=0; $j <= $day; $j++) { 
                $tt = date("Y-m-d",$time1 + 86400 * $j);
                //排除周末
                /*
                //$this->logToFile($tt."星期：".date('w',strtotime($tt.' 12:00:00'))."<br/>");
                if(date('w',strtotime($tt.' 12:00:00'))==6 || date('w',strtotime($tt.' 12:00:00'))==0) {
                    continue;
                }
                */
                
                //查询排班时间
                $where = "(uid='$uid' OR (teamid=$teamid AND uid IS NULL)) AND workdate1<='$tt' AND workdate2>='$tt'";
                //$this->logToFile("where = $where");
                //查询当天排班情况，如果uid字段有值，则取该条。
                $worktime = $worktimeModel
                ->where($where)
                ->order("uid desc")
                ->select();
                if(!$worktime) {
                    if(isset($this->wingsDebug)) {
                        $this->logToFile("uid=$uid has no worktime set by the $tt<br/>");
                    }
                    continue;
                }
                $worktime1 = $worktime[0]['worktime1'];
                $worktime2 = $worktime[0]['worktime2'];
                if(isset($this->wingsDebug)) {
                    $this->logToFile("tt=<a style=\"color:red\">$tt</a>  worktime1=$worktime1   worktime2=$worktime2 <br/>");
                }

                if(strtotime($worktime1)<strtotime($worktime2)) {
                    /***************************************************正常考勤时段***************************************************/
                    if(isset($this->wingsDebug)) {
                        $this->logToFile('---正常考勤时段---<br/>');
                    }
                    //计算时间中间点
                    $worktime_mid = date('H:i:s',(strtotime($worktime2)-strtotime($worktime1))/2);

                    $_worktime1_last2hour = date('H:i:s',(strtotime($worktime1) - ATIME));
                    $_worktime2_next2hour = date('H:i:s',(strtotime($worktime2) + ATIME));
                    //如果$_worktime1_last2hour小于0点则改到00:00:00
                    if(strtotime($_worktime1_last2hour)>strtotime($worktime1)) {
                        $worktime1_last2hour = '00:00:00';
                    } else {
                        $worktime1_last2hour = $_worktime1_last2hour;
                    }
                    //如果结束时间加上ATIME超过24点则改到23：59：59
                    if($_worktime2_next2hour<strtotime($worktime2)) {
                        $worktime2_next2hour = '24:00:00';
                    } else {
                        $worktime2_next2hour = $_worktime2_next2hour;
                    }

                    if(isset($this->wingsDebug)) {
                        $this->logToFile("worktime_mid=$worktime_mid <br/> worktime1_last2hour=$worktime1_last2hour <br/> worktime2_next2hour=$worktime2_next2hour <br/>");
                    }
                    //查询当天打卡信息
                    $Model = M('clocktime');
                    $where = "clockdate BETWEEN '$tt' AND '$tt' AND clocktime>='$worktime1_last2hour' AND clocktime<='$worktime2_next2hour' AND uid = '$uid'";
                    $rs = $Model->where($where)->order('clocktime')->select();
                    //$this->logToFile($Model->getLastSql()."<br>");
                    if(isset($this->wingsDebug)) {
                        $this->logToFile('+++++++++++++++++++++++++++++++++++当天打卡信息++++++++++++++++++++++++++++++++++++++++<br/>');
                        $this->logToFile(print_r($rs,true));
                        $this->logToFile('<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>');
                    }
                    $row['type'] = 0;
                    //$row['vacid'] = $rs[0]['id'];
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
                            $this->logToFile($uid.':'."未打卡(上班)"."<br/>");
                        }
                        $row['static'] = '未打卡(上班)';
                        //$row['vacid'] = 0;
                        $row['clocktime'] = "00:00:00";
                        //新增之前删除之前记录
                        $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=0")->select();
                        if($oldRecord) {
                            if(isset($this->wingsDebug)) {
                                $this->logToFile($uid.':'."未打卡(上班)"."<br/>");
                            }
                            $row['isadd'] = $oldRecord[0]['isadd'];
                            $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                        }
                        $unusualModel->add($row);
                    } elseif (strtotime($rs[0]['clocktime'])>strtotime($worktime1)+STIME) {
                        //迟到
                        if(isset($this->wingsDebug)) {
                            $this->logToFile($uid.':'.$rs[0]['clocktime'].">".$worktime1);
                            $this->logToFile("迟到"."<br/>");
                        }
                        $row['static'] = '迟到';
                        //新增之前删除之前记录
                        $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=0")->select();
                        if($oldRecord) {
                            $row['isadd'] = $oldRecord[0]['isadd'];
                            $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                        }
                        $unusualModel->add($row);
                    } else {
                        //正常
                        if(isset($this->wingsDebug)) {
                            $this->logToFile($uid.':'.$rs[0]['clocktime']."<".$worktime1."正常<br/>");
                        }
                        $row['static'] = '正常';
                        //新增之前删除之前记录
                        $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=0")->select();
                        if($oldRecord) {
                            $row['isadd'] = $oldRecord[0]['isadd'];
                            $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                        }
                        $unusualModel->add($row);
                    }

                    //最后打卡时间
                    $k = count($rs)-1;
                    $row['type'] = 1;
                    //$row['vacid'] = $rs[$k]['id'];
                    $row['clocktime'] = $rs[$k]['clocktime'];
                    $row['standardtime'] = $worktime2;
                    //下班考勤
                    if (!$rs || $rs[$k]<=0 || strtotime($rs[$k]['clocktime'])<strtotime($worktime_mid)) {
                        //未打卡
                        if(isset($this->wingsDebug)) {
                            $this->logToFile($uid.':'."未打卡(下班)"."<br/>");
                        }
                        $row['static'] = '未打卡(下班)';
                        //$row['vacid'] = 0;
                        $row['clocktime'] = "00:00:00";
                        //新增之前删除之前记录
                        $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=1")->select();
                        if($oldRecord) {
                            $row['isadd'] = $oldRecord[0]['isadd'];
                            $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                        }
                        $unusualModel->add($row);
                    } elseif (strtotime($rs[$k]['clocktime'])<strtotime($worktime2)) {
                        //早退
                        if(isset($this->wingsDebug)) {
                            $this->logToFile($uid.':'.$rs[$k]['clocktime']."<".$worktime2);
                            $this->logToFile("早退"."<br/>");
                        }
                        $row['static'] = '早退';
                        //新增之前删除之前记录
                        $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=1")->select();
                        if($oldRecord) {
                            $row['isadd'] = $oldRecord[0]['isadd'];
                            $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                        }
                        $unusualModel->add($row);
                    } else {
                        //正常
                        if(isset($this->wingsDebug)) {
                            $this->logToFile($uid.':'.$rs[$k]['clocktime'].">".$worktime2."正常<br/>");
                        }
                        $row['static'] = '正常';
                        //新增之前删除之前记录
                        $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=1")->select();
                        if($oldRecord) {
                            $row['isadd'] = $oldRecord[0]['isadd'];
                            $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                        }
                        $unusualModel->add($row);
                    }
                } else {
                    /***************************************************跨天考勤时段***************************************************/
                    if(isset($this->wingsDebug)) {
                        $this->logToFile('---跨天考勤时段---<br/>');
                    }
                    //计算时间中间点
                    $worktime_mid = date('H:i:s',(strtotime($worktime2)+60*60*24+strtotime($worktime1))/2);

                    $worktime1_last2hour = date('H:i:s',(strtotime($worktime1) - ATIME));
                    $worktime2_next2hour = date('H:i:s',(strtotime($worktime2) + ATIME));
                    if(isset($this->wingsDebug)) {
                        $this->logToFile("worktime_mid=$worktime_mid <br/> worktime1_last2hour=$worktime1_last2hour  <br/> worktime2_next2hour=$worktime2_next2hour <br/>");
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
                        $this->logToFile('+++++++++++++++++++++++++++++++++++上班打卡信息++++++++++++++++++++++++++++++++++++++++<br/>');
                        $this->logToFile(print_r($rs,true));
                        $this->logToFile('<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>');
                    }
                    $row['type'] = 0;
                    //$row['vacid'] = $rs[0]['id'];
                    $row['uid'] = $uid;
                    $row['clockdate'] = $tt;
                    $row['clocktime'] = $rs[0]['clocktime'];
                    $row['standarddate'] = $tt;
                    $row['standardtime'] = $worktime1;

                    if($rs) {
                        if(strtotime($rs[0]['clocktime'])<=strtotime($worktime1)+STIME) {
                            //正常
                            if(isset($this->wingsDebug)) {
                                $this->logToFile($uid.':'.$rs[0]['clocktime']."<".$worktime1."正常<br/>");
                            }
                            $row['static'] = '正常';
                            //新增之前删除之前记录
                            $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=0")->select();
                            if($oldRecord) {
                                $row['isadd'] = $oldRecord[0]['isadd'];
                                $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                            }
                            $unusualModel->add($row);
                        } else {
                            //迟到
                            if(isset($this->wingsDebug)) {
                                $this->logToFile($uid.':'.$rs[0]['clocktime'].">".$worktime1);
                                $this->logToFile("迟到"."<br/>");
                            }
                            $row['static'] = '迟到';
                            //新增之前删除之前记录
                            $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=0")->select();
                            if($oldRecord) {
                                $row['isadd'] = $oldRecord[0]['isadd'];
                                $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                            }
                            $unusualModel->add($row);
                        }
                    } else {
                        //未打卡
                        if(isset($this->wingsDebug)) {
                            $this->logToFile($uid.':'."未打卡(上班)"."<br/>");
                        }
                        $row['static'] = '未打卡(上班)';
                        //$row['vacid'] = 0;
                        $row['clocktime'] = "00:00:00";
                        //新增之前删除之前记录
                        $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=0")->select();
                        if($oldRecord) {
                            $row['isadd'] = $oldRecord[0]['isadd'];
                            $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                        }
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
                        //$this->logToFile($Model->getLastSql());
                    } else {
                        //中间时间在第二天
                        $Model = M('clocktime');
                        $rs = $Model
                        ->where("clockdate BETWEEN '$tt_nextday' AND '$tt_nextday' AND clocktime BETWEEN '$worktime_mid' AND '$worktime2_next2hour' AND uid='$uid'")
                        ->order('clockdate,clocktime')
                        ->select();
                    }
                    if(isset($this->wingsDebug)) {
                        $this->logToFile('+++++++++++++++++++++++++++++++++++下班打卡信息++++++++++++++++++++++++++++++++++++++++<br/>');
                        $this->logToFile(print_r($rs,ture));
                        $this->logToFile('<br/>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br/>');
                    }
                    $k = count($rs) - 1;
                    $row['type'] = 1;
                    //$row['vacid'] = $rs[$k]['id'];
                    $row['clocktime'] = $rs[$k]['clocktime'];
                    $row['standardtime'] = $worktime2;

                    $_clockdatetime = $rs[$k]['clockdate'].' '.$rs[$k]['clocktime'];
                    $_workdatetime2 = $tt_nextday.' '.$worktime2;
                    if($rs) {
                        if(strtotime($_clockdatetime)>=strtotime($_workdatetime2)) {
                            //正常
                            if(isset($this->wingsDebug)) {
                                $this->logToFile($uid.':'.$_clockdatetime.">=".$_workdatetime2."正常<br/>");
                            }
                            $row['static'] = '正常';
                            $row['clockdate'] = $rs[$k]['clockdate'];
                            //新增之前删除之前记录
                            $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=1")->select();
                            if($oldRecord) {
                                $row['isadd'] = $oldRecord[0]['isadd'];
                                $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                            }
                            $unusualModel->add($row);
                        } else {
                            //迟到
                            if(isset($this->wingsDebug)) {
                                $this->logToFile($uid.':'.$_clockdatetime."<".$_workdatetime2);
                                $this->logToFile("早退"."<br/>");
                            }
                            $row['static'] = '早退';
                            $row['clockdate'] = $rs[$k]['clockdate'];
                            //新增之前删除之前记录
                            $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=1")->select();
                            if($oldRecord) {
                                $row['isadd'] = $oldRecord[0]['isadd'];
                                $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                            }
                            $unusualModel->add($row);
                        }
                    } else {
                        //未打卡
                        if(isset($this->wingsDebug)) {
                            $this->logToFile($uid.':'."未打卡(下班)"."<br/>");
                        }
                        $row['static'] = '未打卡(下班)';
                        //$row['vacid'] = 0;
                        $row['clockdate'] = $tt_nextday;
                        $row['clocktime'] = "00:00:00";
                        //新增之前删除之前记录
                        $oldRecord = $unusualModel->where("uid='$uid' AND standarddate='".$row['standarddate']."' AND type=1")->select();
                        if($oldRecord) {
                            $row['isadd'] = $oldRecord[0]['isadd'];
                            $unusualModel->where("id=".$oldRecord[0]['id'])->delete();
                        }
                        $unusualModel->add($row);
                    }
                }
            }
            $this->checkOverwork($start,$end,$uid);
            $this->checkVacation($start,$end,$uid);
        }
        $Model = M('clocktime');
        $Model->where("id is not null ")->delete();
        if(isset($this->wingsDebug)) {
            //日志结束
            $this->finishLog();
        }
    }

    public function doCheck() {
        $start = $this->_get('start');
        $end = $this->_get('end');
        R('Check/checkClock',array($start,$end));
        if(isset($this->wingsDebug)) {
           $this->logToFile('ok');
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
        //$this->logToFile(print_r($vacList,true));
        for($i=0;$i<count($vacList);$i++) {
            $unusualModel = M('unusualtime');
            //查询请假时段异常记录
            $beginDatetime = $vacList[$i]['begindate'].' '.$vacList[$i]['begintime'];
            $endDatetime = $vacList[$i]['enddate'].' '.$vacList[$i]['endtime'];
            //
            $unsualList = $unusualModel->where("uid='$uid' AND CONCAT(clockdate,' ',standardtime) BETWEEN '$beginDatetime' AND '$endDatetime'")->select();
            //$this->logToFile($unusualModel->getLastSql());
            //$this->logToFile(print_r($unsualList,true));
            for($j=0;$j<count($unsualList);$j++) {
                //$unsualList[$j]['static'] = '正常';
                if($vacList[$i]['transtype']==3) {
                    $unsualList[$j]['ps'] = '休假';
                } else {
                    $unsualList[$j]['ps'] = '出差';
                }
                $unsualList[$j]['vacid'] = $vacList[$i]['id'];
                //判断是否为半日假

                //判断是上班还是下班
                if(0==$unsualList[$j]['type']) {
                    //上班
                    $worktime1_last2hour = date('Y-m-d H:i:s',(strtotime($endDatetime) - ATIME));
                    $cl_endDatetime = date('Y-m-d H:i:s',(strtotime($endDatetime) + STIME));
                    //在clocktime表里查询新上班打卡时间段
                    $clockModel = M('clocktime');
                    $rs = $clockModel
                    ->where("uid='$uid' AND CONCAT(clockdate,' ',clocktime) BETWEEN '$worktime1_last2hour' AND '$cl_endDatetime'")
                    ->order('clockdate desc,clocktime desc')
                    ->select();
                    //如果有打卡记录
                    if($rs) {
                        $unsualList[$j]['clocktime'] = $rs[0]['clocktime'];
                        $unsualList[$j]['static'] = '正常'; 
                    } else {
                        //查询是否为迟到的情况
                        $cl_endDatetime_2 = date('Y-m-d H:i:s',(strtotime($cl_endDatetime) + 60*60*1));
                        $rs = $clockModel
                        ->where("uid='$uid' AND CONCAT(clockdate,' ',clocktime) BETWEEN '$cl_endDatetime' AND '$cl_endDatetime_2'")
                        ->order('clockdate desc,clocktime desc')
                        ->select();
                        //如果有打卡记录
                        if($rs) {
                            //则为迟到
                            $unsualList[$j]['clocktime'] = $rs[0]['clocktime'];
                            $unsualList[$j]['static'] = '迟到'; 
                        }
                    }
                } else {
                    //下班
                    $worktime2_next2hour = date('Y-m-d H:i:s',(strtotime($beginDatetime) + ATIME));
                    //在clocktime表里查询新下班打卡时间段
                    $clockModel = M('clocktime');
                    $rs = $clockModel
                    ->where("uid='$uid' AND CONCAT(clockdate,' ',clocktime) BETWEEN '$beginDatetime' AND '$worktime2_next2hour'")
                    ->order('clockdate,clocktime')
                    ->select();
                    //如果有打卡记录
                    if($rs) {
                        $unsualList[$j]['clocktime'] = $rs[0]['clocktime'];
                        $unsualList[$j]['static'] = '正常'; 
                    } else {
                        //查询是否为早退的情况
                        $beginDatetime_2 = date('Y-m-d H:i:s',(strtotime($beginDatetime) - 60*60*1));
                        $rs = $clockModel
                        ->where("uid='$uid' AND CONCAT(clockdate,' ',clocktime) BETWEEN '$beginDatetime_2' AND '$beginDatetime'")
                        ->order('clockdate desc,clocktime desc')
                        ->select();
                        //如果有打卡记录
                        if($rs) {
                            //则为早退
                            $unsualList[$j]['clocktime'] = $rs[0]['clocktime'];
                            $unsualList[$j]['static'] = '早退'; 
                        }
                    }
                }
                $rs = $unusualModel->save($unsualList[$j]);
                //$this->logToFile(print_r($unsualList[$j],true));
                if(!$rs) {
                    if(isset($this->wingsDebug)) {
                        $this->logToFile('error');
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
    }
   
    //加班条检测
    public function checkOverwork($start,$end,$uid) {
        if(isset($this->wingsDebug)) {
            $this->logToFile('<span style="color:orange">加班条检测开始</span><br/>');
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
        //$this->logToFile($vacModel->getLastSql()."<br/>");
        //$this->logToFile(print_r($vacList,true));
        for($i=0;$i<count($vacList);$i++) {

            $_vacBegindate = $vacList[$i]['begindate'];
            $_vacBegintime = $vacList[$i]['begintime'];
            $_vacEnddate = $vacList[$i]['enddate'];
            $_vacEndtime = $vacList[$i]['endtime'];
            if(isset($this->wingsDebug)) {
                $this->logToFile("加班开始时间:$_vacBegindate $_vacBegintime<br/>");
                $this->logToFile("加班结束时间:$_vacEnddate $_vacEndtime<br/>");
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
                    $this->logToFile("============================考勤记录======================<br/>");
                    $this->logToFile(print_r($unsualList,true));
                    $this->logToFile("<br/>===========================================================<br/>");
                }
                for($j=0;$j<count($unsualList);$j++) {
                    
                    $cl_startDatetime = $unsualList[$j]['clockdate'].' '.$_vacEndtime;
                    $cl_endDatetime = date('Y-m-d H:i:s',(strtotime($cl_startDatetime)+ATIME));
                    //在clocktime表里查询新下班打卡时间段
                    $clockModel = M('clocktime');
                    $rs = $clockModel
                    ->where("uid='$uid' AND CONCAT(clockdate,' ',clocktime) BETWEEN '$cl_startDatetime' AND '$cl_endDatetime'")
                    ->order('clockdate,clocktime')
                    ->select();
                    if(isset($this->wingsDebug)) {
                        $this->logToFile("============================打卡记录======================<br/>");
                        //$this->logToFile("SQL:".$clockModel->getLastSql()."<br/>");
                        $this->logToFile(print_r($rs,true));
                        $this->logToFile("<br/>===========================================================<br/>");
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

                    //如果之前没有计算调休
                    if($unsualList[$j]['isadd']!=1) {
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
                            $this->logToFile("加班开始：$setupDatetime 加班结束：$setdownDatetime 小时：$days<br/>");
                        }
                        $staffModel = M('staffinfo');
                        $row = $staffModel->getByUid($uid);
                        if($row['teamid']==1) {
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
                                $this->logToFile('days save error<br/>');
                            }
                        }
                        //把isadd（是否以计算调休）置为1
                        $unsualList[$j]['isadd']=1;
                        $unsualList[$j]['addval']=$days;
                        //储存unusual
                        $rs = $unusualModel->save($unsualList[$j]);
                        if(!$rs) {
                            if(isset($this->wingsDebug)) {
                                $this->logToFile('unusual save error<br/>');
                            }
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
                    $this->logToFile("============================考勤记录======================<br/>");
                    $this->logToFile(print_r($unsualList,true));
                    $this->logToFile("<br/>===========================================================<br/>");
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
                    //如果之前没有计算调休
                    if($unsualList[$setdown]['isadd']!=1) {
                        //计算加班小时
                        //$setupDatetime = $unsualList[$setup]['clockdate'].' '.$unsualList[$setup]['clocktime'];
                        $setupDatetime = $unsualList[$setup]['clockdate'].' '.$unsualList[$setup]['standardtime'];
                        $setupDatetime_real = $unsualList[$setup]['clockdate'].' '.$unsualList[$setup]['clocktime'];
                        $setdownDatetime = $unsualList[$setdown]['clockdate'].' '.$unsualList[$setdown]['standardtime'];
                        $setdownDatetime_real = $unsualList[$setdown]['clockdate'].' '.$unsualList[$setdown]['clocktime'];
                        //如果实际上班时间比标准上班时间大（迟到），则计算为实际上班时间
                        if(strtotime($setupDatetime_real) > strtotime($setupDatetime)) {
                            $setupDatetime = $setupDatetime_real;
                        }
                        //如果实际下班时间比标准下班时间小（早退），则计算为实际下班时间
                        if(strtotime($setdownDatetime_real) < strtotime($setdownDatetime)) {
                            $setdownDatetime = $setdownDatetime_real;
                        }
                        $timestamp = strtotime($setdownDatetime) - strtotime($setupDatetime);
                        $dd = ceil(($timestamp/3600)*10)/10;
                        if($dd>4) {
                            //修正加班小时数(减去中午0.5小时)
                            $dd -= 0.5;
                        }
                        $days += $dd;
                        if(isset($this->wingsDebug)) {
                            $this->logToFile("加班开始：$setupDatetime 加班结束：$setdownDatetime 小时：$dd<br/>");
                        }
                        //把isadd（是否以计算调休）置为1
                        $unsualList[$setdown]['isadd']=1;
                        $unsualList[$j]['addval']=$dd;
                        //储存unusual
                        $rs = $unusualModel->save($unsualList[$setup]);
                        if(!$rs) {
                            if(isset($this->wingsDebug)) {
                                $this->logToFile('sestup unusual save error<br/>');
                            }
                        }
                        $rs = $unusualModel->save($unsualList[$setdown]);
                        if(!$rs) {
                            if(isset($this->wingsDebug)) {
                                $this->logToFile('setdown unusual save error<br/>');
                            }
                        }
                    }
                    
                }
                //如果没有计算调休，则不储存
                if($days!=0) {
                    //储存调休
                    $staffModel = M('staffinfo');
                    $row = $staffModel->getByUid($uid);
                    $row['TRest'] += $days;
                    $rs = $staffModel->save($row);
                    if(isset($this->wingsDebug)) {
                        $this->logToFile('本次总加班时间：$days<br/>');
                    }
                    if(!$rs) {
                        if(isset($this->wingsDebug)) {
                            $this->logToFile('days save error<br/>');
                        }
                    }
                }
            }
            
        }
        if(isset($this->wingsDebug)) {
            $this->logToFile('<span style="color:orange">==================================</span><br/>');
        }
    }

    public function doCheckOverwork() {
        $start = $this->_get('start');
        $end = $this->_get('end');
        $uid = $this->_get('uid');
        R('Check/checkOverwork',array($start,$end,$uid));
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

    function clearDir($dir) {
        //先删除目录下的文件：
        $dh=opendir($dir);
        if (!$dh) {
            mkdir($this->LOG_DIR);
        }
        while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }
        closedir($dh);
    }

    //初始化日志
    public function initLog() {
        $this->clearDir($this->LOG_DIR);
        $fileName = date('YmdHig').".html";
        $filePath = $this->LOG_DIR.$fileName;
        $this->fpLog = fopen($filePath,'a');
        if(!$this->fpLog) {
            $this->logToFile('File Create Failed!');
        }
        $this->logToFile('<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />');
    }

    //写入日志
    public function logToFile($Message) {
        //替换br为\r\n
        //$msg = str_replace('<br/>',"\r\n",$Message);
        $msg = $Message;
        fwrite($this->fpLog,$msg);
    }

    //关闭日志
    public function finishLog() {
        fclose($this->fpLog);
    }
}

?>