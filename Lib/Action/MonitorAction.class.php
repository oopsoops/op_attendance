<?php 



class MonitorAction extends Action {

    public function mofetch_all_attendance() {
	
		$sessionuid = $_SESSION['uid'];
		
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
		
		$uid = $this->_post('uid');
		
		$search_chose=$this->_post('mosearch_chose');
				
		$username = $this->_post('username');
				
		$search_begin_time = $this->_post('mosearch_begin_time');
		
		$search_end_time = $this->_post('mosearch_end_time');
		
		$monitor = M('staffinfo');
		
		$monitorinfo = $monitor->getByUid($sessionuid);
         $teamid = $monitorinfo['teamid'];
		 $departmentid = $monitorinfo['departmentid'];
		 $where = " op_staffinfo.teamid =$teamid and op_staffinfo.departmentid = $departmentid ";
				
		

			
			if($search_chose=='mosearch_yes')
			{
			$where="$where and op_unusualtime.static  = '"."正常"."' ";
			
			}
			else if($search_chose=='mosearch_no')
			{
				$where="$where and op_unusualtime.static <> '"."正常"."'";
				}
	
		 if($username!='')
		{
			$where= " $where and username='"."$username"."' ";
			}
		
		
		if($search_begin_time!='') {
			$where= "$where and op_unusualtime.clockdate>='"."$search_begin_time"."' ";
		}
	
		if($search_end_time!='') {
			$where = "$where and op_unusualtime.clockdate<='"."$search_end_time"."' ";
		}
		
			if($uid!='') {
			$where = "$where and op_unusualtime.uid = $uid ";
		}
	   
		$unusualtime = M('unusualtime');
		
		$cc = $unusualtime
		->Distinct(true)
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_teaminfo ON op_staffinfo.teamid=op_teaminfo.tid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->where($where)
		 ->count();
		 
	    $allattendance=$unusualtime
		->Distinct(true)
		->field("phone,op_unusualtime.uid as uid,op_unusualtime.clocktime as clocktime,op_unusualtime.clockdate as clockdate,op_staffinfo.username as username,op_unusualtime.static as static
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,ps
		
		")
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_staffinfo.teamid = op_teaminfo.tid')
		->where($where)
		 ->order('op_unusualtime.uid desc')
		->limit("$start,$rows")
		->select();
		
	//echo $unusualtime->getLastSql();
	echo dataToJson($allattendance,$cc);
	}
	/************************************** Yu Yi *******************************************/
	//排班查询
	public function worktime() {
		$Model = M('staffinfo');
		$uid = $_SESSION['uid'];
		$teamid = $Model->getFieldByUid($uid,'teamid');
		$Model = M('worktime');
		$rs = $Model->join('op_teaminfo ON op_teaminfo.tid = op_worktime.teamid')->where("teamid = $teamid")->select();
		$this->assign('worktime',$rs[0]);
		$this->display();
	} 
	//处理排班修改
	public function doWorktimeEdit() {
		$start = $this->_get('start').":00";
		$end = $this->_get('end').":00";
		$uid = $_SESSION['uid'];
		$Model = M('staffinfo');
		$teamid = $Model->getFieldByUid($uid,'teamid');
		$Model = M('worktime');
		$row = $Model->getByTeamid($teamid);
		$row['worktime1'] = $start;
		$row['worktime2'] = $end;
		$rs = $Model->save($row);
		if (!$rs) {
			echo '修改失败，请重试！';
		} else {
			echo 'ok';
		}
	}


	/****************************************************************************************/
	
}






?>