<?php
class PasswordAction extends Action {


//密码修改
public function passchange_do()
{
	$uid = $_SESSION['uid'];
	$oldpass = $this->_post('oldpass');
	$newpass1 = $this->_post('newpass1');
	$newpass2 = $this->_post('newpass2');
	
	$Userinfo = M('Userinfo');
	$row = $Userinfo->getByUid($uid);
	$ispassword = $row['password'];
	if($ispassword!=md5($oldpass))
		{
			echo 'olderror';
			exit;
		}
		else if(strcmp($newpass1,$newpass2)!=0)
		{
			echo 'diff';
			exit;
			
			}
			else if($newpass1==''||$newpass2=='')
			{
				echo 'passnull';
				exit;
				
				}
				else {
	$row['password'] = md5($newpass1);
	$row['updatetime'] = date('Y-m-d H:i:s');
	$rs = $Userinfo->save($row);
	if(!$rs)
	{
		echo 'failed';
		exit;	
	}
	echo 'ok';	
				}
}  
  
  
  
  
  
  
  


}

?>