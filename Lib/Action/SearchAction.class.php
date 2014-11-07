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
			$where = "op_unusualtime.uid =$uid ";
			
			}
		
		
		if($where!='')
		{
			
			if($search_chose=='search_yes')
			{
			$where="$where and op_unusualtime.static = '"."正常"."' ";
			
			}
			else if($search_chose=='search_no')
			{
				$where="$where and op_unusualtime.static <> '"."正常"."' ";
				}
		}
		else 
		{
						
			if($search_chose=='search_yes')
			{
			$where="op_unusualtime.static ='"."正常"."' ";
			
			}
			else if($search_chose=='search_no')
			{
				$where="op_unusualtime.static <> ='"."正常"."'  ";
				}
			
			
			}
			
			
		
		
		if($search_begin_time!=''&$where!='') {
			$where= "$where and op_unusualtime.clockdate>='"."$search_begin_time"."' ";
		}
		else if($search_begin_time!='')
		{
			$where= "op_unusualtime.clockdate>='"."$search_begin_time"."' ";
			}
		
		if($search_end_time!=''&$where!='') {
			$where = "$where and op_unusualtime.clockdate<='"."$search_end_time"."' ";
		}
		else if($search_end_time!='')
		{
			$where = "op_unusualtime.clockdate<='"."$search_end_time"."' ";
			}
	   
	   

		$unusualtime = M('unusualtime');
		$cc = $unusualtime
		->Distinct(true)
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		 ->where($where)
		 ->count();
		 
	    $allattendance=$unusualtime
		->Distinct(true)
		->field("phone,op_unusualtime.uid as uid,op_unusualtime.clocktime as clocktime,op_unusualtime.clockdate as clockdate,op_staffinfo.username as username,op_unusualtime.static as static
		,op_department.departmentname as department,ps
		
		")
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->where($where)
		 ->order('op_unusualtime.uid asc,op_unusualtime.clockdate desc,op_unusualtime.clocktime desc')
		->limit("$start,$rows")
		->select();
		
	//echo $unusualtime->getLastSql();
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
		->field("op_staffinfo.uid as uid,op_staffinfo.username as username,op_staffinfo.phone as phone,op_staffinfo.email as email,op_staffinfo.entrydate as entrydate,op_usertype.typename as typename,op_department.departmentname as department,op_teaminfo.teamname as teamname,op_staffinfo.THoliday as tholiday,op_staffinfo.LHoliday as lholiday,op_staffinfo.TRest as
	trest,op_staffinfo.LRest as lrest,op_staffinfo.costcenterid as costcenter")
		->join('op_usertype ON op_staffinfo.usertypeid=op_usertype.tid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_staffinfo.teamid = op_teaminfo.tid')
		->where("op_staffinfo.uid = $uid")
	    ->select();
		//echo $userdetails->getLastSql();
		$this->assign('userinfo',$info[0]);
		$this->display();
    }
	
	
	/************************************** Yu Yi *******************************************/
	//排班查询
	public function worktime() {
		$Model = M('staffinfo');
		$uid = $_SESSION['uid'];
		$today = date('Y-m-d');
		$teamid = $Model->getFieldByUid($uid,'teamid');
		$Model = M('worktime');
		$rs = $Model
		->join('op_teaminfo ON op_teaminfo.tid = op_worktime.teamid')
		->where("teamid = $teamid AND workdate1<='$today' AND workdate2>='$today'")
		->select();
		$this->assign('worktime',$rs[0]);
		$this->display();
	} 

	/****************************************************************************************/

	
}




?>