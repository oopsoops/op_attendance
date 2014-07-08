<?php
vendor('Zend.ExcelToArrary');//导入excelToArray类
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
		
		$begin_time='';
		$end_time='';
		
			if($import_begin_time==''&&$import_end_time=='')
				{
						$this->error('开始日期和结束日期不能同时为空！');
			  			 exit();
					}
					
		if($import_begin_time!='')
		{
			$begin_time=strtotime($import_begin_time);
			}
			
			
			if($import_end_time!='')
			{
				$end_time=strtotime($import_begin_time);
				}
				
				

				
				
		
		 /*判别是不是.xls文件，判别是不是excel文件*/
		 if (strtolower ( $file_type ) != "xlsx" && strtolower ( $file_type ) != "xls")              
		 {
			  $this->error ( '不是Excel文件，重新选择' );
			 
			  
		 }
	
		 /*设置上传路径
		 $savePath = C('UPLOAD_DIR');
	*/
		 /*以时间来命名上传的文件
		 $str = date ( 'Ymdhis' ); 
		 $file_name = $str . "." . $file_type;
		 */
		 /*是否上传成功
		 if (! copy ( $tmp_file, $savePath . $file_name )) 
		  {
			  $this->error ( '上传失败' );
		  }*/
		$ExcelToArrary=new ExcelToArrary();//实例化
		//$res=$ExcelToArrary->read(C('UPLOAD_DIR').$file_name,"UTF-8",$file_type);//传参,判断office2007还是office2003
		$res=$ExcelToArrary->read($tmp_file,"UTF-8",$file_type);//传参,判断office2007还是office2003
		if($begin_time!=''&$end_time!='')
		{
					foreach ( $res as $k => $v ) //循环excel表
					   {
						   $k=$k-1;//addAll方法要求数组必须有0索引
					   if(strtotime($v[1])>=$begin_time&strtotime($v[1])<=$end_time)
					   {
					   $data[$k]['uid'] = $v [0];//创建二维数组
					   $data[$k]['clockdate'] = $v [1];
					   $data[$k]['clocktime'] = $v [2];
					   }
					
		
						}
		}
		
		else if($begin_time!='')
		{
			
					foreach ( $res as $k => $v ) //循环excel表
				   {
					   $k=$k-1;//addAll方法要求数组必须有0索引
					   if(strtotime($v[1])>=$begin_time)
					   {
					   $data[$k]['uid'] = $v [0];//创建二维数组
					   $data[$k]['clockdate'] = $v [1];
					   $data[$k]['clocktime'] = $v [2];
					   }
		
					}
			}
			
		else if($end_time!='')
		{
					foreach ( $res as $k => $v ) //循环excel表
				   {
					   $k=$k-1;//addAll方法要求数组必须有0索引
					   if(strtotime($v[1])<=$end_time)
					   {
					   $data[$k]['uid'] = $v [0];//创建二维数组
					   $data[$k]['clockdate'] = $v [1];
					   $data[$k]['clocktime'] = $v [2];
					   }
		
				
		
				  }
		}
		
				
		else
		{
					foreach ( $res as $k => $v ) //循环excel表
				   {
					   $k=$k-1;//addAll方法要求数组必须有0索引
					   $data[$k]['uid'] = $v [0];//创建二维数组
					   $data[$k]['clockdate'] = $v [1];
					   $data[$k]['clocktime'] = $v [2];
	
				  }
		}
		  $kucun=M('clocktime');//M方法
		  $result=$kucun->addAll($data);
		  if(!$result)
		  {
			  
			  $result->rollback();
			  $this->error('导入数据库失败');
			  exit();
		  }
		  else
		  {
			  $this->success ( '导入成功' );	
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
		
		$search_begin_time = $this->_post('hrsearch_begin_time');
		
		$search_end_time = $this->_post('hrsearch_end_time');
		

				
		if($uid!='') {
			$where = 'op_clocktime.uid = "'.$uid.' "' ;
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
		->join('op_satffinfo ON op_clocktime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_unusualtime ON op_unusualtime.pid=op_clocktime.id')
		 ->where($where)
		 ->count();
		 
	    $allattendance=$clocktime
		->Distinct(true)
		->field("phone,op_clocktime.uid as uid,op_clocktime.clocktime as clocktime,op_clocktime.clockdate as clockdate,op_staffinfo.username as username
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,
		 CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply,
			
		 CASE 
			 WHEN static='迟到' THEN '迟到'
			 WHEN static='早退' THEN '早退'
			 ELSE '正常' END AS static")
		->join('op_staffinfo ON op_clocktime.uid=op_staffinfo.uid')
		->join('op_department ON op_staffinfo.departmentid=op_department.did')
		->join('op_teaminfo ON op_teaminfo.tid = op_staffinfo.teamif')
		->join('op_unusualtime ON op_unusualtime.pid=op_clocktime.id')
		->where($where)
		 ->order('op_clocktime.uid desc')
		->limit("$start,$rows")
		->select();
		
	//echo $clocktime->getLastSql();
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
							$Model->rollback();
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
												
											$adduser = M('userinfo');
											
											$staffinfo['loginname'] = $loginname;
											
											$staffinfo['password'] =  md5('12345');
											
											$staffinfo['accountstatue'] = 0;
												
											$rsuser = $adduser->add($staffinfo);
												
											if(!$rsuser)
												{
												$Model->rollback();
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
		
		
		if(count($getuserinfo)>0)
		{
						$rs1 = $userinfo->where('uid="'.$uid.'"')->delete();
						
							if(!$rs1) {
				
									echo '删除失败，请重试！';
									exit;	
								}
		}
		
		
		if(count($getuserClockTime)>0)
		{
						$rs2 = $userClockTime->where('uid="'.$uid.'"')->delete();
				
						if(!$rs2 ) {
								$userinfo->rollback();
								echo '删除失败，请重试！';
								exit;	
							}
		}
				
				
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
	$modifyinfo = M('staffinfo');
	$userinfo = M('userinfo');
	//$power = M('usertype');
	

		//$power=$power->getByTid($stafftype);
		
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
			
		$getuser['username'] =  $username;
		$getuser['entrydate'] = $entrytime;
		$getuser['departmentid'] =  $department;
		$getuser['teamid'] =  $teamid;
		$getuser['phone'] = $phone;
		$getuser['email'] = $email;
		$getuser['usertypeid'] = $stafftype;
		$getuser['updatetime'] = date('Y-m-d H:i:s');
		$rsuser = $userinfo->save($getuser);
			
			if(!rsuser)
			{
			$modifyinfo->rollback();
			echo '修改失败，请重试！';
			exit;	
			}
	}
		//echo $userinfo->getLastSql();
		echo 'ok';
	
	
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
				
				$rs=$sample->field('uid,username,department,usertype,entrydate,costcenterid,phone,email,teamid')->limit("$start,$rows")->select();
				
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
	
	
		$ExcelToArrary=new ExcelToArrary();//实例化
		//$res=$ExcelToArrary->read(C('UPLOAD_DIR').$file_name,"UTF-8",$file_type);//传参,判断office2007还是office2003
		$flag=0;
		$res=$ExcelToArrary->read($tmp_file,"UTF-8",$file_type);//传参,判断office2007还是office2003
		
					foreach ( $res as $k => $v ) //循环excel表
					   {
								//$s=$k;//addAll方法要求数组必须有0索引
							    $k=$k-1;
								if($k>0)
								{
							   $data[$flag]['uid'] = $v [0];//创建二维数组
							   $data[$flag]['username'] = $v [1];
							   $data[$flag]['departmentid'] = $v [2];
							   $data[$flag]['teamid'] = $v [3];
							   $data[$flag]['usertypeid'] = $v [4];
							   $data[$flag]['costcenterid'] =$v [5];
							   $data[$flag]['entrydate'] = $v [6];
							   $data[$flag]['phone'] = $v [7];
							   $data[$flag]['email'] = $v [8];
							   $data[$flag]['updatetime'] =  date('Y-m-d H:i:s');
							   $flag=$flag+1;
								}
						}
		
		  $infotable=M('staffinfo');//M方法
		  $result=$infotable->addAll($data);
		  
		  if(!$result)
		  {
			  $result->rollback();
			  $this->error('导入失败，请检查格式从新导入！');
			  //echo $infotable->getLastSql();
			  
			  exit();
		  }
		  else
		  {
			  $this->success ( '导入成功' );	
		  }
				
	}

}

?>