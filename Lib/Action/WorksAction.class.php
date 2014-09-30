<?php 
	
	Vendor('PHPMailer.classphpmailer');
	
		
	
	class WorksAction extends Action{
		
		
/*****************************************员工事务申请页面begin*****************************************/

		//获取本产线员工名单
		public function transitionApply(){
			$Model=M('staffinfo');
			$uid=$_SESSION['uid'];
			$tids=$Model->getByUid($uid);
			$tid=$tids['teamid'];
			$rs=$Model->where('teamid="'.$tid.'"')->select();
			$this->assign('teamlist',$rs);
			$pow=M('usertype');
			$power=$pow->getByTid($tids['usertypeid']);
			$this->assign('power',$power['power']);
			
			$this->display();
		}
		//邮件发送
		public function sendMail($email){
			try { 
				$mail=new PHPMailer();
				$mail->Mailer="stmp";
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Port = 25; 
				$mail->CharSet = "utf-8";
				$mail->Host = "smtp.163.com";
				$mail->Username = "superdragon@163.com";
				$mail->Password = "13579superk24680";
				$mail->AddReplyTo("superdragon@163.com","系统");
				$mail->From = "superdragon@163.com";
				$mail->FromName="系统";
				$mail->AddAddress($email);
			//	$mail->AddAddress("732121339@qq.com");
				$mail->Subject = "工作申请审批提醒";
				$mail->Body = "你有一个工作审批，请登录考勤管理系统查看。";
				$mail->IsHTML(true);
				$mail->Send();
			} catch (phpmailerException $e) { 
					echo "邮件发送失败：".$e->errorMessage(); 
			} 
			
		}
		public function sendRemindMail($email,$content){
			try { 
				$mail=new PHPMailer();
				$mail->Mailer="stmp";
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Port = 25; 
				$mail->CharSet = "utf-8";
				$mail->Host = "smtp.163.com";
				$mail->Username = "superdragon@163.com";
				$mail->Password = "13579superk24680";
				$mail->AddReplyTo("superdragon@163.com","系统");
				$mail->From = "superdragon@163.com";
				$mail->FromName="系统";
				$mail->AddAddress($email);
			//	$mail->AddAddress("732121339@qq.com");
				$mail->Subject = "工作申请审批状态提醒";
				$mail->Body = $content;
				$mail->IsHTML(true);
				$mail->Send();
			} catch (phpmailerException $e) { 
					echo "邮件发送失败：".$e->errorMessage(); 
			} 
		}
		
		
		
		//申请事务提交
		public function dealApply(){
			
			$begindate=$this->_post('begindate');
			$enddate=$this->_post('enddate');
			$begintime=$this->_post('begintime');
			$endtime=$this->_post('endtime');
			$reason=$this->_post('reason');
			$transdm=$this->_post('transdm');
			$transpot=$this->_post('transpot');
			$fee=$this->_post('fee');
			$holiday=$this->_post('holiday');
			$id=$this->_post('uid');
			if($id==""){
				$uid = $_SESSION['uid'];
			}else
				$uid=$id;
			
			$Model=M('staffinfo');
			$tidrow=$Model->getByUid($uid);
			$tid=$tidrow['usertypeid'];
			$Model=M('usertype');
			$powerrow=$Model->getByTid($tid);
			$power=$powerrow['power'];
			$status=1;
			$email="";
			if($power==1||$power==3||$power==7){
				$model=M('staffinfo');
				$row=$model->getByUid($uid);
				$departmentid=$row['departmentid'];
				$model=M('staffinfo');
				$rows=$model->field("op_staffinfo.uid,op_staffinfo.email")
				->join('op_usertype ON op_staffinfo.usertypeid=op_usertype.tid ')
				->where("op_usertype.power=4 and op_staffinfo.departmentid='".$departmentid."'")->select();
				$managerid=$rows[0]['uid'];
				$email=$rows[0]['email'];
			}
			if($power==2){
				$model=M('staffinfo');
				$rs=$model->field("op_staffinfo.email")
				->join("op_usertype on op_staffinfo.usertypeid=op_usertype.tid")
				->where("op_usertype.power=5")
				->select();
				$status=3;
				$email=$rs[0]['email'];
			}
			if($power==4){
				$model=M('staffinfo');
				$row=$model->getByUid($uid);
				$departmentid=$row['departmentid'];
				$rows=$model->field("op_staffinfo.uid,op_staffinfo.email")
				->join('op_usertype ON op_staffinfo.usertypeid=op_usertype.tid ')
				->where("op_usertype.power=5")->select();
				$status=3;
				$email=$rows[0]['email'];
				
			}
			$astatus['uid']=$uid;
			$astatus['transtype']=$transdm;
			$astatus['begindate']=$begindate;
			$astatus['begintime']=$begintime;
			$astatus['status']=$status;
			$astatus['enddate']=$enddate;
			$astatus['endtime']=$endtime;
			$astatus['applytime']=date('Y-m-d H:i:s');
			if($managerid!=""){
				$astatus['departmanagerid']=$managerid;
			}
			
			if($reason!=""){
				$astatus['reason']=$reason;
			}
			if($fee!=""){
				$astatus['fee']=$fee;
			}
			if($transpot!=""){
				$astatus['transpot']=$transpot;
			}
			if($holiday!=""){
				$astatus['holiday']=$holiday;
				$day=$this->getDaysByPb($begindate,$enddate,$begintime,$endtime,$uid);
		//		$day=$this->getDaysByPb("2014-09-25","2014-09-25","08:00","17:00","1003");
			}
			if($holiday=="婚假"||$holiday=="产假"){
				$days=30;
			}
			if($day!=""){
				$astatus['days']=$day;
			//	$astatus['holiday']="333";
			}
			
			$this->sendMail($email);
			$model=M('vacationstatus');
			$rs=$model->add($astatus);
			echo "1";
	//		$this->sendMail($email);
		}
		
		public function allJbApply(){
			$begindate=$this->_post('begindate');
			$enddate=$this->_post('enddate');
			$begintime=$this->_post('begintime');
			$endtime=$this->_post('endtime');
			$reason=$this->_post('reason');
			$transdm=$this->_post('transdm');
			$id=$this->_post('uid');
			if($id==""){
				$uid = $_SESSION['uid'];
			}else
				$uid=$id;
			$model=M('staffinfo');
			$row=$model->getByUid($uid);
			$tid=$row['teamid'];
			$did=$row['departmentid'];
			$rows=$model->field("op_staffinfo.uid")
				->join('op_usertype ON op_staffinfo.usertypeid=op_usertype.tid ')
				->where("op_usertype.power=4 and op_staffinfo.departmentid='".$did."'")->select();
			$manager=$rows[0]['uid'];
			
			$num=$model->where("teamid='".$tid."'")->count();
			$rows=$model->where("teamid='".$tid."'")->select();
			for($i=0;$i<$num;$i++){
				$uid=$rows[$i]['uid'];
				$astatus['uid']=$uid;
				$astatus['transtype']=$transdm;
				$astatus['begindate']=$begindate;
				$astatus['begintime']=$begintime;
				$astatus['status']="1";
				$astatus['enddate']=$enddate;
				$astatus['endtime']=$endtime;
				$astatus['applytime']=date('Y-m-d H:i:s');
				$astatus['departmanagerid']=$manager;
				$astatus['reason']=$reason;
				$model=M('vacationstatus');
				$rs=$model->add($astatus);
			}
			echo "1";
			
		
		}
/*****************************************员工事务申请页面end*****************************************/

/*****************************************审批页面begin*****************************************/

	public function jbAproval(){
		$uid = $_SESSION['uid'];
		$model=M('staffinfo');
		$rs=$model->field("op_usertype.power")
		->join("op_usertype on op_staffinfo.usertypeid=op_usertype.tid")
		->where("uid='".$uid."'")
		->select();
		$power=$rs[0]['power'];
		$this->assign('jbpower',$power);
		$this->display();
	}
	public function ccApproval(){
		$uid = $_SESSION['uid'];
		$model=M('staffinfo');
		$rs=$model->field("op_usertype.power")
		->join("op_usertype on op_staffinfo.usertypeid=op_usertype.tid")
		->where("uid='".$uid."'")
		->select();
		$power=$rs[0]['power'];
		$this->assign('ccpower',$power);
		$this->display();
	}
	public function qjApproval(){
		$uid = $_SESSION['uid'];
		$model=M('staffinfo');
		$rs=$model->field("op_usertype.power")
		->join("op_usertype on op_staffinfo.usertypeid=op_usertype.tid")
		->where("uid='".$uid."'")
		->select();
		
		$power=$rs[0]['power'];
		$this->assign('qjpower',$power);
		$this->display();
	}
	
	public function getTransitionByType(){
		$uid = $_SESSION['uid'];
		$typeid=$this->_get('tid');
		$page = $this->_post('page');
		if($page<1) $page=1;
		$rows = $this->_post('rows');
		if($rows<1) $rows=10;
		$start = ($page-1)*$rows;
		
		$model=M('staffinfo');		
		$rx=$model->field("op_usertype.power")
		->join('op_usertype ON op_staffinfo.usertypeid=op_usertype.tid ')
		->where("op_staffinfo.uid=".$uid)->select();
		$power=$rx[0]['power'];
		if($power==2){
			$status=2;
			$where="(status=2 or (status=1 and departmanagerid='".$uid."')) and isrejected!='1' and isapproved!='1' and transtype='".$typeid."' ";
		}
		else if($power==5){
			$status=3;
			$where="(status=3 or (bossid='".$uid."' and status=2)) and isrejected!='1' and isapproved!='1' and transtype='".$typeid."' ";
		}else{
			$where="status=1 and departmanagerid='".$uid."' and isrejected!='1' and isapproved!='1' and transtype='".$typeid."' ";
		}
		
		
		$model=M('vacationstatus');
		$num=$model->where($where)->count();
	//	echo $model->where($where)->getLastSql();
		$list=$model->field("op_vacationstatus.uid,op_vacationstatus.begintime,op_vacationstatus.endtime,op_vacationstatus.applytime,op_department.departmentname,
op_vacationstatus.holiday as holidaytype,op_vacationstatus.fee,op_vacationstatus.transpot as days,op_vacationstatus.days as nums,op_usertype.power,	op_teaminfo.teamname,op_staffinfo.username,op_vacationstatus.id,op_vacationstatus.fee,op_vacationstatus.status,op_vacationstatus.transpot,op_vacationstatus.holiday,op_vacationstatus.begindate,op_vacationstatus.enddate")
		->join("op_staffinfo ON op_vacationstatus.uid=op_staffinfo.uid")
		->join("op_teaminfo ON op_staffinfo.teamid=op_teaminfo.tid")
		->join("op_department ON op_staffinfo.departmentid=op_department.did")
		->join("op_usertype ON op_staffinfo.usertypeid=op_usertype.tid")
		->where($where)
		->order("op_vacationstatus.applytime desc")
		->limit("$start,$rows")
		->select();
	//	echo $model->where($where)->getLastSql();
		echo dataToJson($list,$num);
		
	}
	
	
	
	public function jbAllApply(){
		$uid = $_SESSION['uid'];
		$typeid=$this->_get('tid');
		$page = $this->_post('page');
		if($page<1) $page=1;
		$rows = $this->_post('rows');
		if($rows<1) $rows=10;
		$start = ($page-1)*$rows;
		
		
		
		$where="status=1 and departmanagerid='".$uid."' and isrejected!='1' and isapproved!='1' and transtype='".$typeid."' ";
		$model=M('vacationstatus');
		$num=$model->field("distinct teamname,op_staffinfo.teamid,op_vacationstatus.begintime,op_vacationstatus.endtime,op_vacationstatus.applytime,op_department.departmentname,	op_vacationstatus.begindate,op_vacationstatus.enddate,reason")
		->join("op_staffinfo ON op_vacationstatus.uid=op_staffinfo.uid")
		->join("op_teaminfo ON op_staffinfo.teamid=op_teaminfo.tid")
		->join("op_department ON op_staffinfo.departmentid=op_department.did")
		->where($where)->count();
		
		$list=$model->field("distinct teamname,op_staffinfo.teamid,op_vacationstatus.begintime,op_vacationstatus.endtime,op_vacationstatus.applytime,op_department.departmentname,	op_vacationstatus.begindate,op_vacationstatus.enddate,reason")
		->join("op_staffinfo ON op_vacationstatus.uid=op_staffinfo.uid")
		->join("op_teaminfo ON op_staffinfo.teamid=op_teaminfo.tid")
		->join("op_department ON op_staffinfo.departmentid=op_department.did")
		->where($where)
		->order("op_vacationstatus.applytime desc")
		->limit("$start,$rows")
		->select();
	//	echo $model->where($where)->getLastSql();
		echo dataToJson($list,$num);
		
	}
	
	

/*****************************************审批页面end*****************************************/

/*****************************************事务申请详情页面begin*****************************************/

	public function transitionDetail(){
		$vid=$this->_get('vid');
		$model=M('vacationstatus');
		$detail=$model->
		field("op_vacationstatus.reason,op_vacationstatus.begintime,op_vacationstatus.begindate,op_vacationstatus.enddate,op_vacationstatus.endtime,op_vacationstatus.applytime,op_staffinfo.username")
		->join("op_staffinfo ON op_vacationstatus.uid=op_staffinfo.uid")
		->where("op_vacationstatus.id='".$vid."'")->select();
		$this->assign('detail',$detail);
		
		
		$this->display();
	}
	public function ccDetail(){
		$vid=$this->_get('vid');
		$model=M('vacationstatus');
		$detail=$model->
		field("op_vacationstatus.reason,op_vacationstatus.begintime,op_vacationstatus.begindate,op_vacationstatus.enddate,op_vacationstatus.endtime,op_vacationstatus.applytime,op_staffinfo.username,op_staffinfo.holiday as days,op_vacationstatus.holiday as holiday")
		->join("op_staffinfo ON op_vacationstatus.uid=op_staffinfo.uid")
		->where("op_vacationstatus.id='".$vid."'")->select();
		$this->assign('detail',$detail);
		
		
		$this->display();
	}
	
	
	

/*****************************************事务申请页面详情end*******************************************/

/*****************************************驳回申请begin*******************************************/
	public function rejectTrans(){
		$vid=$this->_get('vid');
		$model=M('vacationstatus');
		$rs=$model->getById($vid);
		$uid=$rs['uid'];
		
		$rs['isrejected']=1;
		$result=$model->save($rs);
		
		if(!$result){
			echo "驳回失败,请重试！";
			exit;
		}
		else{
			$model=M('staffinfo');
			$row=$model->getByUid($uid);
			$email=$row['email'];
			$content="你的工作申请已被驳回，请登录考勤系统查看。";
			$this->sendRemindMail($email,$content);
			$data="1";
			echo $data;
		}
	}
	
	public function rejectallTrans(){
	//	$begindate=$this->_post('begindate');
		$tid=$this->_post('teamid');
		$model=M('vacationstatus');
		$where=" op_staffinfo.teamid='".$tid."'";
		$num=$model->join("op_staffinfo on op_vacationstatus.uid=op_staffinfo.uid ")->where($where)->count();
		$vidrows=$model->field("op_vacationstatus.id")->join("op_staffinfo on op_vacationstatus.uid=op_staffinfo.uid ")->where($where)->select();
		for($i=0;$i<$num;$i++){
			if($vidrows[$i]['id']==""){
				break;
			}
			$id=$vidrows[$i]['id'];
			$rs=$model->getById($id);
			$rs['isrejected']=1;
			$result=$model->save($rs);
		}		
		$data="1";
		echo $data;
		
	}

/*****************************************驳回申请end*******************************************/		
/*****************************************批准申请begin*******************************************/
	public function approveTrans(){
		
		$id=$this->_get('vid');
		
		$model=M('vacationstatus');
		$rs=$model->getById($id);
		$uid=$rs['uid'];
		$rs['isapproved']=1;
		$result=$model->save($rs);
		if(!$result){
			echo "操作失败,请重试！";
			exit;
		}
		else{
			$model=M('staffinfo');
			$row=$model->getByUid($uid);
			$email=$row['email'];
			$content="你的工作申请已批准，请登录考勤系统查看详情。";
			$this->sendRemindMail($email,$content);
			$data="1";
			echo $data;
		}
	}
	
	public function approveallTrans(){
		
	//	$begindate=$this->_post('begindate');
		$tid=$this->_post('teamid');
		$model=M('vacationstatus');
		$where=" op_staffinfo.teamid='".$tid."'";
		$num=$model->join("op_staffinfo on op_vacationstatus.uid=op_staffinfo.uid ")->where($where)->count();
		$vidrows=$model->field("op_vacationstatus.id")->join("op_staffinfo on op_vacationstatus.uid=op_staffinfo.uid ")->where($where)->select();
		for($i=0;$i<$num;$i++){
			if($vidrows[$i]['id']==""){
				break;
			}
			$id=$vidrows[$i]['id'];
			$rs=$model->getById($id);
			$rs['isapproved']=1;
			$result=$model->save($rs);
		}		
		$data="1";
		echo $data;
	}


/*****************************************批准申请end*******************************************/		
	
/*****************************************提交hr begin*******************************************/	
	
	public function sub2hr(){
		$id=$this->_get('vid');
		$model=M('vacationstatus');
		$hruid=$this->getHrUid();
		$rs=$model->getById($id);
		$uid=$rs['uid'];
		$rs['status']=2;
		$rs['hrmanagerid']=$hruid;
		$result=$model->save($rs);
		if(!$result){
			echo "操作失败,请重试！";
			exit;
		}
		else{
			$model=M('staffinfo');
			$rs=$model->field("op_staffinfo.email")
			->join("op_usertype on op_staffinfo.usertypeid=op_usertype.tid")
			->where("op_usertype.power=2")
			->select();
			$email=$rs[0]['email'];
			$this->sendMail($email);
			$model=M('staffinfo');
			$row=$model->getByUid($uid);
			$email=$row['email'];
			$content="你的工作申请已提交人事经理审批。";
			$this->sendRemindMail($email,$content);
			$data="1";
			echo $data;
		}
		
	}	
	
/*****************************************提交hr end*******************************************/	
/*****************************************提交boss begin*******************************************/	
	public function sub2boss(){
		$id=$this->_get('vid');
		$model=M('vacationstatus');
		$rs=$model->getById($id);
		$uid=$rs['uid'];
		$bossid=$this->getBossUid();
		$rs['status']=3;
		$rs['bossid']=$bossid;
		$result=$model->save($rs);
		if(!$result){
			echo "操作失败,请重试！";
			exit;
		}
		else{
			$model=M('staffinfo');
			$rs=$model->field("op_staffinfo.email")
			->join("op_usertype on op_staffinfo.usertypeid=op_usertype.tid")
			->where("op_usertype.power=5")
			->select();
			$email=$rs[0]['email'];
			$this->sendMail($email);
			$model=M('staffinfo');
			$row=$model->getByUid($uid);
			$email=$row['email'];
			$content="你的工作申请已提交老板审批。";
			$this->sendRemindMail($email,$content);
			$data="1";
			echo $data;
		}
		
	}	
	
	public function getHrUid(){
		$model=M('staffinfo');
		$rs=$model->field("op_staffinfo.uid")
			->join("op_usertype on op_staffinfo.usertypeid=op_usertype.tid")
			->where("op_usertype.power=2")
			->select();
			$uid=$rs[0]['uid'];
			return $uid;
	}
	public function getBossUid(){
		$model=M('staffinfo');
		$rs=$model->field("op_staffinfo.uid")
			->join("op_usertype on op_staffinfo.usertypeid=op_usertype.tid")
			->where("op_usertype.power=5")
			->select();
			$uid=$rs[0]['uid'];
			return $uid;
	}




/*****************************************提交boss end*******************************************/	
/*****************************************申请查询 begin*******************************************/	

	public function applyQuery(){
		$this->display();
	}
	public function myApprove(){
		$this->display();
	}
	
	
	
	public function getMyApply(){
		$uid = $_SESSION['uid'];
		$page = $this->_post('page');
		if($page<1) $page=1;
		$rows = $this->_post('rows');
		if($rows<1) $rows=10;
		$start = ($page-1)*$rows;
		$model=M('vacationstatus');
		$where="op_vacationstatus.uid='".$uid."' ";
		$num=$model->where($where)->count();
		$list=$model->field("op_vacationstatus.begindate,op_vacationstatus.uid,op_vacationstatus.enddate,op_vacationstatus.begintime,op_vacationstatus.endtime,op_vacationstatus.isapproved,op_vacationstatus.isrejected,op_vacationstatus.transtype,op_staffinfo.username,op_vacationtype.typemc,op_vacationstatus.applytime,op_vacationstatus.status")
		->join("op_staffinfo on op_vacationstatus.uid=op_staffinfo.uid")
		->join("op_vacationtype on op_vacationstatus.transtype=op_vacationtype.typedm")
		->where($where)
		->order("op_vacationstatus.applytime desc")
		->limit("$start,$rows")
		->select();
//		echo $model->where($where)->getLastSql();
		echo dataToJson($list,$num);
	}
	
	public function getMyApprove(){
		$uid = $_SESSION['uid'];
		
		$page = $this->_post('page');
		if($page<1) $page=1;
		$rows = $this->_post('rows');
		if($rows<1) $rows=10;
		$start = ($page-1)*$rows;
		
		$model=M('staffinfo');
		$row=$model->getByUid($uid);
		$usertypeid=$row['usertypeid'];
		$model=M('usertype');
		$row=$model->getByTid($usertypeid);
		$power=$row['power'];
		$model=M('vacationstatus');
		$where="";
		if($power==2){
			$where="op_vacationstatus.hrmanagerid='".$uid."' or op_vacationstatus.departmanagerid='".$uid."'";
		}
		if($power==4){
			$where="op_vacationstatus.departmanagerid='".$uid."'";
		}
		if($power==5){
			$where="op_vacationstatus=3 or op_vacationstatus.bossid='".$uid."'";
		}
		$num=$model->where($where)->count();
		$list=$model->field("op_vacationstatus.begindate,op_vacationstatus.uid,op_vacationstatus.enddate,op_vacationstatus.begintime,op_vacationstatus.endtime,op_vacationstatus.isapproved,op_vacationstatus.isrejected,op_vacationstatus.transtype,op_staffinfo.username,op_vacationtype.typemc,op_vacationstatus.applytime,op_vacationstatus.status")
		->join("op_staffinfo on op_vacationstatus.uid=op_staffinfo.uid")
		->join("op_vacationtype on op_vacationstatus.transtype=op_vacationtype.typedm")
		->where($where)
		->order("op_vacationstatus.applytime desc")
		->limit("$start,$rows")
		->select();
	//	echo $model->getLastSql();
		echo dataToJson($list,$num);
	}

/*****************************************提交hr end*******************************************/	

/*****************************************根据排版设置计算请假天数begin*******************************************/	
	public function getDaysByPb($begindate,$enddate,$begintime,$endtime,$uid){
	//	$begindate="2014-09-08";
	//	$enddate="2014-09-28";
	//	$begintime="08:00";
	//	$endtime="17:00";
		$model=M('staffinfo');
		$row=$model->getByUid($uid);		
		$tid=$row['teamid'];
		$model=M('worktime');
		$where="((workdate1<='".$begindate."' and workdate2>='".$begindate."' and workdate2<='".$enddate."')or(workdate1<='".$begindate."' and workdate2>='".$enddate."')or(workdate1<='".$enddate."' and workdate2>='".$enddate."' and workdate1>='".$begindate."')or(workdate1>='".$begindate."' and workdate2<='".$enddate."'))and teamid='".$tid."'";
		$worktimeRow=$model->where($where)->select();
		$length=$model->where($where)->count();
		if(!$worktimeRow){
			return 0;
		}
		$date=$begindate;
		$days=0;
		while($date<=$enddate){
			//如果是开始那天就要计算是全天还是半天
			if($date==$begindate){
				$rows=$model->where("workdate1<='".$date."' and workdate2>='".$date."'")->select();
				$end=$rows[0]['worktime2'];
				$end="2014-01-01 ".$end;
				$begin="2014-01-01 ".$begintime;
				//如果结束的时间比开始时间小，说明是跨天，则减少一天
				if($begin>$end){
					$days--;
				}
				$rows=$model->field("TIMESTAMPDIFF(hour,'".$begin."','".$end."')as hour")->where("workdate1<='".$date."' and workdate2>='".$date."'")->select();
				if(!$rows){
					return 0;
				}
				$hour=$rows[0]['hour'];
				if($hour<0){
					$hour+=24;
				}
				if($hour<=4){
					$days+=0.5;
				}else{
					$days+=1;
				}
			}
			//如果是结束那天且开始和结束不是一天
			else if($date==$enddate&&$begindate!=$enddate){
				$rows=$model->where("workdate1<='".$date."' and workdate2>='".$date."'")->select();
				$begin=$rows[0]['worktime1'];
				$begin="2014-01-01 ".$begin;
				$end="2014-01-01 ".$endtime;
				$rows=$model->field("TIMESTAMPDIFF(hour,'".$begin."','".$end."')as hour")->where("workdate1<='".$date."' and workdate2>='".$date."'")->select();
				if(!$rows){
					return 0;
				}
				$hour=$rows[0]['hour'];
				if($hour<0){
					$hour+=24;
				}
				if($hour<=4){
					$days+=0.5;
				}else{
					$days+=1;
				}
			}
			
			//既不是结束也不是开始
			else if ($date>$begindate&&$date<$enddate){
				for($i=0;$i<$length;$i++){
					if($date<=$worktimeRow[$i]['workdate2']&&$date>=$worktimeRow[$i]['workdate1']){
						$days++;
					}
				}
			}
			//变为下一天
			$date=$this->getNextDay($date);
		}
		return $days;
		
		
	
	}
	
	//得到日期的下一天
	public function getNextDay($date){
		$model=M('usertype');
		$rows=$model->field("date_add('".$date."',interval 1 day)as day")->select();
		$newDate=$rows[0]['day'];
		return $newDate;
	}

/*****************************************根据排版设置计算请假天数begin*******************************************/	
	
}
	
	
	
		

?>