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
	//排班列表
	public function worktimelist() {
    	$staffModel = M('staffinfo');
    	$uid = $_SESSION['uid'];
    	$teamid = $staffModel->getFieldByUid($uid,'teamid');
    	$teamModel = M('teaminfo');
		$teamname= $teamModel->getFieldByTid($teamid,'teamname');
		$this->assign("teamid",$teamid);
    	$this->assign("teamname",$teamname);
    	$this->display();
    }
	//获取排班列表
	public function fetchWorktimeList() {
		$page = $this->_post('page');
		if($page<1) $page=1;
		$rows = $this->_post('rows');
		if($rows<1) $rows=10;
		$start = ($page-1)*$rows;

		$teamid = $this->_post('teamid');
    	$Model = M('worktime');
    	$cc = $Model->where("teamid=$teamid")->count();
    	$rs = $Model->join("op_teaminfo ON op_worktime.teamid = op_teaminfo.tid")->where("teamid=$teamid")->order('workdate1 desc')->limit("$start,$rows")->select();
    	echo dataToJson($rs,$cc);
    }
    //修改窗口
    public function w_worktimeedit() {
    	$id = $this->_get('id');
    	$Model = M('worktime');
    	$rs = $Model->join('op_teaminfo ON op_worktime.teamid = op_teaminfo.tid')->where("id = $id")->select();
    	$this->assign("worktime",$rs[0]);
    	$this->display();
    }
    //执行修改
    public function doWorktimeEdit() {
    	$id = $this->_get('id');
    	$startdate = $this->_get('startdate');
    	$enddate = $this->_get('enddate');
    	$start = $this->_get('start');
    	$end = $this->_get('end');
    	$Model = M('worktime');
    	$row = $Model->getById($id);
    	$row['workdate1'] = $startdate;
    	$row['workdate2'] = $enddate;
    	$row['worktime1'] = $start;
    	$row['worktime2'] = $end;
    	$rs = $Model->save($row);
    	if (!$rs) {
    		echo '修改失败，请重试！';
    	} else {
    		echo 'ok';
    	}
    }
    //新增窗口
    public function w_worktimenew() {
    	$teamid = $this->_get('teamid');
    	$Model = M('teaminfo');
    	$teamname = $Model->getFieldByTid($teamid,'teamname');
    	$this->assign("teamid",$teamid);
    	$this->assign("teamname",$teamname);
    	$this->display();
    }
    //处理新增
    public function doWorktimeNew() {
    	$tid = $this->_get('tid');
    	$startdate = $this->_get('startdate');
    	$enddate = $this->_get('enddate');
    	$start = $this->_get('start');
    	$end = $this->_get('end');
    	if ($tid<1) {
    		echo '已经没有可以添加的组了！';
    		return;
    	}
    	$Model = M('worktime');

    	//$rs = $Model->select("workdate1<='$startdate' AND workdate2>='$enddate'");

    	$row['teamid'] = $tid;
    	$row['workdate1'] = $startdate;
    	$row['workdate2'] = $enddate;
    	$row['worktime1'] = $start.":00";
    	$row['worktime2'] = $end.":00";
    	$rs = $Model->add($row);
    	if (!$rs) {
    		echo '新增失败，请重试！';
    	} else {
    		echo 'ok';
    	}
    }
    //处理删除
    public function doWorktimeDel() {
    	$id = $this->_get('id');
    	$Model = M('worktime');
    	$rs = $Model->where("id = $id")->delete();
    	if (!$rs) {
    		echo '删除失败，请重试！';
    	} else {
    		echo 'ok';
    	}
    }


	/****************************************************************************************/
	
}






?>