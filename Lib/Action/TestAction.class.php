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
			$where = 'op_unususltime.uid = "'.$uid.' "' ;
		}
		else
		{
			$where = '';
			
			}
		
		
		if($where!='')
		{
			
			if($search_chose=='hrsearch_yes')
			{
			$where="$where and op_unusualtime.static is null ";
			
			}
			else if($search_chose=='hrsearch_no')
			{
				$where="$where and op_unusualtime.static is not null ";
				}
		}
		else 
		{
						
			if($search_chose=='hrsearch_yes')
			{
			$where="op_unusualtime.static is null ";
			
			}
			else if($search_chose=='hrsearch_no')
			{
				$where="op_unusualtime.static is not null ";
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
			$where= "$where and op_unususltime.clockdate>='"."$search_begin_time"."' ";
		}
		else if($search_begin_time!='')
		{
			$where= "op_unususltime.clockdate>='"."$search_begin_time"."' ";
			}
		
		if($search_end_time!=''&$where!='') {
			$where = "$where and op_unususltime.clockdate<='"."$search_end_time"."' ";
		}
		else if($search_end_time!='')
		{
			$where = "op_unususltime.clockdate<='"."$search_end_time"."' ";
			}
	   
	   

		$unusualtime = M('unususltime');
		$cc = $unusualtime
		->Distinct(true)
		->join('op_satffinfo ON op_unususltime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->where($where)
		 ->count();
		 
	    $allattendance=$unusualtime
		->Distinct(true)
		->field("phone,op_unususltime.uid as uid,op_unususltime.clocktime as clocktime,op_unususltime.clockdate as clockdate,op_staffinfo.username as username
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,op_unususltime.id as clockid,
		 CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply,
			
		 CASE 
			 WHEN static='迟到' THEN '迟到'
			 WHEN static='早退' THEN '早退'
			 ELSE '正常' END AS static")
		->join('op_staffinfo ON op_unususltime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_teaminfo.tid = op_staffinfo.teamif')
		->where($where)
		 ->order('op_unususltime.uid desc')
		->limit("$start,$rows")
		->select();
		
	//echo $clocktime->getLastSql();
	echo dataToJson($allattendance,$cc);
	}
	
	/****************************************/
	
	
		public function testTimeChange() {
		
	   $clockid = $this->_get('clockid');

		$usertime = M('unususltime');
		

		 
	    $info=$usertime
		->field("op_unususltime.uid as uid,op_unususltime.clockdate as clockdate,op_unususltime.time as clocktime")
		
		->where("op_unususltime.id = $clockid")
	    ->select();
		//echo $userdetails->getLastSql();
		$this->assign('clockinfo',$info[0]);
		$this->display();
    }
	
	
	
	
	
	public function time_modify_do(){
	
	$clockid=$this->_get('clockid');
	$clockdate = $this->_post('clockdate');
	$clocktime = $this->_post('clocktime');
	
	$clockModify = M('unususltime');
	
	$unususl =  M('unusualtime');
	
	    $clockinfo=$clockModify->getById($clockid);
		
		
		
	    $staffinfo['clockdate'] =  $clockdate;
		$staffinfo['clocktime'] = $clocktime;
		$staffinfo['static'] = "正常";
	
		
		$rs = $clockModify->save($staffinfo);
		
		//echo $checkdetails->getLastSql();
		
	if(!$rs) {
			echo '修改失败，请重试！';
			exit;	
		}
		

		echo 'ok';
		
		
		
	
	
	}
	
	
}

?>