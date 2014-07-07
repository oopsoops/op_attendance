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
		
		
		
		$search_chose=$this->_post('search_chose');
				

		
		$search_begin_time = $this->_post('search_begin_time');
		
		$search_end_time = $this->_post('search_end_time');
		

				
		if($uid=='') {
			$this->error('查询失败，请重新登陆！');
		}
		else
		{
			$where = "op_clocktime.uid =$uid ";
			
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
			
			
		
		
		if($search_begin_time!=''&$where!='') {
			$where= "$where and op_clocktime.clockdate>='"."$search_begin_time"."' ";
		}
		else if($search_begin_time!='')
		{
			$where= "op_clocktime.clockdate>='"."$search_begin_time"."' ";
			}
		
		if($search_end_time!=''&$where!='') {
			$where = "$where and op_clocktime.clockdate<='"."$search_end_time"."' ";
		}
		else if($search_end_time!='')
		{
			$where = "op_clocktime.clockdate<='"."$search_end_time"."' ";
			}
	   
	   

		$clocktime = M('clocktime');
		$cc = $clocktime
		->Distinct(true)
		->join('op_staffinfo ON op_clocktime.uid=op_staffinfo.uid')
		 ->where($where)
		 ->count();
		 
	    $allattendance=$clocktime
		->Distinct(true)
		->field("phone,op_clocktime.uid as uid,op_clocktime.clocktime as clocktime,op_clocktime.clockdate as clockdate,op_staffinfo.username as username
		,op_department.departmentname as department,
		 CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply,
			
		 CASE 
			 WHEN static='迟到' THEN '迟到'
			 WHEN static='早退' THEN '早退'
			 ELSE '正常' END AS static")
		->join('op_staffinfo ON op_clocktime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_unusualtime ON op_unusualtime.pid=op_clocktime.id')
		->where($where)
		 ->order('op_clocktime.uid desc')
		->limit("$start,$rows")
		->select();
		
	//echo $clocktime->getLastSql();
	echo dataToJson($allattendance,$cc);
    }
	
	
	/****************查询个人信息详情*****************/
	public function userinfo_detailshow() {
		
	   $flag = $this->_get('flag');
	   
	   if($flag==1)
	   {
		   $uid = $this->_get('uid');
		   }
		
		
		else
		{
			$uid = $_SESSION['uid'];
			}

		$userdetails = M('staffinfo');
		

		 
	    $info=$userdetails
		->field("op_staffinfo.uid as uid,op_staffinfo.username as username,op_staffinfo.phone as phone,op_staffinfo.email as email,op_staffinfo.entrydate as entrydate,op_usertype.typename as typename,op_department.departmentname as department,op_teaminfo.teamname as teamif")
		->join('op_usertype ON op_staffinfo.usertypeid=op_usertype.tid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_staffinfo.teamid = op_teaminfo.tid')
		->where("op_staffinfo.uid = $uid")
	    ->select();
		//echo $userdetails->getLastSql();
		$this->assign('userinfo',$info[0]);
		$this->display();
    }
	
	
	}



?>