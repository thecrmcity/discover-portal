<?php

if(!defined('BSPATH'))
{

	$bspath = dirname(__DIR__);
	include_once $bspath.'/config/database.php';

}
if(isset($_POST['change']))
{
	$newpass = $_POST['newpass'];
	$confimpass = $_POST['confimpass'];

	if($newpass == $confimpass)
	{
		$newpass = md5($_POST['newpass']);
		$table = "dis_operator";
		$data = array(
			'dis_password' => $newpass
		);
		$cond = array(
			'dis_id' => $canid
		);
		$obj = new Dbconnect();
		$obj->updateData($table,$data,$cond);
		header('Location:'.BSURL.'app/password.php?msg=save');
	}
	else
	{
		header('Location:'.BSURL.'app/password.php?msg=error');
	}
	
}