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

			//查询该用户所属组的排版情况
			$Model = M('worktime');
			$worktime = $Model->getByTeamid($teamid);
			$worktime1 = $worktime['worktime1'];
			$worktime2 = $worktime['worktime2'];
			$Model = M('clocktime');

			//每一天
			for ($j=0; $j <= $day; $j++) { 
				$tt = date("Y-m-d",$time1 + 86400 * $j);
				$where = "clockdate BETWEEN '$tt' AND '$tt' AND uid = '$uid'";
				$rs = $Model->where($where)->order('clocktime')->select();
				//echo $Model->getLastSql()."<br>";
				//print_r($rs);
				//最后打卡时间
				$k = count($rs)-1;

				$row['pid'] = $rs[0]['id'];
				$row['uid'] = $uid;
				$row['clockdate'] = $tt;
				$row['clocktime'] = $rs[0]['clocktime'];
				$row['standardtime'] = $worktime1;

				//如果表中含有相同记录
				//$rs = $unusualModel->where("clockdate BETWEEN '$tt' AND '$tt' AND uid = '$uid'")->delete();

				//早上考勤
				if (!$rs || $rs[0]['clocktime']<=0 || strtotime($rs[0]['clocktime'])>strtotime("12:00:00")) {
					//未打卡
					//echo $uid.':'."未打卡(上午)"."<br/>";
					$row['static'] = '未打卡(上午)';
					$row['pid'] = 0;
					$row['clocktime'] = "00:00:00";
					$unusualModel->add($row);
				} elseif (strtotime($rs[0]['clocktime'])>strtotime($worktime1)+10*60) {
					//迟到
					//echo $uid.':'.$rs[0]['clocktime'].">".$worktime1;
					//echo "迟到"."<br/>";
					$row['static'] = '迟到';
					$unusualModel->add($row);
				} else {
					//正常
					//echo $uid.':'.$rs[0]['clocktime']."<".$worktime1."<br/>";
					$row['static'] = '正常';
					$unusualModel->add($row);
				}

				$row['clocktime'] = $rs[$k]['clocktime'];
				$row['standardtime'] = $worktime2;
				//下午考勤
				if (!$rs || $rs[$k]['clocktime']<=0 || strtotime($rs[$k]['clocktime'])<strtotime("12:00:00")) {
					//未打卡
					//echo $uid.':'."未打卡(下午)"."<br/>";
					$row['static'] = '未打卡(下午)';
					$row['pid'] = 0;
					$row['clocktime'] = "00:00:00";
					$unusualModel->add($row);
				} elseif (strtotime($rs[$k]['clocktime'])<strtotime($worktime2)) {
					//早退
					//echo $uid.':'.$rs[$k]['clocktime']."<".$worktime2;
					//echo "早退"."<br/>";
					$row['static'] = '早退';
					$unusualModel->add($row);
				} else {
					//正常
					//echo $uid.':'.$rs[$k]['clocktime'].">".$worktime2."<br/>";
					$row['static'] = '正常';
					$unusualModel->add($row);
				}
			}
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
    	echo 'ok';
    }
   
   //加班条检测
    public function checkOverwork($start,$end,$uid) {
    	$vacModel = M('vacationstatus');
    	//查询所有请假条
    	$vacList = $vacModel->where("uid='$uid' AND isapproved=1 AND transtype=3 AND begindate BETWEEN '$start' AND '$end' ")->order('applytime')->select();
    	for($i=0;$i<count($vacList);$i++) {
    		$unusModel = M('unusualtime');
    		//查询请假时段异常记录
    		$beginDatetime = $vacList[$i]['begindate'].' '.$vacList[$i]['begintime'];
    		$endDatetime = $vacList[$i]['enddate'].' '.$vacList[$i]['endtime'];
    		$unsuList = $unusModel->where("uid='$uid' AND static<>'正常' AND standardtime BETWEEN '$beginDatetime' AND '$endDatetime'")->select();
    		//print_r($unsuList);
    		for($j=0;$j<count($unsuList);$j++) {
    			$unsuList[$j]['static'] = '正常';
    			$unsuList[$j]['ps'] = '休假';
    			$unsuList[$j]['vacid'] = $vacList[$i]['id'];
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
    	echo 'ok';
    }
}

?>