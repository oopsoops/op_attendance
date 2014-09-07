<?php
vendor('Zend.ExcelToArrary');//导入excelToArray类
	    	Vendor('Zend.Excel.PHPExcel');//引入phpexcel类(注意你自己的路径)   
        Vendor('Zend.Excel.PHPExcel.IOFactory');
class HrAction extends Action {

    public function analyse_clocktime() {
		$Model = M('config');
		$spacetime = $Model->getFieldById('spacetime',1);
		$Model = M('worktime');
		$worktime = $Model->select();
		$Model = M('userinfo');
		$userlist = $Model->field("uid")->select();
		$Model = M('clocktime');
		//以uid分别获取打卡信息
		for($i=0;$i<count($userlist);$i++) {
			$uid = $userlist[$i]['uid'];
			$uid_clocktime = $Model->where('uid="'.$uid.'"')->order('clocktime')->select();
			//根据uid判断
			for($j=0;$j<count($uid_clocktime);$j++) {
				
			}
		}
    }
	
		//excel到数据库
	public function doexcel()
	{	
		$tmp_file = $_FILES ['import_xls'] ['tmp_name'];
		
		$file_types = explode ( ".", $_FILES ['import_xls'] ['name'] );
		
		$file_type = $file_types [count ( $file_types ) - 1];
		
		$import_begin_time=$this->_post('import_begin_time');
		
		$import_end_time=$this->_post('import_end_time');
		$kucun=M('clocktime');
		$kucun->where("uid is not null")->delete();
		
			if($import_begin_time==''||$import_end_time=='')
				{
						$this->error('开始日期和结束日期不能同时为空！');
			  			 exit();
					}
				
	
		
				
		 if (strtolower ( $file_type ) != "xlsx" && strtolower ( $file_type ) != "xls")              
		 {
			  $this->error ( '不是Excel文件，重新选择' );
			 
			  
		 }
		
		
		$PHPExcel = new PHPExcel();     
		
		$PHPReader = new PHPExcel_Reader_Excel5(); 
		
		
		
		
		$PHPExcel = $PHPReader->load($tmp_file);
	 	
		$currentSheet = $PHPExcel->getSheet(0);
		
		$allColumn = $currentSheet->getHighestColumn();
		
		$allRow = $currentSheet->getHighestRow();
		
		$currentSheet = $PHPExcel->getSheet(0);
		
		$allColumn = $currentSheet->getHighestColumn();
		
		$allRow = $currentSheet->getHighestRow();
		
		$k=0;
		
			for($currentRow = 1; $currentRow<=$allRow; $currentRow++){
	 					
						$cellA =  $currentSheet->getCell('A'.$currentRow)->getValue();
	 				
						 if($cellA instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cellA = $cellA->__toString();  
		 				  }
		   
	 						  $data[$k]['uid'] = $cellA;//创建二维数组

 						$cellB =  $currentSheet->getCell('B'.$currentRow)->getValue();
						
						$jd = GregorianToJD(1, 1, 1970); 
						$celldate = JDToGregorian($jd+intval($cellB)-25569); 
					
	 
							  $dataexplode=explode("/",$celldate);
		 				 
							  $data[$k]['clockdate'] = date("Y-m-d",mktime(0,0,0,$dataexplode[0],$dataexplode[1],$dataexplode[2]));

   						      $cellC =  $currentSheet->getCell('C'.$currentRow)->getValue();
	    	 				
							$t= intval($cellB)+$cellC;
							$n= intval(($t - 25569) * 3600 * 24);
							
							
							
						      $data[$k]['clocktime'] =  gmdate('H:i:s', $n);//date("H:i:s",strtotime($n));
		
  			
  					 $k++;  //for
 
			}//for
         
		// $kucun=M('clocktime');//M方法
		 
		  $result=$kucun->addAll($data);
		  if(!$result)
		  {
			  
			  
			  $this->error('导入数据库失败');
			  exit();
		  }
		  else
		  {
		  	R('Check/checkClock',array($import_begin_time,$import_end_time));
			  $kucun->where("id is not null")->delete();
			  $this->success ( '导入成功' );	
		  }

	
	
	
	}
	

	
	
