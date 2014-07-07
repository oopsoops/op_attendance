<?php


class BossAction extends Action {

    public function boss_searchstaff() {
	
		$sessionuid = $_SESSION['uid'];
		
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
	
		$info = M('staffinfo');
		
		$cc = $info->select();
		
		$rs = $info->field('op_staffinfo.uid as uid,op_staffinfo.username as  username ,op_staffinfo.phone as phone,op_department.departmentname as department')
		->join('op_department ON op_staffinfo.departmentid = op_department.did')
		->order('op_staffinfo.uid desc')
		->limit("$start,$rows")
		->select();
	//echo $info->getLastSql();
	  echo dataToJson($rs,$cc);
	}
	
	}
 ?>