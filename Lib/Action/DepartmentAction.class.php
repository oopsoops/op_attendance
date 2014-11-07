<?php 



class DepartmentAction extends Action {

    public function dpfetch_all_attendance() {
	
		$sessionuid = $_SESSION['uid'];
		
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
		
		$uid = $this->_post('uid');
		
		$search_chose=$this->_post('dpsearch_chose');
				
		$username = $this->_post('username');
				
		$search_begin_time = $this->_post('dpsearch_begin_time');
		
		$search_end_time = $this->_post('dpsearch_end_time');
		
		$dp = M('userinfo');
		
		$dpinfo = $dp->getByUid($sessionuid);
         $departmentid = $dpinfo['departmentid'];
		 $where = " op_staffinfo.departmentid = $departmentid ";
				
		if($uid!='') {
			$where = " $where and op_unusualtime.uid = '"."$uid"."' " ;
		}
	
		
		

			
			if($search_chose=='dpsearch_yes')
			{
			$where="$where and op_unusualtime.static ='"."正常"."'  ";
			
			}
			else if($search_chose=='dpsearch_no')
			{
				$where="$where and op_unusualtime.static <> '"."正常"."' ";
				}
	
		 if($username!='')
		{
			$where= " $where and username like '%$username%' ";
			}
		
		
		if($search_begin_time!='') {
			$where= "$where and op_unusualtime.clockdate>='"."$search_begin_time"."' ";
		}
	
		if($search_end_time!='') {
			$where = "$where and op_unusualtime.clockdate<='"."$search_end_time"."' ";
		}
		
	   

		$unusualtime = M('unusualtime');
		$cc = $unusualtime
		
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_teaminfo.tid = op_staffinfo.teamid')
		->where($where)
		 ->count();
		 
	    $allattendance=$unusualtime
		->field("phone,op_unusualtime.uid as uid,op_unusualtime.clocktime as clocktime,op_unusualtime.clockdate as clockdate,op_staffinfo.username as username,op_unusualtime.static as static
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,ps
		
			
		 ")
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_teaminfo.tid = op_staffinfo.teamid')
		->where($where)
		 ->order('op_unusualtime.uid asc,op_unusualtime.clockdate desc,op_unusualtime.clocktime desc')
		->limit("$start,$rows")
		->select();
		
	//echo $unusualtime->getLastSql();
	echo dataToJson($allattendance,$cc);
	}
	
	
	
	
	
	
	
	
	}






?>