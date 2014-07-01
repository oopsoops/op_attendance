<?php 
class SearchAction extends Action
{
	/**查询所有人考勤详情********/
	  public function fetch_all_attendance() {
		$uid = $_SESSION['uid'];
		
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
		
		$uid = $this->_post('uid');
		
		$search_chose=$this->_post('search_chose');
				
		$username = $this->_post('username');
		
		$department=$this->_post('department');
		
		$search_begin_time = $this->_post('search_begin_time');
		
		$search_end_time = $this->_post('search_end_time');
		
		if($uid==''&$username==''&$search_begin_time==''&$search_end_time==''&$department=='')
		{
			
			$where='';
			
		}
			else
			{
				
		if($uid!='') {
			$where = "op_clocktime.uid =$uid ";
		}
		else
		{
			$where = '';
			
			}
		
		
		if($where!='')
		{
			
			if($search_chose=='search_yes')
			{
			$where="$where and op_unusualtime.static is null ";
			
			}
			else if($search_chose=='search_no')
			{
				$where="$where and op_unusualtime.static is not null ";
				}
		}
		else 
		{
						
			if($search_chose=='search_yes')
			{
			$where="op_unusualtime.static is null ";
			
			}
			else if($search_chose=='search_no')
			{
				$where="op_unusualtime.static is not null ";
				}
			
			
			}
			
			
			
		
		if($department!=''&$where!='')
		{
			$where="$where and department=$department ";
			}
			
			else if ($department!='')
			{
				$where="department = $department ";
				}
		
		if($username!=''&$where!='') {
			$where= "$where and username=$username ";
		}
		else if($username!='')
		{
			$where= "username=$username ";
			}
		
		
		if($search_begin_time!=''&$where!='') {
			$where= "$where and clocktime>=$search_begin_time ";
		}
		else if($search_begin_time!='')
		{
			$where= "clocktime>=$search_begin_time ";
			}
		
		if($search_end_time!=''&$where!='') {
			$where = "$where and clocktime<=$search_end_time ";
		}
		else if($search_end_time!='')
		{
			$where = "clocktime<=$search_end_time ";
			}
	   }
	   

		$clocktime = M('clocktime');
		$cc = $clocktime
		->join('op_userinfo ON op_clocktime.uid=op_userinfo.uid')
		 ->where($where)
		 ->count();
		 
	    $allattendance=$clocktime
		->field("phone,op_clocktime.uid as uid,op_clocktime.clocktime as clocktime,op_userinfo.username as username
		,op_department.departmentname as department,
		 CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply,
			
		 CASE 
			 WHEN static='迟到' THEN '迟到'
			 WHEN static='早退' THEN '早退'
			 ELSE '正常' END AS static")
		->join('op_userinfo ON op_clocktime.uid=op_userinfo.uid')
		->join('op_department ON op_userinfo.departmentid=op_department.did')
		->join('op_unusualtime ON op_unusualtime.pid=op_clocktime.id')
		->where($where)
		 ->order('op_clocktime.uid desc')
		->limit("$start,$rows")
		->select();
		
	//echo $clocktime->getLastSql();
		echo dataToJson($allattendance,$cc);
    }
	
	
	/****************查询个人考勤详情*****************/
	public function fetch_single_attendance() {
		$uid = $_SESSION['uid'];
		
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
		
		$uid = $this->_get('uid');
		
		$single_chose=$this->_post('single_chose');
		
		$single_begin_time = $this->_post('single_begin_time');
		
		$single_end_time = $this->_post('single_end_time');
		
	
			
		$where="op_clocktime.uid=$uid";
			
		
		
				//考勤正常
		if($single_chose=='single_yes') {
		
			$where = "$where and op_unusualtime.static is null ";
			
			}
			//不正常
		else if($single_chose=='single_no')
		{
			$where = "$where and op_unusualtime.static is not null ";
			
			}
		
		if($single_begin_time!='') {
			$where= "$where and clocktime>=$single_begin_time ";
		}
		
		
		if($single_end_time!='') {
			$where = "$where and clocktime<=$single_end_time ";
		}
		
	  
	   

		$worktime = M('clocktime');
		
		$cc = $worktime
		 ->join('op_unusualtme ON op_clocktime.id=op_unusualtime.pid')
		 ->where($where)
		 ->count();
		 
	    $attendance=$worktime
		->field("op_clocktime.uid as uid,op_clocktime.clocktime as clocktime,op_userinfo.username as username,op_department.departmentname as department,
		    CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply,
			 
			 CASE 
			 WHEN static='迟到' THEN '迟到'
			 WHEN static='早退' THEN '早退'
			 ELSE '正常' END AS static")
		->join('op_userinfo ON op_clocktime.uid=op_userinfo.uid')
		->join('op_department ON op_userinfo.departmentid=op_department.did')
		->join('op_unusualtime ON op_clocktime.id=op_unusualtime.pid')
		->where($where)
		 ->order('op_clocktime.uid desc')
		->limit("$start,$rows")
		->select();
		
	//echo $worktime->getLastSql();
		echo dataToJson($attendance,$cc);
    }
	
	}


?>