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
}

?>