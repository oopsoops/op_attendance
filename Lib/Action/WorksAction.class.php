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
		//		$mail->Mailer="stmp";
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Port = 25; 
				$mail->CharSet = "utf-8";
				$mail->Host = "smtp.163.com";
				$mail->Username = "superdragon@163.com";
				$mail->Password = "13579superk24680";
				$mail->AddReplyTo("superdragon@163.com","系统");
				$mail->From = "superdragon@163.com";
				$mail->AddAddress($email);
				$mail->Subject = "工作申请审批提醒";
				$mail->Body = "你有一个工作审批，请登录考勤管理系统查看。";
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
			
			$Model=M('userinfo');
			$tidrow=$Model->getByUid($uid);
			$tid=$tidrow['usertypeid'];
			$Model=M('usertype');
			$powerrow=$Model->getByTid($tid);
			$power=$powerrow['power'];
			$status=1;
			if($power==1||$power==3||$power==7){
				$model=M('userinfo');
				$row=$model->getByUid($uid);
				$departmentid=$row['departmentid'];
				$rows=$model->field("op_userinfo.uid,op_userinfo.email")
				->join('op_usertype ON op_userinfo.usertypeid=op_usertype.tid ')
				->where("op_usertype.power=4")->select();
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
				$model=M('userinfo');
				$row=$model->getByUid($uid);
				$departmentid=$row['departmentid'];
				$rows=$model->field("op_userinfo.uid,op_userinfo.email")
				->join('op_usertype ON op_userinfo.usertypeid=op_usertype.tid ')
				->where("op_usertype.power=2")->select();
				$status=2;
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
			}
			
			$model=M('vacationstatus');
			$rs=$model->add($astatus);
			if(!$rs) {
							$model->rollback();
							echo '信息添加失败，请重试！';
							exit;	
			}
			
			$model->commit();
			$this->sendMail($email);
			echo "1";
			
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
				->where("op_usertype.power=4")->select();
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
			$where="status=3  and isrejected!='1' and isapproved!='1' and transtype='".$typeid."' ";
		}else{
			$where="status=1 and departmanagerid='".$uid."' and isrejected!='1' and isapproved!='1' and transtype='".$typeid."' ";
		}
		
		
		$model=M('vacationstatus');
		$num=$model->where($where)->count();
	//	echo $model->where($where)->getLastSql();
		$list=$model->field("op_vacationstatus.uid,op_vacationstatus.begintime,op_vacationstatus.endtime,op_vacationstatus.applytime,op_department.departmentname,
op_vacationstatus.holiday as holidaytype,op_vacationstatus.fee,op_vacationstatus.transpot as days,		op_teaminfo.teamname,op_staffinfo.username,op_vacationstatus.id,op_vacationstatus.fee,op_vacationstatus.transpot,op_vacationstatus.holiday,op_vacationstatus.begindate,op_vacationstatus.enddate")
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
		$num=$model->where($where)->count();
	//	echo $model->where($where)->getLastSql();
		$list=$model->field("distinct teamname,op_vacationstatus.begintime,op_vacationstatus.endtime,op_vacationstatus.applytime,op_department.departmentname,	op_vacationstatus.begindate,op_vacationstatus.enddate,reason")
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
		$rs['isrejected']=1;
		$result=$model->save($rs);
		if(!$result){
			echo "驳回失败,请重试！";
			exit;
		}
		else{
			$data="1";
			echo $data;
		}
	}
	
	public function rejectallTrans(){
		$vid=$this->_post('applytime');
		$model=M('vacationstatus');
		$rs=$model->getByApplytime($vid);
		$rs['isrejected']=1;
		$result=$model->save($rs);
		if(!$result){
			echo "驳回失败,请重试！";
			exit;
		}
		else{
			$data="1";
			echo $data;
		}
	}

/*****************************************驳回申请end*******************************************/		
/*****************************************批准申请begin*******************************************/
	public function approveTrans(){
		
		$id=$this->_get('vid');
		
		$model=M('vacationstatus');
		$rs=$model->getById($id);
		$rs['isapproved']=1;
		$result=$model->save($rs);
		if(!$result){
			echo "操作失败,请重试！";
			exit;
		}
		else{
			$data="1";
			echo $data;
		}
	}
	
	public function approveallTrans(){
		
		$id=$this->_post('applytime');
		
		$model=M('vacationstatus');
		$rs=$model->getByApplytime($id);
		$rs['isapproved']=1;
		$result=$model->save($rs);
		if(!$result){
			echo "操作失败,请重试！";
			exit;
		}
		else{
			$data="1";
			echo $data;
		}
	}


/*****************************************批准申请end*******************************************/		
	
/*****************************************提交hr begin*******************************************/	
	
	public function sub2hr(){
		$id=$this->_get('vid');
	//	echo $id;
		$model=M('vacationstatus');
		$rs=$model->getById($id);
		$rs['status']=2;
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
			$data="1";
			echo $data;
		}
		
	}	
	
/*****************************************提交hr end*******************************************/	
/*****************************************提交boss begin*******************************************/	
	public function sub2boss(){
		$id=$this->_get('vid');
	//	echo $id;
		$model=M('vacationstatus');
		$rs=$model->getById($id);
		$rs['status']=3;
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
			$data="1";
			echo $data;
		}
		
	}	





/*****************************************提交boss end*******************************************/	
/*****************************************申请查询 begin*******************************************/	

	public function applyQuery(){
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
		$list=$model->field("op_vacationstatus.begindate,op_vacationstatus.uid,op_vacationstatus.enddate,op_vacationstatus.begintime,op_vacationstatus.endtime,op_vacationstatus.isapproved,op_vacationstatus.isrejected,op_vacationstatus.transtype,op_staffinfo.username,op_vacationtype.typemc,op_vacationstatus.applytime")
		->join("op_staffinfo on op_vacationstatus.uid=op_staffinfo.uid")
		->join("op_vacationtype on op_vacationstatus.transtype=op_vacationtype.typedm")
		->where($where)
		->order("op_vacationstatus.applytime desc")
		->limit("$start,$rows")
		->select();
//		echo $model->where($where)->getLastSql();
		echo dataToJson($list,$num);
	}

/*****************************************提交hr end*******************************************/	
	
}
	
	
	
		

?>