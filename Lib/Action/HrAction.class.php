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
		
		
		$kucun=M('clocktime');
		//$kucun->where("uid is not null")->delete();
		$kucun->startTrans();
			/*if($import_begin_time==''||$import_end_time=='')
				{
						$this->error('开始日期和结束日期不能同时为空！');
			  			 exit();
					}*/
				
	
		
				
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
			  $kucun->rollback();
			  
			  $this->error('导入失败！');
			  exit();
		  }
		  else
		  {
			  $kucun->commit();
		  //	R('Check/checkClock',array($import_begin_time,$import_end_time));
			 // $kucun->where("id is not null")->delete();
			 $this->success ( '导入成功！' );
			 //echo 'ok';	
			  
		  }

	
	
	
	}
	

	
	
		/**查询所有人考勤详情********/
	  public function hrfetch_all_attendance() {
		  
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
		
		$search_begin_time =  $this->_post('hrsearch_begin_time');
		
		$search_end_time = $this->_post('hrsearch_end_time');
		
		$where= "(op_usertype.power<=5 or op_usertype.power=7)";

				
		if($uid!='') {
			$where = " $where and op_unusualtime.uid = '"."$uid"."' " ;
		}
		
			
			if($search_chose=='hrsearch_yes')
			{
			$where="$where and op_unusualtime.static = '"."正常"."' ";
			
			}
			else if($search_chose=='hrsearch_no')
			{
				$where="$where and op_unusualtime.static <> '"."正常"."'  ";
				}
		
			
			
		
		if($department!='')
		{
			$where="$where and op_department.departmentname like '%$department%' ";
			}
			
			
		if($username!='') {
			$where= "$where and op_staffinfo.username like '%$username%' ";
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
		->join('op_usertype ON op_usertype.tid=op_staffinfo.usertypeid')
		->where($where)
		 ->count();
	
		 
	    $allattendance=$unusualtime
		->field("phone,op_unusualtime.uid as uid,op_unusualtime.clocktime as clocktime,op_unusualtime.clockdate as clockdate,op_staffinfo.username as username,op_unusualtime.static as static
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,ps,vacid,
		 CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply
		")
		->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_teaminfo.tid = op_staffinfo.teamid')
		->join('op_usertype ON op_usertype.tid=op_staffinfo.usertypeid')
		->order('op_unusualtime.uid desc,clockdate desc,clocktime desc')
		->where($where)
		->limit("$start,$rows")
		->select();
		
	echo $unusualtime->getLastSql();
	//echo dataToJson($allattendance,$cc);
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
		
		
		$userinfo=M('userinfo');
		
		$staffinfo['uid'] = $uid;
		
		$staffinfo['departmentid'] = $this->_post('department');
		
		$staffinfo['usertypeid'] = $this->_post('stafftype');
		
		$staffinfo['username'] = $this->_post('staffname');
		$staffinfo['LHoliday'] = $this->_post('lholiday');
		$staffinfo['THoliday'] = $this->_post('tholiday');
		$staffinfo['LRest'] = $this->_post('lrest');
		$staffinfo['TRest'] = $this->_post('trest');
		
		$staffinfo['costcenterid'] = $this->_post('costcenter');
		
		$staffinfo['teamid'] = $this->_post('teamid');
				
		$staffinfo['email'] = $this->_post('email');
		
		$staffinfo['entrydate'] = $this->_get('entrytime');
		
		$staffinfo['phone'] = $this->_post('phone');
		
		$loginname = $this->_post('staffloginname');
		$status = $this->_post('access');
					
		$staffinfo['updatetime'] = date('Y-m-d H:i:s');
		
		if(fmod(floatval($staffinfo['LHoliday']*10),5)!=0||fmod(floatval($staffinfo['THoliday']*10),5)!=0||fmod(floatval($staffinfo['LRest']*10),5)!=0||fmod(floatval($staffinfo['TRest']*10)		
		,5)!=0)
	{
		echo 'timeerror';
			    exit;
		
		}
		
		
		if($loginname=='')
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

					
					
									$rsa = $userinfo->getByLoginname($loginname);
									 if($rsa)
									 {
												
										echo 'loginexist';
										exit;	
									 }
													
									
									else 
										{								
																						
											$Model->startTrans();
											
											$rsend = $Model->add($staffinfo);
											
											if(!$rsend) {
												//$Model->rollback();
												echo '信息添加失败，请重试！';
												exit;	
												}
												
									$staffinfo=$Model->getByUid($uid);
				
									$getuser['uid'] =  $uid;
									$getuser['username'] =  $staffinfo['username'];
									$getuser['entrydate'] = $staffinfo['entrydate'];
									
									$getuser['departmentid'] =  $staffinfo['departmentid'];
									$getuser['costcenterid'] =  $staffinfo['costcenterid'];
									$getuser['phone'] = $staffinfo['phone'];
									$getuser['email'] = $staffinfo['email'];
									$getuser['usertypeid'] = $staffinfo['usertypeid'] ;
									$getuser['updatetime'] = date('Y-m-d H:i:s');
									$getuser['loginname']=$loginname;
									$getuser['password']=md5('12345');
									if($status=='access_yes')
									{
									
									$getuser['accountstatue']=0;
									}
									else
									{
										$getuser['accountstatue']=1;
										
										}
			
									$rsuser = $userinfo->add($getuser);
									
									if(!rsuser)
									{
									$Model->rollback();
									echo '修改失败，请重试！';
									exit;	
									}
									
									$Model->commit();								
																											
									echo 'ok';
			 }//else
					
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
				->order('op_staffinfo.uid asc')
				->limit("$start,$rows")
				->select();
				
				
				
			}
				
				else 
				{
					
									if($department!='')
									{
										$where = "op_department.departmentname like '%$department%' ";
									}
									
									if($uid != '' && $where!='')
									{
										$where = " $where and op_staffinfo.uid = '"."$uid"."' " ;
										
									}
										
										else if($uid !='')
										{
											$where = "op_staffinfo.uid = '"."$uid"."' ";
										}
											
											
											if($username!='' && $where !='')
											{
												$where = "$where and op_staffinfo.username like '%$username%' ";
												
												}
												
												else if($username != '')
												{
													$where = "op_staffinfo.username like '%$username%' ";
													
													
													}
													
													
					$cc = $staffinfo
					->join('op_department ON op_staffinfo.departmentid = op_department.did')
					->join('op_teaminfo ON op_staffinfo.teamid = op_teaminfo.tid')
					->join('op_userinfo ON op_staffinfo.uid = op_userinfo.uid')
					->where($where)
					->count();
				
									$rs = $staffinfo->field("op_staffinfo.username as username,op_staffinfo.uid as uid,op_department.departmentname as department,	op_userinfo.accountstatue as statue,op_teaminfo.teamname as teamname,
								CASE 
								 WHEN op_userinfo.accountstatue=1 THEN '已禁用'
								 WHEN op_userinfo.accountstatue=0 THEN '正常'
								 ELSE '无权限' END AS accountstatue")
									->join('op_department ON op_staffinfo.departmentid = op_department.did')
									->join('op_teaminfo ON op_staffinfo.teamid = op_teaminfo.tid')
									->join('op_userinfo ON op_staffinfo.uid = op_userinfo.uid')
									->where($where)
									->order('op_staffinfo.uid asc')
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
		
		$userUnusualTime = M('unusualtime');
		$staff = M('staffinfo');
		$log=M('log');
		$getuserinfo = $userinfo->getByUid($uid);
		$loginfo=$log->getByUid($uid);
		$getuserUnusualTime = $userUnusualTime->getByUid($uid);
		$getstaff = $staff->getByUid($uid);
		
		$log->startTrans();
		
		if(count($loginfo)>0)
		{
						$rsa = $log->where('uid="'.$uid.'"')->delete();
						
							if(!$rsa) {
				
									echo '删除失败，请重试！';
									exit;	
								}
		}
		
		
		
		
		$userinfo->startTrans();
		if(count($getuserinfo)>0)
		{
						$rs1 = $userinfo->where('uid="'.$uid.'"')->delete();
						
							if(!$rs1) {
									$log->rollback();
									echo '删除失败，请重试！';
									exit;	
								}
		}
		
		
				
		if(count($getuserUnusualTime)>0)
		{
						$rs3 = $userUnusualTime->where('uid="'.$uid.'"')->delete();
					
						if(!$rs3 ){
								$userinfo->rollback();
								$log->rollback();
								echo '删除失败，请重试！';
								exit;
							
							}
		}
		
		
		if(count($getstaff)>0)
		{
		
						$rs4 = $staff->where('uid="'.$uid.'"')->delete();	
						
						if(!$rs4){
								$userinfo->rollback();
								$log->rollback();
								$userUnusualTime->rollback();
								echo '删除失败，请重试！';
								exit;
							
							}
		}
		
								$userinfo->commit();
								$log->commit();
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
		$teaminfo = $team->order('op_teaminfo.tid asc')->select();
		$this->assign('teaminfo',$teaminfo);
		
		
	$staffinfo = M('staffinfo');
	
	$rs = $staffinfo->field('op_staffinfo.username as username,op_staffinfo.phone as phone,op_staffinfo.entrydate as entrydate,op_staffinfo.email as email,op_staffinfo.uid as uid,op_staffinfo.departmentid as did,op_userinfo.loginname as staffloginname,op_staffinfo.usertypeid as typeid,op_staffinfo.teamid as teamid,op_usertype.power as power,op_staffinfo.costcenterid as costcenter,op_staffinfo.THoliday as tholiday,op_staffinfo.LHoliday as lholiday,op_staffinfo.TRest as
	trest,op_staffinfo.LRest as lrest')
	
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
	$lholiday = $this->_post('lholiday');
	$tholiday = $this->_post('tholiday');
	$lrest = $this->_post('lrest');
	$trest = $this->_post('trest');
	$loginname =$this->_post('staffloginname');
	$newuid =$this->_post('uid');
	$modifyinfo = M('staffinfo');
	$userinfo = M('userinfo');
	$clocktimeinfo = M('clocktime');
	$loginfo=M('log');
	$unusualtimeinfo=M('unusualtime');
	
	//$power = M('usertype');
	if(fmod(floatval($lholiday*10),5)!=0||fmod(floatval($tholiday*10),5)!=0||fmod(floatval($lrest*10),5)!=0||fmod(floatval($trest*10),5)!=0)
	{
		echo 'timeerror';
			    exit;
		
		}
		

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
		$staffinfo['LHoliday'] = $lholiday;
		$staffinfo['THoliday'] = $tholiday;
		$staffinfo['LRest'] = $lrest;
		$staffinfo['TRest'] = $trest;
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
		$staffinfo['LHoliday'] = $lholiday;
		$staffinfo['THoliday'] = $tholiday;
		$staffinfo['LRest'] = $lrest;
		$staffinfo['TRest'] = $trest;
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
						->order('op_log.logintime asc')
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
				
				$rs=$sample->field('uid,username,department,usertype,entrydate,costcenterid,loginname,phone,email,team,op_sample.THoliday as tholiday,op_sample.LHoliday as lholiday,op_sample.TRest as trest,op_sample.LRest as lrest')->limit("$start,$rows")->select();
				
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
							 $datauser[$flag]['uid'] = $cell;

 						$cell =  $currentSheet->getCell('B'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							$data[$flag]['username'] = $cell;
							$datauser[$flag]['username'] = $cell;

   						$cell =  $currentSheet->getCell('C'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							$data[$flag]['departmentid'] =  $cell;
							$datauser[$flag]['departmentid'] = $cell;
										   
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
							   $datauser[$flag]['usertypeid'] = $cell;
							   
							   	$cell =  $currentSheet->getCell('F'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							   $data[$flag]['costcenterid'] = $cell;
							   $datauser[$flag]['costcenterid'] = $cell;
							   	$cell =  $currentSheet->getCell('G'.$currentRow)->getValue();
	    	 				
								$jd = GregorianToJD(1, 1, 1970); 
								$celldate = JDToGregorian($jd+intval($cell)-25569); 
				
								$dataexplode=explode("/",$celldate);
		 				 
							  $data[$flag]['entrydate'] = date("Y-m-d",mktime(0,0,0,$dataexplode[0],$dataexplode[1],$dataexplode[2]));
								 $datauser[$flag]['entrydate'] = $data[$flag]['entrydate'];
							   
							   
							   $cell =  $currentSheet->getCell('H'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
							   $data[$flag]['phone'] = $cell;
							   $datauser[$flag]['phone'] = $cell;
							   $cell =  $currentSheet->getCell('I'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
						  
						   $data[$flag]['email'] =  $cell;
							  $datauser[$flag]['email'] = $cell;
							  
							  
						  
						  $cell =  $currentSheet->getCell('J'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
						   $data[$flag]['LHoliday'] =  $cell;  //去年剩余年假
						   
						   
						  
						  $cell =  $currentSheet->getCell('K'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
						  
						   $data[$flag]['THoliday'] =  $cell;  //今年可用年假
						   
						  $cell =  $currentSheet->getCell('L'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
						   $data[$flag]['LRest'] =  $cell;  //去年剩余调休
						  
						  $cell =  $currentSheet->getCell('M'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
						  
						  
						   $data[$flag]['TRest'] =  $cell;  //今年可用调休
						  
						  
						  			  
	    
							   $data[$flag]['updatetime'] =  date('Y-m-d H:i:s');
								 $datauser[$flag]['updatetime'] = date('Y-m-d H:i:s');
								  $datauser[$flag]['accountstatue'] =0;
							 $cell =  $currentSheet->getCell('N'.$currentRow)->getValue();
	    	 				
						 if($cell instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cell = $cell->__toString();  
		 				  }
						  
						  
						   $datauser[$flag]['loginname'] =  $cell;  //今年可用调休
						   $datauser[$flag]['password']=md5('12345');
  			
  					 $flag++;  //for
 
			}//for
			
								
								
		
		  $infotable=M('staffinfo');//M方法
		  
		  $userinfo = M('userinfo');
		   for($i=0;$i<$flag;$i++)
		 {
			 
		  $staffinfo=$infotable->getByUid($data[$i]['uid']);
		  $id=$data[$i]['uid'];
		  if(count($staffinfo)>0)
		  {
			 $is= $infotable->where("op_staffinfo.uid=$id")->delete();
			 
		  }
		  
		
		 		 		  
		 }
		  
		  		  
		  $result=$infotable->addAll($data);
		  
		  if(!$result)
		  {
			 // $result->rollback();
			  $this->error('员工信息导入失败，请检查格式从新导入！');
			  //echo $infotable->getLastSql();
			  
			  exit();
		  }
		  else
		  {
			  
			  $temp=0;
			  
			  //排除无效的userinfo
	   			 for($i=0;$i<$flag;$i++)
				 {
			 
					  $staffinfo=$userinfo->getByUid($datauser[$i]['uid']);
					  $staffloginname=$userinfo->getByLoginname($datauser[$i]['loginname']);
					  
					  if(count($staffinfo)==0&&count($staffloginname)==0&&$datauser[$i]['loginname']!='')
		 				 {
							
							  $dataadduser[$temp]=$datauser[$i];
							  $temp++;
							  
							 
							  }
		  
		
		 		 		  
				 }
				 
				 //添加有效的userinfo
				 if(count($dataadduser)>0)
				 {
					      $rs = $userinfo->addAll($dataadduser);
							  
							  if(!$rs)
							  {
								
								$this->error ('部分员工登录账户导入失败，请核对！' );
								  
								exit();
								  
								  }
							  	
				 }
				 $this->success ( '导入成功！' );
		  }
				
	}


	/**************************************** Yu Yi ********************************************/
	//排班列表
	public function worktimelist() {
    	$Model = M('teaminfo');
    	$rs = $Model->select();
    	$this->assign("teamlist",$rs);
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
		$month = $this->_post('month');
		$year = date('Y');
		$where = " ";
		if($month==13) {
			$month = 1;
			$year = date('Y') + 1;
		}
		if($month==0) {
			$month = 12;
			$year = date('Y') - 1;
		}
		if($month>0) {
			$where = " AND workdate1 BETWEEN '".$year."-$month-01' AND '".$year."-$month-31' ";
		}
    	$Model = M('worktime');
    	$cc = $Model->where("teamid=$teamid AND uid is NULL".$where)->count();
    	$rs = $Model->join("op_teaminfo ON op_worktime.teamid = op_teaminfo.tid")->where("teamid=$teamid AND uid is NULL".$where)->order('workdate1 desc')->limit("$start,$rows")->select();
    	//echo $Model->getLastSql();
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
    	$Model = M('teaminfo');
    	$rs = $Model->select();
    	$this->assign("teaminfo",$rs);
    	$teamid = $this->_get('teamid');
    	$this->assign("teamid",$teamid);
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
	
	
	
 
   
    /*********************************************************************************************/
	/*
	function listfile()
	{
		
		self::list_files('E:\Coding\xampp\htdocs\op_attendance\excel');
		
		}
	
	function list_files($dir) 
 { 
     if(is_dir($dir))        //判断参数是否为目录
     { 
         if($handle = opendir($dir))         //打开目录，返回文件句柄
         { 
             while(($file = readdir($handle)) !== false)         //读文件夹返回文件名，
                                                                 //成功，则该函数返回一个文件名，否则返回 false
             { 
                 if($file != "." && $file != ".." && $file != "Thumbs.db")       //三个文件不显示出来。进行判断。
                 { 
                     echo '<a target="_blank" href="'.$dir.$file.'">'.$file.'</a><br>'."\n";         //用 a 标签显示文件路径，和文件名。
                 } 
             } 
             closedir($handle);      //关闭文件夹句柄。
         } 
     } 
 }  
	
	*/
	
	
	
	public function hrfetch_all_vacation()
	{
		$page = $this->_post('page');
		
		if($page<1) $page=1;
		
		$rows = $this->_post('rows');
		
		if($rows<1) $rows=10;
		
		$start = ($page-1)*$rows;
		
		$username=$this->_post('username');
		$uid=$this->_post('uid');
		$department=$this->_post('department');
		
		$staff=M('staffinfo');
		
		
		$where= "(op_usertype.power<=5 or op_usertype.power=7)";
			
		if($uid!='') {
			$where = " $where and op_staffinfo.uid = '"."$uid"."' " ;
		}
		
		if($username!='') {
			$where= "$where and username like '%$username%' ";
		}
		
		if($department!='')
		{
			
			$where="$where and op_department.departmentname like '%$department%' ";
			
			}
		
		$cc = $staff
		->join('op_usertype ON op_usertype.tid=op_staffinfo.usertypeid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->where($where)
		 ->count();
		 
		 
		 
		$vacation=$staff
		->field("op_staffinfo.uid as uid,op_staffinfo.username as username,op_staffinfo.THoliday as tholiday,op_staffinfo.TRest as trest,
		op_staffinfo.LHoliday as lholiday,op_staffinfo.LRest as lrest,op_department.departmentname as department,op_department.did as did
		")
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_usertype ON op_usertype.tid=op_staffinfo.usertypeid')
		->where($where)
		->order('op_department.did asc,op_staffinfo.uid asc')
		->limit("$start,$rows")
		->select();
		
	//echo $staff->getLastSql();
	echo dataToJson($vacation,$cc);
		
		}
		
		
		
		
		
		
public function exportVacation()
		{
			if(!file_exists('..\excel')) {
 			mkdir('..\excel');
 		}
 		if(!file_exists('..\excel\vacation')) {
			mkdir('..\excel\vacation');
		}
 			
		$username=$this->_post('username');
		
		$uid=$this->_post('uid');
		
		$department=$this->_post('departmen');
					
		
		$where= "(op_usertype.power<=5 or op_usertype.power=7)";
			//$where= "(op_usertype.power<17)";
		if($uid!='') {
			$where = " $where and op_staffinfo.uid = '"."$uid"."' " ;
		}
		
		if($username!='') {
			$where= "$where and username like '%$username%' ";
		}
		
		if($department!='')
		{
			
			$where="$where and op_department.departmentname like '%$department%' ";
			
			}
		   
          error_reporting(E_ALL);
           date_default_timezone_set('Asia/Shanghai');
          $objPHPExcel = new PHPExcel();
 			$staff=M('staffinfo');
            $name=date('YmdHis');
			
		$vacation=$staff
		->field("op_staffinfo.uid as uid,op_staffinfo.username as username,op_staffinfo.THoliday as tholiday,op_staffinfo.TRest as trest,
		op_staffinfo.LHoliday as lholiday,op_staffinfo.LRest as lrest,op_department.departmentname as department,op_department.did as did
		")
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_usertype ON op_usertype.tid=op_staffinfo.usertypeid')
		->where($where)
		->order('op_department.did asc,op_staffinfo.uid asc')
		->select();
		$flag=0;
			foreach($vacation as $k => $temp){
				$pdata[$flag]['department']=$temp['department'];
				$pdata[$flag]['uid']=$temp['uid'];
				$pdata[$flag]['username']=$temp['username'];
				$pdata[$flag]['lholiday']=$temp['lholiday'];
				$pdata[$flag]['tholiday']=$temp['tholiday'];
				$pdata[$flag]['lrest']=$temp['lrest'];
				$pdata[$flag]['trest']=$temp['trest'];
				$flag=$flag+1;
				
				
				
				}
			
			
			
        /*以下是一些设置 ，什么作者  标题啊之类的*/
          $objPHPExcel->getProperties()->setCreator("OOPS")
                                ->setLastModifiedBy("OOPS")
                                ->setTitle("数据EXCEL导出")
                                ->setSubject("数据EXCEL导出")
                                ->setDescription("年假调休导出")
                                ->setKeywords("excel")
                               ->setCategory("result file");
          /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
		  
		  $num=1;
		  $objPHPExcel->setActiveSheetIndex(0)
 
                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
                           ->setCellValue('A'.$num, '员工部门')    
                           ->setCellValue('B'.$num,'员工工号' )
						    ->setCellValue('C'.$num,'员工姓名' )
                           ->setCellValue('D'.$num, '去年剩余年假（天）')
                            ->setCellValue('E'.$num, '今年可用年假（天）')
                             ->setCellValue('F'.$num, '去年剩余调休（小时）')
                               ->setCellValue('G'.$num, '今年可用调休（小时）');
		  
		  
		  
		  
		  
         foreach($pdata as $k => $v){
 
             $num=$k+2;
              $objPHPExcel->setActiveSheetIndex(0)
 
                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
                           ->setCellValue('A'.$num, $v['department'])    
                           ->setCellValue('B'.$num, $v['uid'])
						    ->setCellValue('C'.$num, $v['username'])
                           ->setCellValue('D'.$num, $v['lholiday'])
                            ->setCellValue('E'.$num, $v['tholiday'])
                             ->setCellValue('F'.$num, $v['lrest'])
                               ->setCellValue('G'.$num, $v['trest']);
							   
							   
             }
 
            $objPHPExcel->getActiveSheet()->setTitle('年假调休报表');
             $objPHPExcel->setActiveSheetIndex(0);
	
              $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
              $objWriter->save('../excel/vacation/Vacation'."$name".'.xls');
			 
				  
			//$file='D:/excel/forms/'.$file;
			//$file='../'.$file;
           // header("Location:../op_attendance/excel"); 
			//self::list_files('.\excel');
				//self::list_files_vacation();
		  
				 $this->success ( '年假调休报表导出成功' );	
			
			
			}
			
			
			
			
			
				//excel到数据库
	public function doimportvacation()
	{	
		$tmp_file = $_FILES ['import_xls'] ['tmp_name'];
		
		$file_types = explode ( ".", $_FILES ['import_xls'] ['name'] );
		
		$file_type = $file_types [count ( $file_types ) - 1];
		
		
				
				
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
		$staff=M('staffinfo');
		
			for($currentRow = 2; $currentRow<=$allRow; $currentRow++){
	 					
						$cellB =  $currentSheet->getCell('B'.$currentRow)->getValue();
	 				
						 if($cellB instanceof PHPExcel_RichText)     //富文本转换字符串   
           
		  				 {
		  					  $cellB = $cellB->__toString();  
		 				  }
		   
	 						  $data[$k]['uid'] = $cellB;//创建二维数组

 						$cellD =  $currentSheet->getCell('D'.$currentRow)->getValue();
						
						
							  $data[$k]['LHoliday'] = $cellD;

   						   $cellE =  $currentSheet->getCell('E'.$currentRow)->getValue();
	    	 										
						      $data[$k]['THoliday'] = $cellE;//date("H:i:s",strtotime($n));
							  
							$cellF =  $currentSheet->getCell('F'.$currentRow)->getValue();
	    	 										
						      $data[$k]['LRest'] = $cellF;//date("H:i:s",strtotime($n));
							  
							  
							    $cellG =  $currentSheet->getCell('G'.$currentRow)->getValue();
	    	 										
						      $data[$k]['TRest'] = $cellG;//date("H:i:s",strtotime($n));
		
  			
  					 $k++;  //for
 
			}//for
         
		// $kucun=M('clocktime');//M方法
		$staff->startTrans();
		 for($i=0;$i<$k;$i++)
		 {
			 
		  $staffinfo=$staff->getByUid($data[$i]['uid']);
		  $staffinfo['THoliday']=$data[$i]['THoliday'];
		  $staffinfo['TRest']=$data[$i]['TRest'];
		  $staffinfo['LHoliday']=$data[$i]['LHoliday'];
		  $staffinfo['LRest']=$data[$i]['LRest'];
		  $result=$staff->save($staffinfo);
		  
		  if($result===false)
		  {		
			   $this->error( '第 '.++$i.' 行之后员工休假调休数据导入失败！uid = '.$data[$i-1]['uid'] );	
			   exit();
		  }
		 		 		  
		 }
		  
		  	$staff->commit();
			  $this->success ( '员工休假调休导入成功！' );	
		 

	
	
	
	}
	
		
		/*************************************************************************************/
		
		
		
		 /* 导出excel函数*/
     public function doexport(){
 
		if(!file_exists('..\excel')) {
 			mkdir('..\excel');
 		}
 		if(!file_exists('..\excel\attendance')) {
			mkdir('..\excel\attendance');
		}
 			
		$export_begin_time=$this->_post('export_begin_time');
		
		$export_end_time=$this->_post('export_end_time');
		if($export_begin_time==''||$export_end_time=='')
			{
						$this->error('开始日期和结束日期不能同时为空！');
			  			 exit();
			}
			
					
		
			$where= "op_unusualtime.standarddate>='"."$export_begin_time"."'  and op_unusualtime.standarddate<='"."$export_end_time"."'  ";
		
		   
          error_reporting(E_ALL);
           date_default_timezone_set('Asia/Shanghai');
          $objPHPExcel = new PHPExcel();
 			$clocktime=M('unusualtime');
            $name=date('YmdHis');
			
            $data=$clocktime->field("op_unusualtime.uid as uid,op_staffinfo.username as name,static,op_unusualtime.type as type,op_vacationtype.typemc as vacationtype,op_vacationstatus.holiday as holiday,op_vacationstatus.begindate as vbegindate,op_vacationstatus.begintime as vbegintime,op_vacationstatus.enddate as venddate,op_vacationstatus.endtime as vendtime,op_vacationstatus.transtype as transtype,op_vacationstatus.isapproved as isapproved,
			
			CASE 
			 WHEN  op_unusualtime.static = '正常' THEN  op_unusualtime.standardtime
			 
			 ELSE op_unusualtime.clocktime END AS clocktime,
			 
			 CASE 
			 WHEN  op_unusualtime.static = '正常' THEN  op_unusualtime.standarddate
			 
			 ELSE op_unusualtime.clockdate END AS clockdate
			
			")->join('op_staffinfo ON op_unusualtime.uid=op_staffinfo.uid')
			->join('op_vacationstatus ON op_unusualtime.vacid = op_vacationstatus.id')
			->join('op_vacationtype ON op_vacationstatus.transtype = op_vacationtype.typedm')
			->where($where)->order('op_unusualtime.uid asc, op_unusualtime.standarddate  asc,op_unusualtime.type asc')->select();
			//echo $clocktime->getLastSql();
			$flag=0;
			$haveend=1; //表示已经下班
			
			/*
			从第一条考勤记录开始遍历：
			如果是上班记录，并且上一条记录只有上班没有下班，那么该条记录将作为下一条存储记录（$flag++）；
			如果是上班记录，并且上一条已经下班，那么该条记录自动记录下一条考勤记录（下班时$flag已经自动++）；
			如果是下班记录，则判断是不是上一个上班记录属于同一个员工，如果是则记录下班记录，$flag++，haveend置为1表示上下班已经配对；
			如果是下班记录，但是该下班记录不属于上一个员工的下班记录，那么上一个员工的下班记录为0，下一个员工的下班记录为当前记录，但是没有上班记录，置为0；
			
			
			*/
			foreach($data as $k => $temp){
				if($temp['type']==0)  //如果是上班就保存查询到的时间日期为上班时间日期
				{
						if($haveend==0)  //之前考勤周期只有上班没有下班，就自动跳转到下一个考勤周期
						{
						$flag=$flag+1;
						$pdata[$flag]['uid']=$temp['uid'];
						$pdata[$flag]['name']=$temp['name'];
						$pdata[$flag]['begindate']=$temp['clockdate'];
						$pdata[$flag]['begintime']=$temp['clocktime'];
						$pdata[$flag]['statica']=$temp['static'];
						$pdata[$flag]['holidaya']=$temp['holiday'];
						$pdata[$flag]['vacationtypea']=$temp['vacationtype'];
/********************************************begin***********************************************/						
						//加班时间
						
						if($temp['transtype']==''||$temp['transtype']==2)
						    {
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';	
			                }
						else if($temp['transtype']==1&&$temp['isapproved']==1)
						{
							$pdata[$flag]['jbbegindate']=$temp['vbegindate'];
							$pdata[$flag]['jbbegintime']=$temp['vbegintime'];
							$pdata[$flag]['jbenddate']=$temp['venddate'];
							$pdata[$flag]['jbendtime']=$temp['vendtime'];
							
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';
							
							
					    }
							//休假时间
					  else if($temp['transtype']==3&&$temp['isapproved']==1)
							{
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							
							$pdata[$flag]['xjbegindate']=$temp['vbegindate'];
							$pdata[$flag]['xjbegintime']=$temp['vbegintime'];
							$pdata[$flag]['xjenddate']=$temp['venddate'];
							$pdata[$flag]['xjendtime']=$temp['vendtime'];
								
								
								}
								//出差时间
								

						else if($temp['transtype']==1&&$temp['isapproved']==0)
						    
							{
								
							$pdata[$flag]['jbbegindate']='未通过审批';
							$pdata[$flag]['jbbegintime']='未通过审批';
							$pdata[$flag]['jbenddate']='未通过审批';
							$pdata[$flag]['jbendtime']='未通过审批';
							
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';
								
								}
								
						else if($temp['transtype']==3&&$temp['isapproved']==0)
						{
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							
							$pdata[$flag]['xjbegindate']='未通过审批';
							$pdata[$flag]['xjbegintime']='未通过审批';
							$pdata[$flag]['xjenddate']='未通过审批';
							$pdata[$flag]['xjendtime']='未通过审批';
									
									}
									
			
						    
							
/****************************************end***************************************************/								
						$pdata[$flag]['enddate']='0000-00-00';
						$pdata[$flag]['endtime']='00:00:00';

						$pdata[$flag]['staticb']='请到考勤系统具体查询';
						$pdata[$flag]['holidayb']=$temp['holiday'];
						$pdata[$flag]['vacationtypeb']=$temp['vacationtype'];


						
						
						
						}
	/****************************************else if  haven=1 ***************************************************/	
						else             //之前考勤记录已经下班，之前下班时已经跳转到了下一个周期
						{
						$pdata[$flag]['uid']=$temp['uid'];
						$pdata[$flag]['name']=$temp['name'];
						$pdata[$flag]['begindate']=$temp['clockdate'];
						$pdata[$flag]['begintime']=$temp['clocktime'];
						$pdata[$flag]['statica']=$temp['static'];
						$pdata[$flag]['holidaya']=$temp['holiday'];
						$pdata[$flag]['vacationtypea']=$temp['vacationtype'];


/****************************************如果是加班或者请假 添加相应数据  ***************************************************/	
						if($temp['transtype']==''||$temp['transtype']==2)
						    {
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';	
			                }
						else if($temp['transtype']==1&&$temp['isapproved']==1)
						{
							$pdata[$flag]['jbbegindate']=$temp['vbegindate'];
							$pdata[$flag]['jbbegintime']=$temp['vbegintime'];
							$pdata[$flag]['jbenddate']=$temp['venddate'];
							$pdata[$flag]['jbendtime']=$temp['vendtime'];
							
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';
							
							
					    }
							//休假时间
					  else if($temp['transtype']==3&&$temp['isapproved']==1)
							{
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							
							$pdata[$flag]['xjbegindate']=$temp['vbegindate'];
							$pdata[$flag]['xjbegintime']=$temp['vbegintime'];
							$pdata[$flag]['xjenddate']=$temp['venddate'];
							$pdata[$flag]['xjendtime']=$temp['vendtime'];
								
								
								}
								//出差时间
								

						else if($temp['transtype']==1&&$temp['isapproved']==0)
						    
							{
								
							$pdata[$flag]['jbbegindate']='未通过审批';
							$pdata[$flag]['jbbegintime']='未通过审批';
							$pdata[$flag]['jbenddate']='未通过审批';
							$pdata[$flag]['jbendtime']='未通过审批';
							
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';
								
								}
								
						else if($temp['transtype']==3&&$temp['isapproved']==0)
						{
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							
							$pdata[$flag]['xjbegindate']='未通过审批';
							$pdata[$flag]['xjbegintime']='未通过审批';
							$pdata[$flag]['xjenddate']='未通过审批';
							$pdata[$flag]['xjendtime']='未通过审批';
									
									}
							
	/****************************************如果是加班或者请假 添加相应数据  ***************************************************/						
						
						
						$haveend=0;
			}
		/****************************************else if  haven=1  end ***************************************************/				
				
				
				}
				
				
				else if($temp['type']==1)  //如果是下班就保存下班时间作为下班时间日期，下一条数据就是下一个考勤周期的数据。
				{
							
							

							
							//该下班记录是上一个员工上班记录的另一半
							if($pdata[$flag]['uid']==$temp['uid'])
							{
							
							$pdata[$flag]['enddate']=$temp['clockdate'];
							$pdata[$flag]['endtime']=$temp['clocktime'];
							$pdata[$flag]['staticb']=$temp['static'];
							$pdata[$flag]['holidayb']=$temp['holiday'];
						    $pdata[$flag]['vacationtypeb']=$temp['vacationtype'];
	/*****************************如果请假、加班不为空则更新之前上班得到的请假、加班数据，覆盖掉之前上班所记录的数据**************************/
							//加班时间
						if($temp['transtype']==2)
						    {
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';	
			                }
						else if($temp['transtype']==1&&$temp['isapproved']==1)
						{
							$pdata[$flag]['jbbegindate']=$temp['vbegindate'];
							$pdata[$flag]['jbbegintime']=$temp['vbegintime'];
							$pdata[$flag]['jbenddate']=$temp['venddate'];
							$pdata[$flag]['jbendtime']=$temp['vendtime'];

							
							
					    }
							//休假时间
					  else if($temp['transtype']==3&&$temp['isapproved']==1)
							{
							
							$pdata[$flag]['xjbegindate']=$temp['vbegindate'];
							$pdata[$flag]['xjbegintime']=$temp['vbegintime'];
							$pdata[$flag]['xjenddate']=$temp['venddate'];
							$pdata[$flag]['xjendtime']=$temp['vendtime'];
								
								
								}
								//出差时间
								

						else if($temp['transtype']==1&&$temp['isapproved']==0)
						    
							{
								
							$pdata[$flag]['jbbegindate']='未通过审批';
							$pdata[$flag]['jbbegintime']='未通过审批';
							$pdata[$flag]['jbenddate']='未通过审批';
							$pdata[$flag]['jbendtime']='未通过审批';
							
					
								}
								
						else if($temp['transtype']==3&&$temp['isapproved']==0)
						{
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							
								
									}
								//出差时间
								
													
	/*****************************如果请假、加班不为空则更新之前上班得到的请假、加班数据，覆盖掉之前上班所记录的数据**************************/							                             $haveend=1;
							$flag=$flag+1;
							}
							//是另外一个员工的下班时间，则之前员工的下班时间置为空
				    else
							{
							$pdata[$flag-1]['enddate']='0000-00-00';
							$pdata[$flag-1]['endtime']='00:00:00';
							$pdata[$flag-1]['staticb']='请到考勤系统具体查询';
							$pdata[$flag-1]['holidayb']='';
						    $pdata[$flag-1]['vacationtypeb']='';

							$pdata[$flag]['uid']=$temp['uid'];
							$pdata[$flag]['name']=$temp['name'];
							$pdata[$flag]['begindate']='0000-00-00';
							$pdata[$flag]['begintime']='00:00:00';
							$pdata[$flag]['statica']='请到考勤系统具体查询';
							$pdata[$flag]['holidaya']='';
						    $pdata[$flag]['vacationtypea']='';
							
							$pdata[$flag]['enddate']=$temp['clockdate'];
							$pdata[$flag]['endtime']=$temp['clocktime'];
							$pdata[$flag]['staticb']=$temp['static'];
							$pdata[$flag]['holidayb']=$temp['holiday'];
						    $pdata[$flag]['vacationtypeb']=$temp['vacationtype'];
							
/*********************************************************************************/					
							//加班时间
						if($temp['transtype']==''||$temp['transtype']==2)
						    {
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';	
			                }
						else if($temp['transtype']==1&&$temp['isapproved']==1)
						{
							$pdata[$flag]['jbbegindate']=$temp['vbegindate'];
							$pdata[$flag]['jbbegintime']=$temp['vbegintime'];
							$pdata[$flag]['jbenddate']=$temp['venddate'];
							$pdata[$flag]['jbendtime']=$temp['vendtime'];
							
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';
							
							
					    }
							//休假时间
					  else if($temp['transtype']==3&&$temp['isapproved']==1)
							{
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							
							$pdata[$flag]['xjbegindate']=$temp['vbegindate'];
							$pdata[$flag]['xjbegintime']=$temp['vbegintime'];
							$pdata[$flag]['xjenddate']=$temp['venddate'];
							$pdata[$flag]['xjendtime']=$temp['vendtime'];
								
								
								}
								//出差时间
								

						else if($temp['transtype']==1&&$temp['isapproved']==0)
						    
							{
								
							$pdata[$flag]['jbbegindate']='未通过审批';
							$pdata[$flag]['jbbegintime']='未通过审批';
							$pdata[$flag]['jbenddate']='未通过审批';
							$pdata[$flag]['jbendtime']='未通过审批';
							
							$pdata[$flag]['xjbegindate']='';
							$pdata[$flag]['xjbegintime']='';
							$pdata[$flag]['xjenddate']='';
							$pdata[$flag]['xjendtime']='';
								
								}
								
						else if($temp['transtype']==3&&$temp['isapproved']==0)
						{
							$pdata[$flag]['jbbegindate']='';
							$pdata[$flag]['jbbegintime']='';
							$pdata[$flag]['jbenddate']='';
							$pdata[$flag]['jbendtime']='';
							
							$pdata[$flag]['xjbegindate']='未通过审批';
							$pdata[$flag]['xjbegintime']='未通过审批';
							$pdata[$flag]['xjenddate']='未通过审批';
							$pdata[$flag]['xjendtime']='未通过审批';
									
									}
							
	/*********************************************************************************/									
								
								}
					
					}
					
						
			
				
				
				
				}
			
			
			
        /*以下是一些设置 ，什么作者  标题啊之类的*/
          $objPHPExcel->getProperties()->setCreator("OOPS")
                                ->setLastModifiedBy("OOPS")
                                ->setTitle("数据EXCEL导出")
                                ->setSubject("数据EXCEL导出")
                                ->setDescription("报表导出")
                                ->setKeywords("excel")
                               ->setCategory("result file");
          /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
		  $a=1;
		  $objPHPExcel->setActiveSheetIndex(0)
 
                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
                           ->setCellValue('A'.$a, 'ID')    
                           ->setCellValue('B'.$a, '姓名')
                           ->setCellValue('C'.$a,  '上班打卡日期')
                            ->setCellValue('D'.$a, '下班打卡日期')
                             ->setCellValue('E'.$a, '上班打卡时间')
                               ->setCellValue('F'.$a, '上班打卡状态')
							    ->setCellValue('G'.$a, '上班打卡备注')
								 ->setCellValue('H'.$a, '下班打卡时间')
								 ->setCellValue('I'.$a, '下班打卡状态')
								  ->setCellValue('J'.$a, '下班打卡备注')
								   ->setCellValue('K'.$a, '休假申请开始日期')
								    ->setCellValue('L'.$a, '休假申请开始时间')
									 ->setCellValue('M'.$a, '休假申请结束日期')
									 ->setCellValue('N'.$a, '休假申请结束时间')
										->setCellValue('O'.$a, '加班申请开始日期')
								 		 ->setCellValue('P'.$a, '加班申请开始时间')
								  			 ->setCellValue('Q'.$a, '加班申请结束日期')
								  			  ->setCellValue('R'.$a, '加班申请结束时间');
             
		  
         foreach($pdata as $k => $v){
 
             $num=$k+2;
              $objPHPExcel->setActiveSheetIndex(0)
 
                         //Excel的第A列，uid是你查出数组的键值，下面以此类推
                           ->setCellValue('A'.$num, $v['uid'])    
                           ->setCellValue('B'.$num, $v['name'])
                           ->setCellValue('C'.$num, $v['begindate'])
                            ->setCellValue('D'.$num, $v['enddate'])
                             ->setCellValue('E'.$num, $v['begintime'])
                               ->setCellValue('F'.$num, $v['statica'])
							    ->setCellValue('G'.$num, $v['holidaya'])
								 ->setCellValue('H'.$num, $v['endtime'])
								 ->setCellValue('I'.$num, $v['staticb'])
								 ->setCellValue('J'.$num, $v['holidayb'])
								 ->setCellValue('K'.$num, $v['xjbegindate'])
								 ->setCellValue('L'.$num, $v['xjbegintime'])
								 ->setCellValue('M'.$num, $v['xjenddate'])
								 ->setCellValue('N'.$num, $v['xjendtime'])
								 ->setCellValue('O'.$num, $v['jbbegindate'])
								 ->setCellValue('P'.$num, $v['jbbegintime'])
								 ->setCellValue('Q'.$num, $v['jbenddate'])
								 ->setCellValue('R'.$num, $v['jbendtime']);
             }
 
            $objPHPExcel->getActiveSheet()->setTitle('报表');
             $objPHPExcel->setActiveSheetIndex(0);
	
              $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
              $objWriter->save('../excel/attendance/Forms'."$name".'.xls');
			
				 /* 
			$file='D:/excel/forms/'.$file;
			$file='../'.$file;
			*/
          // header("Location:D:/excel/forms/Forms20140913000103.xls"); 
			//self::list_files_attendance();

		  	 $this->success ( '考勤报表导出成功' );
					
			
       }


    /*********************************************************************************************/

	
	function list_files_attendance() 
 { 
 
 		if(!file_exists('..\excel')) {
 			mkdir('..\excel');
 		}
 		if(!file_exists('..\excel\attendance')) {
			mkdir('..\excel\attendance');
		}
 
    $dir='..\excel\attendance/';
 	//$ip=gethostbyname($_ENV['COMPUTERNAME']);
	$ip='10.166.18.50:8082';
     if(is_dir($dir))        //判断参数是否为目录
     { 
         if($handle = opendir($dir))         //打开目录，返回文件句柄
         { 
             while(($file = readdir($handle)) !== false)         //读文件夹返回文件名，
                                                                 //成功，则该函数返回一个文件名，否则返回 false
             { 
                 if($file != "." && $file != ".." && $file != "Thumbs.db")       //三个文件不显示出来。进行判断。
                 { 
                     echo '<a target="_blank" href="'.'http://'.$ip.'/excel/attendance/'.$file.'">'.$file.'</a><br>'."\n";         //用 a 标签显示文件路径，和文件名。
                 } 
             } 
             closedir($handle);      //关闭文件夹句柄。
         } 
     } 
 }  
		
		
		
		
			
	function list_files_vacation() 
 { 
 
 	if(!file_exists('..\excel')) {
 			mkdir('..\excel');
 		}
 		if(!file_exists('..\excel\vacation')) {
			mkdir('..\excel\vacation');
		}
 
    $dir='..\excel\vacation/';
 	//$ip=gethostbyname($_ENV['COMPUTERNAME']);
	$ip='10.166.18.50:8082';
     if(is_dir($dir))        //判断参数是否为目录
     { 
         if($handle = opendir($dir))         //打开目录，返回文件句柄
         { 
             while(($file = readdir($handle)) !== false)         //读文件夹返回文件名，
                                                                 //成功，则该函数返回一个文件名，否则返回 false
             { 
                 if($file != "." && $file != ".." && $file != "Thumbs.db")       //三个文件不显示出来。进行判断。
                 { 
                     echo '<a target="_blank" href="'.'http://'.$ip.'/excel/vacation/'.$file.'">'.$file.'</a><br>'."\n";         //用 a 标签显示文件路径，和文件名。
                 } 
             } 
             closedir($handle);      //关闭文件夹句柄。
         } 
     } 
 }  
		
		
		
		
		
		
		
		
		/***********************************************************************************/
		
}




?>