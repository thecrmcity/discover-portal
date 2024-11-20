<?php

if(!defined('BSPATH'))
{

	$bspath = dirname(__DIR__);
	include_once $bspath.'/config/database.php';

}
if(isset($_POST['login']))
{
	
	$usemail = $_POST['usemail'];
	$userpass = md5($_POST['userpass']);

	$table = "dis_operator";
	$cond = array(
		'dis_email' => $usemail,
		'dis_password' => $userpass
	);
	$res = $obj->getOnedata($table,$cond);
	if($res != "")
	{
		$_SESSION['comid'] = $res['dis_comid'];
		$_SESSION['name'] = $res['dis_name'];
		$_SESSION['email'] = $res['dis_email'];
		$_SESSION['role'] = $res['dis_role'];
		$_SESSION['id'] = $res['dis_id'];
		header("Location:".APP."dashboard.php");
	}
	else
	{
		header("Location:".BSURL."login.php?err");
	}
}
