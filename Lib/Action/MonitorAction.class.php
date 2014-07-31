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
		
		$monitor = M('userinfo');
		
		$monitorinfo = $monitor->getByUid($sessionuid);
         $teamid = $monitorinfo['teamid'];
		 $departmentid = $monitorinfo['departmentid'];
		 $where = " op_staffinfo.teamid =$teamid and op_staffinfo.departmentid = $departmentid ";
				
		

			
			if($search_chose=='mosearch_yes')
			{
			$where="$where and op_unusualtime.static is null ";
			
			}
			else if($search_chose=='mosearch_no')
			{
				$where="$where and op_unusualtime.static is not null ";
				}
	
		 if($username!='')
		{
			$where= " $where and username='"."$username"."' ";
			}
		
		
		if($search_begin_time!='') {
			$where= "$where and op_clocktime.clockdate>='"."$search_begin_time"."' ";
		}
	
		if($search_end_time!='') {
			$where = "$where and op_clocktime.clockdate<='"."$search_end_time"."' ";
		}
		
			if($uid!='') {
			$where = "$where and op_clocktime.uid = $uid ";
		}
	   
		$clocktime = M('clocktime');
		
		$cc = $clocktime
		->Distinct(true)
		->join('op_staffinfo ON op_clocktime.uid=op_staffinfo.uid')
		->join('op_teaminfo ON op_staffinfo.teamid=op_teaminfo.tid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_unusualtime ON op_unusualtime.pid=op_clocktime.id')
		 ->where($where)
		 ->count();
		 
	    $allattendance=$clocktime
		->Distinct(true)
		->field("phone,op_clocktime.uid as uid,op_clocktime.clocktime as clocktime,op_clocktime.clockdate as clockdate,op_staffinfo.username as username
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,
		 CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply,
			
		 CASE 
			 WHEN static='迟到' THEN '迟到'
			 WHEN static='早退' THEN '早退'
			 ELSE '正常' END AS static")
		->join('op_staffinfo ON op_clocktime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_staffinfo.teamid = op_teaminfo.tid')
		->join('op_unusualtime ON op_unusualtime.pid=op_clocktime.id')
		->where($where)
		 ->order('op_clocktime.uid desc')
		->limit("$start,$rows")
		->select();
		
	//echo $clocktime->getLastSql();
	echo dataToJson($allattendance,$cc);
	}
	/************************************** Yu Yi *******************************************/

	//public 



	/****************************************************************************************/
	
}






?>