		/**查询所有人考勤详情********/
	  public function hrfetch_all_attendance() {
		  
		$sessionuid =1002;// $_SESSION['uid'];
		
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
		
		$uid = $this->_post('uid');
		
		$search_chose=$this->_post('hrsearch_chose');
				
		$username = $this->_post('username');
		
		$department=$this->_post('department');
		
		$search_begin_time =  $this->_post('hrsearch_begin_time');
		
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
			$where="$where and op_unusualtime.static ='"."正常"."' ";
			
			}
			else if($search_chose=='hrsearch_no')
			{
				$where="$where and op_unusualtime.static <> '"."正常"."'  ";
				}
		}
		else 
		{
						
			if($search_chose=='hrsearch_yes')
			{
			$where="op_unusualtime.static  ='"."正常"."' ";
			
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
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_teaminfo.tid = op_staffinfo.teamid')
		->where($where)
		 ->count();
	
		 
	    $allattendance=$unusualtime
		->Distinct(true)
		->field("phone,op_unusualtime.uid as uid,op_unusualtime.clocktime as clocktime,op_unusualtime.clockdate as clockdate,op_staffinfo.username as username,op_unusualtime.static as static
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,
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
	
	
	
public function newStaff() {
		//部门
		$department = M('department');
		$category = $department->select();
		$this->assign('category',$category);
		//类型
		$Model = M('usertype');
		$usertype = $Model->where("op_usertype.power<10")->select();
		$this->assign('usertype',$usertype);
		
		//组别
		$team = M('teaminfo');
		$teaminfo = $team->select();
		$this->assign('teaminfo',$teaminfo);
		$this->display();
    }
	
	
	
	public function new_staff_do()
	{
		
		$uid = $this->_post('staffid');
		$Model = M('staffinfo');
		$rs = $Model->getByUid($uid);
		if($rs) {
			echo '该员工已存在！';
			exit;	
		}
		
		$Model = M('staffinfo');
		
		$staffinfo['uid'] = $uid;
		
		$staffinfo['departmentid'] = $this->_post('department');
		
		$staffinfo['usertypeid'] = $this->_post('stafftype');
		
		$staffinfo['username'] = $this->_post('staffname');
		
		$staffinfo['costcenterid'] = $this->_post('costcenter');
		
		$staffinfo['teamid'] = $this->_post('teamid');
				
		$staffinfo['email'] = $this->_post('email');
		
		$staffinfo['entrydate'] = $this->_get('entrytime');
		
		$staffinfo['phone'] = $this->_post('phone');
		
		$loginname = $this->_post('newloginname');
					
		$staffinfo['updatetime'] = date('Y-m-d H:i:s');
		
		if($staffinfo['usertypeid']<=1||$loginname=='')
		{
						$rsstaff = $Model->add($staffinfo);
						
						if(!$rsstaff) {
							//$Model->rollback();
							echo '信息添加失败，请重试！';
							exit;	
						}
					echo 'ok';
			
			
			}
 	
	
		else {
					
					
									$rsa = $Model->getByLoginname($loginname);
									 if($rsa)
									 {
												
										echo 'loginexist';
										exit;	
									 }
													
									
									else 
										{								
																						

											
											$rsend = $Model->add($staffinfo);
											
											if(!$rsend) {
												//$Model->rollback();
												echo '信息添加失败，请重试！';
												exit;	
												}
																						
											echo 'ok';
														
										 }
					
			}
	
	}
	//查询所有员工
public function hrfetch_all_users(){
			
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
			
			$department = $this->_post('department');
			$uid = $this->_post('uid');
			$username = $this->_post('username');
			
			$staffinfo = M('staffinfo');
			
			if($department == ''&& $uid==''&& $username == '')
			{
				
				$cc = $staffinfo->count();
				$rs = $staffinfo->field("op_staffinfo.username as username,op_staffinfo.uid as uid,op_department.departmentname as department,op_userinfo.accountstatue as statue,op_teaminfo.teamname as teamname,
			CASE 
			 WHEN op_userinfo.accountstatue=1 THEN '已禁用'
			 WHEN op_userinfo.accountstatue=0 THEN '正常'
			 ELSE '无权限' END AS accountstatue
				")
				->join('op_department ON op_staffinfo.departmentid = op_department.did')
				->join('op_teaminfo ON op_staffinfo.teamid = op_teaminfo.tid')
				->join('op_userinfo ON op_staffinfo.uid = op_userinfo.uid')
				->order('op_staffinfo.uid desc')
				->limit("$start,$rows")
				->select();
				
				
				
			}
				
				else 
				{
					
									if($department!='')
									{
										$where = "op_department.departmentname like '%$department%' ";
									}
									
									if($uid != '' & $where!='')
									{
										$where = '$where and op_staffinfo.uid = "'.$uid.' "';
										
									}
										
										else if($uid !='')
										{
											$where = 'op_staffinfo.uid = "'.$uid.' "';
										}
											
											
											if($username!='' & $where !='')
											{
												$where = "$where and op_staffinfo.username = $username ";
												
												}
												
												else if($username != '')
												{
													$where = "op_staffinfo.username = $username ";
													
													
													}
													
													
									$cc = $staffinfo->where($where)->count();
									$rs = $staffinfo->field("op_staffinfo.username as username,op_staffinfo.uid as uid,op_department.departmentname as department,	op_userinfo.accountstatue as statue,op_teaminfo.teamname as teamname,
								CASE 
								 WHEN op_userinfo.accountstatue=1 THEN '已禁用'
								 WHEN op_userinfo.accountstatue=0 THEN '正常'
								 ELSE '无权限' END AS accountstatue")
									->join('op_department ON op_staffinfo.departmentid = op_department.did')
									->join('op_teaminfo ON op_staffinfo.teamid = op_teaminfo.tid')
									->join('op_userinfo ON op_staffinfo.uid = op_userinfo.uid')
									->where($where)
									->order('op_staffinfo.uid desc')
									->limit("$start,$rows")
									->select();			
					
					
					}
			//echo $staffinfo->getLastSql();
			echo dataToJson($rs,$cc);
			
			}
	//删除员工信息
	
	function staffDel(){
		
		$uid = $this->_get('uid');
		$userinfo = M('userinfo');
		$userClockTime = M('clocktime');
		$userUnusualTime = M('unusualtime');
		$staff = M('staffinfo');
		
		$getuserinfo = $userinfo->getByUid($uid);
		$getuserClockTime = $userClockTime->getByUid($uid);
		$getuserUnusualTime = $userUnusualTime->getByUid($uid);
		$getstaff = $staff->getByUid($uid);
		
		$userinfo->startTrans();
		if(count($getuserinfo)>0)
		{
						$rs1 = $userinfo->where('uid="'.$uid.'"')->delete();
						
							if(!$rs1) {
				
									echo '删除失败，请重试！';
									exit;	
								}
		}
		$userClockTime->startTrans();
		
		if(count($getuserClockTime)>0)
		{
						$rs2 = $userClockTime->where('uid="'.$uid.'"')->delete();
				
						if(!$rs2 ) {
								$userinfo->rollback();
								echo '删除失败，请重试！';
								exit;	
							}
		}
				
				$userUnusualTime->userUnusualTime();
				
		if(count($getuserUnusualTime)>0)
		{
						$rs3 = $userUnusualTime->where('uid="'.$uid.'"')->delete();
					
						if(!$rs3 ){
								$userinfo->rollback();
								$userClockTime->rollback();
								echo '删除失败，请重试！';
								exit;
							
							}
		}
		
		
		if(count($getstaff)>0)
		{
		
						$rs4 = $staff->where('uid="'.$uid.'"')->delete();	
						
						if(!$rs4){
								$userinfo->rollback();
								$userClockTime->rollback();
								$userUnusualTime->rollback();
								echo '删除失败，请重试！';
								exit;
							
							}
		}
		
								$userinfo->commit();
								$userClockTime->commit();
								$userUnusualTime->commit();
		
			echo 'ok';
		}




public function staffInfoModify(){
	
	$uid =  $this->_get('uid');
			//部门
		$department = M('department');
		$category = $department->select();
		$this->assign('category',$category);
		//类型
		$Model = M('usertype');
		$usertype = $Model->where("op_usertype.power<10")->select();
		$this->assign('usertype',$usertype);
		
		//组
		$team = M('teaminfo');
		$teaminfo = $team->select();
		$this->assign('teaminfo',$teaminfo);
		
		
	$staffinfo = M('staffinfo');
	
	$rs = $staffinfo->field('op_staffinfo.username as username,op_staffinfo.phone as phone,op_staffinfo.entrydate as entrydate,op_staffinfo.email as email,op_staffinfo.uid as uid,op_staffinfo.departmentid as did,op_userinfo.loginname as staffloginname,op_staffinfo.usertypeid as typeid,op_staffinfo.teamid as teamid,op_usertype.power as power,op_staffinfo.costcenterid as costcenter')
	
	->join('op_userinfo ON op_staffinfo.uid = op_userinfo.uid')
	->join('op_usertype ON op_staffinfo.usertypeid = op_usertype.tid')
	->where('op_staffinfo.uid="'.$uid.'"')->select();
		
			$this->assign('userinfo',$rs);
			$this->display();
		
			//echo $staffinfo->getLastSql();
	
	
	}


public function staff_modify_do(){
	
	$uid=$this->_get('uid');
	$entrytime = $this->_get('entrytime');
	$department = $this->_post('department');
	$teamid = $this->_post('teamid');
	$username = $this->_post('staffname');
	$stafftype = $this->_post('stafftype');
	$phone = $this->_post('phone');
	$email =  $this->_post('email');
	$loginname =$this->_post('staffloginname');
	$newuid =$this->_post('uid');
	$modifyinfo = M('staffinfo');
	$userinfo = M('userinfo');
	$clocktimeinfo = M('clocktime');
	$loginfo=M('log');
	$unusualtimeinfo=M('unusualtime');
	
	//$power = M('usertype');
	

		//$power=$power->getByTid($stafftype);
		//判断是否修改uid
		if($newuid!=$uid)
		{
			
			$judgeuid=$modifyinfo->getByUid($newuid);
			if($judgeuid!=NULL)
			{
				echo '修改失败，请重试！';
			    exit;
				
				}
				
		$data[uid]=$newuid;		
				
	//$userinfo->startTrans();
	$clocktimeinfo->startTrans();
	$loginfo->startTrans();
	$unusualtimeinfo->startTrans();
	$modifyinfo->startTrans();
	
	
	if($clocktimeinfo->getByUid($uid))
	{
		$rsclocktime = $clocktimeinfo->where("uid=$uid")->save($data);
	
		if(!$rsclocktime) {
			echo 'haveexist';
			exit;	
		}
	}
	
	
	if($loginfo->getByUid($uid))
	{
		
		$rslog= $loginfo->where("uid=$uid")->save($data);
		
		if(!$rslog) {
			$clocktimeinfo->rollback();
			echo '修改失败，请重试！';
			exit;	
		}
	}
	
	
	if($unusualtimeinfo->getByUid($uid))
	{
		$rsunusualtime=$unusualtimeinfo->where("uid=$uid")->save($data);
		
		if(!$rsunusualtime) {
			$clocktimeinfo->rollback();
			$loginfo->rollback();
			echo '修改失败，请重试！';
			exit;	
		}
		
	}
		$staffinfo=$modifyinfo->getByUid($uid);
		
		$getuserinfo = $userinfo->getByUid($uid);
		
	    $staffinfo['username'] =  $username;
		$staffinfo['uid'] =  $newuid;
		$staffinfo['entrydate'] = $entrytime;
		$staffinfo['departmentid'] =  $department;
		$staffinfo['teamid'] =  $teamid;
		$staffinfo['phone'] = $phone;
		$staffinfo['email'] = $email;
		$staffinfo['usertypeid'] = $stafftype;
		$staffinfo['updatetime'] = date('Y-m-d H:i:s');
		
		$rs = $modifyinfo->save($staffinfo);
		
		//echo $checkdetails->getLastSql();
		
	if(!$rs) {
			$clocktimeinfo->rollback();
			$loginfo->rollback();
			$unusualtimeinfo->rollback();
			echo '修改失败，请重试！';
			exit;	
		}
		
		
		if( count($getuserinfo)==0 && $loginname!='')
		{
		$accountname = $userinfo->getByLoginname($loginname);		
		if($accountname) {
			$clocktimeinfo->rollback();
			$loginfo->rollback();
			$unusualtimeinfo->rollback();
			$modifyinfo->rollback();
					echo 'haveexist';
					exit;	
				}
			
			$staffinfo=$modifyinfo->getByUid($uid);
			
			$getuser['uid'] =  $newuid;
			$getuser['username'] =  $staffinfo['username'];
			$getuser['entrydate'] = $staffinfo['entrydate'];
			$getuser['accountstatue']=0;
			$getuser['departmentid'] =  $staffinfo['departmentid'];
			$getuser['costcenterid'] =  $staffinfo['costcenterid'];
			$getuser['teamid'] =  $staffinfo['teamid'] ;
			$getuser['phone'] = $staffinfo['phone'];
			$getuser['email'] = $staffinfo['email'];
			$getuser['usertypeid'] = $staffinfo['usertypeid'] ;
			$getuser['updatetime'] = date('Y-m-d H:i:s');
			$getuser['loginname']=$loginname;
			$getuser['password']=md5('12345');
			
			$rsuser = $userinfo->add($getuser);
			
			if(!rsuser)
			{
			$clocktimeinfo->rollback();
			$loginfo->rollback();
			$unusualtimeinfo->rollback();
			$modifyinfo->rollback();
			echo '修改失败，请重试！';
			exit;	
			}
			
		}
		
		else if(count($getuserinfo)>0)
		{
			
		$getuserinfo['username'] =  $username;
		$getuserinfo['uid'] =  $newuid;
		$getuserinfo['entrydate'] = $entrytime;
		$getuserinfo['departmentid'] =  $department;
		$getuserinfo['teamid'] =  $teamid;
		$getuserinfo['phone'] = $phone;
		$getuserinfo['email'] = $email;
		$getuserinfo['usertypeid'] = $stafftype;
		$getuserinfo['updatetime'] = date('Y-m-d H:i:s');
		$rsuser = $userinfo->save($getuserinfo);
			
			if(!rsuser)
			{
			$clocktimeinfo->rollback();
			$loginfo->rollback();
			$unusualtimeinfo->rollback();
			$modifyinfo->rollback();
			echo '修改失败，请重试！';
			exit;	
			}
	}
	
	
			$clocktimeinfo->commit();
			$loginfo->commit();
			$unusualtimeinfo->commit();
			$modifyinfo->commit();
			$userinfo->commit();
		//echo $userinfo->getLastSql();
		echo 'ok';
				
}
//newuid==olduid
		else  
		{
		
		
		
	    $staffinfo=$modifyinfo->getByUid($uid);
		
		$getuserinfo = $userinfo->getByUid($uid);
		
	    $staffinfo['username'] =  $username;
		$staffinfo['entrydate'] = $entrytime;
		$staffinfo['departmentid'] =  $department;
		$staffinfo['teamid'] =  $teamid;
		$staffinfo['phone'] = $phone;
		$staffinfo['email'] = $email;
		$staffinfo['usertypeid'] = $stafftype;
		$staffinfo['updatetime'] = date('Y-m-d H:i:s');
		$modifyinfo->startTrans();
		$rs = $modifyinfo->save($staffinfo);
		
		//echo $checkdetails->getLastSql();
		
	if(!$rs) {
			echo '修改失败，请重试！';
			exit;	
		}
		
		
		if( count($getuserinfo)==0 && $loginname!='')
		{
				$accountname = $userinfo->getByLoginname($loginname);		
				if($accountname) {
					echo 'haveexist';
					exit;	
				}
			
			$staffinfo=$modifyinfo->getByUid($uid);
			
			$getuser['uid'] =  $uid;
			$getuser['username'] =  $staffinfo['username'];
			$getuser['entrydate'] = $staffinfo['entrydate'];
			$getuser['accountstatue']=0;
			$getuser['departmentid'] =  $staffinfo['departmentid'];
			$getuser['costcenterid'] =  $staffinfo['costcenterid'];
			$getuser['teamid'] =  $staffinfo['teamid'] ;
			$getuser['phone'] = $staffinfo['phone'];
			$getuser['email'] = $staffinfo['email'];
			$getuser['usertypeid'] = $staffinfo['usertypeid'] ;
			$getuser['updatetime'] = date('Y-m-d H:i:s');
			$getuser['loginname']=$loginname;
			$getuser['password']=md5('12345');
			
			$rsuser = $userinfo->add($getuser);
			
			if(!rsuser)
			{
			$modifyinfo->rollback();
			echo '修改失败，请重试！';
			exit;	
			}
			
		}
		
		else if(count($getuserinfo)>0)
		{
			
		$getuserinfo['username'] =  $username;
		$getuserinfo['entrydate'] = $entrytime;
		$getuserinfo['departmentid'] =  $department;
		$getuserinfo['teamid'] =  $teamid;
		$getuserinfo['phone'] = $phone;
		$getuserinfo['email'] = $email;
		$getuserinfo['usertypeid'] = $stafftype;
		$getuserinfo['updatetime'] = date('Y-m-d H:i:s');
		$getuserinfo = $userinfo->save($getuserinfo);
			
			if(!rsuser)
			{
			$modifyinfo->rollback();
			echo '修改失败，请重试！';
			exit;	
			}
	}
	
	$modifyinfo->commit();
		//echo $userinfo->getLastSql();
		echo 'ok';
	
		}
	}


public function loginDetails(){
	
	
	 $uid = $this->_get('uid');
	 $login = M('log');
	 $userinfo = M('userinfo');
	 $rs = $userinfo->where('op_userinfo.uid = "'.$uid.'"')->select();
	 $cc = $login->where('op_log.uid =  "'.$uid.'"')->count();
	 $this->assign('total',$cc[0]);
	  $this->assign('uid',$uid);
	  $this->assign('loginname',$rs[0]['loginname']);
	 $this->display();
	//echo $login->getLastSql();
	}

//查询登录信息
	function fetch_all_login(){
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
		
		$uid = $this->_get('uid');
		
		$userinfo = M('log');
		
		$cc = $userinfo->where('op_log.uid =  "'.$uid.'"')->count();
		
		$rs = $userinfo->field('op_log.uid as uid,op_log.logintime as logintime,op_log.quittime as quittime,op_userinfo.username as username')
						->join('op_userinfo ON op_userinfo.uid = op_log.uid')
						->where('op_log.uid =  "'.$uid.'"')
						->order('op_log.logintime desc')
						->limit("$start,$rows")
						->select();
		
		echo dataToJson($rs,$cc);
		
		//echo $userinfo->getLastSql();
		}
		
		
		public function repass()
		{
			
			$uid = $this->_get('uid');
			
			$model = M('userinfo');
			
			$info=$model->getByUid($uid);
			
			$oldpass = $info['password'];
			
			$info['password'] = md5('12345');
			
			if($info['loginname']=='')
			{
				echo 'nologinname';
				exit;
				
				}
			
			if(strcmp($oldpass,$info['password'])==0)
			{
				echo 'ok';
				exit;
				
				}
			else
			{
				$rs = $model->save($info);
			
				if(!$rs) {
				echo '重置失败，请重试！';
				exit;	
					}
				echo 'ok';
			
			}
			
		}
		public function changestatue()
		{
			
			$uid = $this->_get('uid');
			
			$model = M('userinfo');
			
			$info=$model->getByUid($uid);
			
			if(!$info)
			{
					echo 'nologinname';
					exit;
					
			}
			else
			{
					if(	$info['accountstatue']==1)
					{
						
						$info['accountstatue']=0;
						
						}
						
						else
						{
							$info['accountstatue']=1;
							
							}
			}
			
			$rs = $model->save($info);
								
			if(!$rs) {
			
			 	echo '修改失败，请重试！';
				exit;	
				}
		
			echo 'ok';
			
			}
			
			
			//员工信息例子
			public function staffInfoSample()
			{
				$page = $this->_post('page');
		
				if($page<1) $page=1;
				
				$rows = $this->_post('rows');
				
				if($rows<1) $rows=10;
				
				$start = ($page-1)*$rows;
				$sample=M('sample');
				/*
				$info[0]['uid']='123456789';
				$info[0]['username']='XXX';
				$info[0]['department']='后勤部';
				$info[0]['usertype']='产线班长';
				$info[0]['entrydate']='2008-8-8';
				$info[0]['costcenterid']='二财务部';
				$info[0]['phone']='137XXXXXXXX';
				*/
				
				$cc = $sample->count();
				
				$rs=$sample->field('uid,username,department,usertype,entrydate,costcenterid,phone,email,team')->limit("$start,$rows")->select();
				
				echo dataToJson($rs,$cc);
				}
			
			
			
			//导入员工信息
		public function importStaffExcel()
	
	{
				$tmp_file = $_FILES ['import_staff'] ['tmp_name'];
		
		$file_types = explode ( ".", $_FILES ['import_staff'] ['name'] );
		
		$file_type = $file_types [count ( $file_types ) - 1];
		
		
				
		
		 /*判别是不是.xls文件，判别是不是excel文件*/
		 if (strtolower ( $file_type ) != "xlsx" && strtolower ( $file_type ) != "xls")              
		 {
			  $this->error ( '不是Excel文件，重新选择' );
			 exit();
			  
		 }
	
	
	$PHPExcel = new PHPExcel();     
		
		$PHPReader = new PHPExcel_Reader_Excel5(); 
		
		
		
		
		$PHPExcel = $PHPReader->load($tmp_file);
	 	
		$currentSheet = $PHPExcel->getSheet(0);
		
		$allColumn = $currentSheet->getHighestColumn();
		
		$allRow = $currentSheet->getHighestRow();
		
		$currentSheet = $PHPExcel->getSheet(0);
		
		$allColumn = $currentSheet->getHighestColumn();
		
		$allRow = $currentSheet->getHighestRow();
		
		$flag=0;
		
			for($currentRow = 2; $currentRow<=$allRow; $currentRow++){
	 					
						$cell =  $currentSheet->getCell('A'.$currentRow)->getValue();
	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
		   
	 						 $data[$flag]['uid'] = $cell;//创建二维数组

 						$cell =  $currentSheet->getCell('B'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							$data[$flag]['username'] = $cell;
						

   						$cell =  $currentSheet->getCell('C'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							$data[$flag]['departmentid'] =  $cell;
										   
							$cell =  $currentSheet->getCell('D'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							   $data[$flag]['teamid'] =  $cell;
							   
							   	$cell =  $currentSheet->getCell('E'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							   $data[$flag]['usertypeid'] =  $cell;
							   
							   	$cell =  $currentSheet->getCell('F'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							   $data[$flag]['costcenterid'] = $cell;
							   
							   	$cell =  $currentSheet->getCell('G'.$currentRow)->getValue();
	    	 				
				
							   $data[$flag]['entrydate'] =  date("Y-m-d",time($cell));
							   
							   $cell =  $currentSheet->getCell('H'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							   $data[$flag]['phone'] = $cell;
							   
							   $cell =  $currentSheet->getCell('I'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							   $data[$flag]['email'] =  $cell;
							  
	    
							   $data[$flag]['updatetime'] =  date('Y-m-d H:i:s');
		
  			
  					 $flag++;  //for
 
			}//for
			
								
								
		
		  $infotable=M('staffinfo');//M方法
		  $result=$infotable->addAll($data);
		  
		  if(!$result)
		  {
			 // $result->rollback();
			  $this->error('导入失败，请检查格式从新导入！');
			  //echo $infotable->getLastSql();
			  
			  exit();
		  }
		  else
		  {

			  $this->success ( '导入成功' );	
		  }
				
	}


	/**************************************** Yu Yi ********************************************/
	//获取排班列表
	public function fetchWorktimeList() {
		$page = $this->_post('page');
		if($page<1) $page=1;
		$rows = $this->_post('rows');
		if($rows<1) $rows=10;
		$start = ($page-1)*$rows;

    	$Model = M('worktime');
    	$cc = $Model->count();
    	$rs = $Model->join("op_teaminfo ON op_worktime.teamid = op_teaminfo.tid")->limit("$start,$rows")->select();
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
    	$start = $this->_get('start');
    	$end = $this->_get('end');
    	$Model = M('worktime');
    	$row = $Model->getById($id);
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
    	$Model = M('teaminfo');
    	$rs = $Model->where("tid NOT IN(SELECT teamid FROM op_worktime)")->select();
    	$this->assign("teaminfo",$rs);
    	$this->display();
    }
    //处理新增
    public function doWorktimeNew() {
    	$tid = $this->_get('tid');
    	$start = $this->_get('start');
    	$end = $this->_get('end');
    	if ($tid<1) {
    		echo '已经没有可以添加的组了！';
    		return;
    	}
    	$Model = M('worktime');
    	$row['teamid'] = $tid;
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
    /*********************************************************************************************/
}

?>