<?php 
vendor('Zend.ExcelToArrary');//导入excelToArray类
class TestAction extends Action
{

	
		
	 public function testfetch_all_users() {
	
		$sessionuid = $_SESSION['uid'];
		
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
		
		$uid = $this->_post('uid');
		
		$search_chose=$this->_post('hrsearch_chose');
				
		$username = $this->_post('username');
		
		$department=$this->_post('department');
		
		$search_begin_time = $this->_post('hrsearch_begin_time');
		
		$search_end_time = $this->_post('hrsearch_end_time');
		

				
		if($uid!='') {
			$where = 'op_unusualtime.uid = "'.$uid.' "' ;
		}
		else
		{
			$where = '';
			
			}
		
		
		if($where!='')
		{
			
			if($search_chose=='hrsearch_yes')
			{
			$where="$where and op_unusualtime.static ='"."正常"."'  ";
			
			}
			else if($search_chose=='hrsearch_no')
			{
				$where="$where and op_unusualtime.static <> '"."正常"."' ";
				}
		}
		else 
		{
						
			if($search_chose=='hrsearch_yes')
			{
			$where="op_unusualtime.static ='"."正常"."'   ";
			
			}
			else if($search_chose=='hrsearch_no')
			{
				$where="op_unusualtime.static <> '"."正常"."' ";
				}
			
			
			}
			
			
			
		
		if($department!=''&$where!='')
		{
			$where="$where and op_department.departmentname like '%$department%' ";
			}
			
			else if ($department!='')
			{
				$where="op_department.departmentname like '%$department%' ";
				}
		
		if($username!=''&$where!='') {
			$where= "$where and username='"."$username"."' ";
		}
		else if($username!='')
		{
			$where= "username='"."$username"."' ";
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
		->join('op_satffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->where($where)
		 ->count();
		 
	    $allattendance=$unusualtime
		->Distinct(true)
		->field("phone,op_unusualtime.uid as uid,op_unusualtime.clocktime as clocktime,op_unusualtime.clockdate as clockdate,op_staffinfo.username as username,op_unusualtime.static as static
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,op_unusualtime.id as clockid,
		 CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply
			
		 ")
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_teaminfo.tid = op_staffinfo.teamid')
		->where($where)
		 ->order('op_unusualtime.uid desc')
		->limit("$start,$rows")
		->select();
		
	//echo $unusualtime->getLastSql();
	echo dataToJson($allattendance,$cc);
	}
	
	/****************************************/
	
	
		public function testTimeChange() {
		
	   $clockid = $this->_get('clockid');

		$usertime = M('unusualtime');
		

		 
	    $info=$usertime
		->field("op_unusualtime.id as clockid,op_unusualtime.clockdate as clockdate,op_unusualtime.clocktime as clocktime")
		
		->where("op_unusualtime.id = $clockid")
	    ->select();
		//echo $usertime->getLastSql();
		$this->assign('clockinfo',$info[0]);
		$this->display();
    }
	
	
	
	
	
	public function time_modify_do(){
	
	$clockid=$this->_get('clockid');
	$clockdate = $this->_post('clockdate');
	$clocktime = $this->_post('clocktime');
	
	$clockModify = M('unusualtime');
	
	    $clockinfo=$clockModify->getById($clockid);
		

	    $clockinfo['clockdate'] =  $clockdate;
		$clockinfo['clocktime'] = $clocktime;
		$clockinfo['static'] = "正常";
	
		
		$rs = $clockModify->save($clockinfo);
		
		//echo $clockModify->getLastSql();
		
	if(!$rs) {
			echo '修改失败，请重试！';
			exit;	
		}
		

		echo 'ok';
		
		
	
	
	}
	
	
}

?>