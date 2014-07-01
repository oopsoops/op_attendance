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
			$uid_clocktime = $Model->where("uid='$uid'")->order('clocktime')->select();
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
			  $this->error('导入数据库失败');
			  $result->rollback();
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
			$where = "op_clocktime.uid = $uid ";
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
		->join('op_userinfo ON op_clocktime.uid=op_userinfo.uid')
		->join('op_department ON op_userinfo.departmentid=op_department.did')
		->join('op_unusualtime ON op_unusualtime.pid=op_clocktime.id')
		 ->where($where)
		 ->count();
		 
	    $allattendance=$clocktime
		->field("phone,op_clocktime.uid as uid,op_clocktime.clocktime as clocktime,op_clocktime.clockdate as clockdate,op_userinfo.username as username
		,op_department.departmentname as department,
		 CASE
			WHEN isapply=1 THEN '已请假'
			 END as isapply,
			
		 CASE 
			 WHEN static='迟到' THEN '迟到'
			 WHEN static='早退' THEN '早退'
			 ELSE '正常' END AS static")
		->join('op_userinfo ON op_clocktime.uid=op_userinfo.uid')
		->join('op_department ON op_userinfo.departmentid=op_department.did')
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
		$this->display();
    }
	
	
	
	public function new_staff_do()
	{
		
		$uid = $this->_post('staffid');
		$Model = M('userinfo');
		$rs = $Model->getByUid($uid);
		if($rs) {
			echo '该员工已存在！';
			exit;	
		}
		
		$Model = M('userinfo');
		
		$userinfo['uid'] = $uid;
		
		$userinfo['departmentid'] = $this->_post('department');
		
		$userinfo['usertypeid'] = $this->_post('stafftype');
		
		$userinfo['username'] = $this->_post('staffname');
		
		$userinfo['phone'] = $this->_post('phone');
		
		$userinfo['entrydate'] = $this->_get('entrytime');
		
		$userinfo['phone'] = $this->_post('phone');
		
		$loginname = $this->_post('newloginname');
		
		$passworda = $this->_post('userpassworda');
		
		$passwordb = $this->_post('userpasswordb');
					
		$userinfo['updatetime'] = date('Y-m-d H:i:s');
		
		if($loginname!='')
		{
			
			
			$rsa = $Model->getByLoginname($loginname);
			 if($rsa)
			 {
				 		
				echo 'loginexist';
				exit;	
			 }
			
			
			if($passworda == ''& $passwordb == '')
			{
				
			echo 'passwordnull';
			exit;
				}
				
				else if($passworda == ''|| $passwordb == '')
				{
				 echo 'bothpassword';
				 exit;
					
					
					}
					else if(strcmp($passworda , $passwordb)!=0)
						{
				
								 echo 'diffpassword';
								 exit;
				
							}
							
							else 
							{								
								
								
								$userinfo['loginname'] = $loginname;
								
								$userinfo['password'] =  md5($passworda);
								
								$rsend = $Model->add($userinfo);
								
								if(!$rsend) {
									$Model->rollback();
									echo '信息添加失败，请重试！';
									exit;	
									}
								echo 'ok';
											
							 }
					
			}
			
		else
		{
			$rsend = $Model->add($userinfo);
				
				if(!$rsend) {
					$Model->rollback();
					echo '信息添加失败，请重试！';
					exit;	
				}
		echo 'ok';
			
		
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
			
			$userinfo = M('userinfo');
			
			if($department == ''& $uid==''& $username == '')
			{
				
				$cc = $userinfo->count();
				$rs = $userinfo->field('op_userinfo.username as username,op_userinfo.uid as uid,op_department.departmentname as department')
				->join('op_department ON op_userinfo.departmentid = op_department.did')
				->order('op_userinfo.uid desc')
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
										$where = "$where and op_userinfo.uid = $uid ";
										
										}
										
										else if($uid !='')
										{
											$where = "op_userinfo.uid = $uid ";
											}
											
											
											if($username!='' & $where !='')
											{
												$where = "$where and op_userinfo.username = $username ";
												
												}
												
												else if($username != '')
												{
													$where = "op_userinfo.username = $username ";
													
													
													}
													
													
									$cc = $userinfo->where($where)->count();
									$rs = $userinfo->field('op_userinfo.username as username,op_userinfo.uid as uid,op_department.departmentname as department')
									->join('op_department ON op_userinfo.departmentid = op_department.did')
									->where($where)
									->order('op_userinfo.uid desc')
									->limit("$start,$rows")
									->select();			
					
					
					}
			//echo $userinfo->getLastSql();
			echo dataToJson($rs,$cc);
			
			}
	//删除员工信息
	
	function staffDel(){
		$uid = $this->_get('uid');
		$Userinfo = M('userinfo');
		$UserClockTime = M('clocktime');
		$UserUnusualTime = M('unusualtime');
		
		$rs1 = $Userinfo->where("uid=$uid")->delete();
		$rs2 = $UserClockTime->where("uid=$uid")->delete();
		$rs3 = $UserUnusualTime->where("uid=$uid")->delete();
			
			if(!$rs1 ||!$rs2||!$rs3) {
					$Userinfo->rollback();
					$UserClockTime->rollback();
					$UserUnusualTime->rollback();
					echo '删除失败，请重试！';
					exit;	
				}
		echo $rs1;
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
		
	
	$Userinfo = M('userinfo');
	$rs = $Userinfo->field('op_userinfo.username as username,op_userinfo.phone as phone,op_userinfo.entrydate as entrydate,op_userinfo.uid as uid,op_userinfo.departmentid as did,op_userinfo.usertypeid as typeid')->where("op_userinfo.uid=$uid")->select();
		
			$this->assign('userinfo',$rs);
			$this->display();
		
			//echo $Userinfo->getLastSql();
	
	
	}


public function staff_modify_do(){
	
	$uid=$this->_get('uid');
	$entrytime = $this->_get('entrytime');
	$department = $this->_post('department');
	$username = $this->_post('staffname');
	$stafftype = $this->_post('stafftype');
	$phone = $this->_post('phone');
	
	$modifyinfo = M('userinfo');
	
		 
	    $info=$modifyinfo->getByUid($uid);
		
	    $info['username'] =  $username;
		$info['entrydate'] = $entrytime;
		$info['departmentid'] =  $department;
		$info['phone'] = $phone;
		$info['usertypeid'] = $stafftype;
		$info['updatetime'] = date('Y-m-d H:i:s');
		
		$rs = $modifyinfo->save($info);
		
		//echo $checkdetails->getLastSql();
		
	if(!$rs) {
			echo '修改失败，请重试！';
			exit;	
		}
		echo 'ok';
	
	
	}


public function loginDetails(){
	
	
	 $uid = $this->_get('uid');
	 $login = M('log');
	 $userinfo = M('userinfo');
	 $rs = $userinfo->where("op_userinfo.uid = $uid")->select();
	 $cc = $login->where("op_log.uid = $uid")->count();
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
		
		$cc = $userinfo->where("op_log.uid=$uid")->count();
		
		$rs = $userinfo->field('op_log.uid as uid,op_log.logintime as logintime,op_log.quittime as quittime,op_userinfo.username as username')
						->join('op_userinfo ON op_userinfo.uid = op_log.uid')
						->where("op_log.uid = $uid")
						->order('op_log.logintime desc')
						->limit("$start,$rows")
						->select();
		
		echo dataToJson($rs,$cc);
		
		//echo $userinfo->getLastSql();
		}
		
		
		

}

?>