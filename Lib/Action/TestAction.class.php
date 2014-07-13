<?php 
vendor('Zend.ExcelToArrary');//导入excelToArray类
class TestAction extends Action
{

	public function doexcel()
	{	
		$tmp_file = $_FILES ['file_stu'] ['tmp_name'];
		$file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
		$file_type = $file_types [count ( $file_types ) - 1];
		
		
		
		
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
		foreach ( $res as $k => $v ) //循环excel表
		   {
			   $k=$k-1;//addAll方法要求数组必须有0索引
			   $data[$k]['uid'] = $v [0];//创建二维数组
			    $data[$k]['clockdate'] = $v [1];
			   $data[$k]['clocktime'] = $v [2];
		

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
		,op_department.departmentname as department,op_teaminfo.teamname as teamname,op_clocktime.id as clockid,
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
	
	/****************************************/
	
	
		public function testTimeChange() {
		
	   $clockid = $this->_get('clockid');

		$usertime = M('clocktime');
		

		 
	    $info=$usertime
		->field("op_clocktime.uid as uid,op_clocktime.clockdate as clockdate,op_clocktime.time as clocktime")
		
		->where("op_clocktime.id = $clockid")
	    ->select();
		//echo $userdetails->getLastSql();
		$this->assign('clockinfo',$info[0]);
		$this->display();
    }
	
	
	
	
	
	public function time_modify_do(){
	
	$clockid=$this->_get('clockid');
	$clockdate = $this->_post('clockdate');
	$clocktime = $this->_post('clocktime');
	
	$clockModify = M('clocktime');
	
	$unususl =  M('unusualtime');
	
	    $clockinfo=$clockModify->getById($clockid);
		
		
		
	    $staffinfo['clockdate'] =  $clockdate;
		$staffinfo['clocktime'] = $clocktime;
	
		
		$rs = $modifyinfo->save($staffinfo);
		
		//echo $checkdetails->getLastSql();
		
	if(!$rs) {
			echo '修改失败，请重试！';
			exit;	
		}
		
		$rss = $unusual->where("op_unusualtime.pid = $clockid")->delete();
		
		if(!$rss){
			$clockModify->rollback();
			echo '修改失败，请重试！';
			exit;	
			
			}
		echo 'ok';
		
		
		
	
	
	}
	
	
}

?>