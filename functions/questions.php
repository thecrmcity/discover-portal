<?php

if(!defined('BSPATH'))

{

	$bspath = dirname(__DIR__);
	include_once $bspath.'/config/database.php';

}

$params = array();

if(isset($_GET['case']))
{
	$case = $_GET['case'];

	switch($case)
	{
		case "assign":

		$userid = $_POST['userid'];
		$mainid = $_POST['mainid'];
		$cateid = $_POST['cateid'];
		

		$ques = $_POST['ques'];
			
		

		if(count($ques) > 0)
		{
			

			foreach($ques as $es)
			{
				$checkques = $_POST["checkques$es"];

				$table = "dis_assigned";
				$cond = array(
					'dis_comid' => $comid,
					'dis_quesid' => $es,
					'dis_createdby' => $canid,
				);
				$obj = new Dbconnect();
				$res = $obj->getOnedata($table,$cond);
				if($res != "")
				{
					$table = "dis_assigned";
					$data = array(
						'dis_comid' => $comid,
						'dis_canid' => $userid,
						'dis_mainid' => $mainid,
						'dis_cateid' => $cateid,
						'dis_active' => $checkques,
						'dis_createdby' => $canid,
						'dis_status' => '1'
					);
					$cond = array(
						'dis_quesid' => $es,
					);
					$obj = new Dbconnect();
					$obj->updateData($table,$data,$cond);
				}
				else
				{
					$table = "dis_assigned";
					$data = array(
						'dis_comid' => $comid,
						'dis_canid' => $userid,
						'dis_mainid' => $mainid,
						'dis_cateid' => $cateid,
						'dis_quesid' => $es,
						'dis_active' => $checkques,
						'dis_createdby' => $canid,
						'dis_status' => '1'
					);
					$obj = new Dbconnect();
					$obj->insertData($table,$data);
					
				}

				
			}
		}
		
		header('Location:'.BSURL.'app/assign-question.php?id='.$userid.'&s='.$mainid);
		
		break;
		case "answered":
		$slug = $_POST;

		// print_r($slug);
		// die;
		$firstslug = array_slice($slug, 0, 3);
		$secndslug = array_slice($slug, 3);

		$userid = $firstslug['userid'];
		$mainid = $firstslug['mainid'];
		$cateid = $firstslug['cateid'];

		$qno = count($secndslug['quesid']);
		
		for($i=0;$i<$qno;$i++)
		{
			$quesid = $secndslug['quesid'][$i];
			$ques = $secndslug["ques$quesid"];
			$optional = $secndslug["optional$quesid"];


			$table = "dis_answered";
			$cond = array(
				'dis_mainid' => $mainid,
				 'dis_canid' => $userid,
				  'dis_quesid' => $quesid
				);
			$obj = new Dbconnect();
			$slep = $obj->getOnedata($table,$cond);
			
			if($slep != "")
			{
				$table = "dis_answered";
				$data = "  `dis_answer`='$ques', `dis_optional`='$optional',  `dis_updateat`=now() ";
				$cond = " dis_mainid='$mainid' AND `dis_cateid`='$cateid' AND `dis_canid`='$userid' AND `dis_quesid`='$quesid' ";
				$obj = new Dbconnect();
				$obj->updateValue($table,$data,$cond);
			}
			else
			{
				$table = "dis_answered";
				$value = "  `dis_comid`, `dis_mainid`, `dis_cateid`, `dis_canid`, `dis_quesid`, `dis_answer`, `dis_optional`, `dis_updateby`, `dis_updateat`, `dis_status` ";
				$data = " '', '$mainid', '$cateid', '$userid', '$quesid', '$ques', '$optional', '$userid', now(), '1' ";
				$obj = new Dbconnect();
				$obj->insertValue($table,$value,$data);
			}

			
			
		}
		header('Location:'.BSURL.'app/user-business.php?s=Business&case=save');
		break;
		case "functionanswer":

		$slug = $_POST;
		$firstslug = array_slice($slug, 0, 3);
		$secndslug = array_slice($slug, 3);

		$userid = $firstslug['userid'];
		$mainid = $firstslug['mainid'];
		$cateid = $firstslug['cateid'];
		
		$qno = count($secndslug['quesid']);
		for($i=0;$i<$qno;$i++)
		{
			$quesid = $secndslug['quesid'][$i];
			$ques = @$secndslug["radioques$quesid"];
			$optional = $secndslug["optional$quesid"];

			
			$table = "dis_answered";
			$cond = array(
				'dis_mainid' => $mainid,
				'dis_canid' => $userid,
				'dis_quesid' => $quesid
				);
			$obj = new Dbconnect();
			$slep = $obj->getOnedata($table,$cond);
			
			if($slep != "")
			{
				$table = "dis_answered";
				$data = "  `dis_answer`='$ques', `dis_optional`='$optional',  `dis_updateat`=now() ";
				$cond = " dis_mainid='$mainid' AND `dis_cateid`='$cateid' AND `dis_canid`='$userid' AND `dis_quesid`='$quesid' ";
				$obj = new Dbconnect();
				$obj->updateValue($table,$data,$cond);
			}
			else
			{
				$table = "dis_answered";
				$value = "  `dis_comid`, `dis_mainid`, `dis_cateid`, `dis_canid`, `dis_quesid`, `dis_answer`, `dis_optional`, `dis_updateby`, `dis_updateat`, `dis_status` ";
				$data = " '', '$mainid', '$cateid', '$userid', '$quesid', '$ques', '$optional', '$userid', now(), '1' ";
				$obj = new Dbconnect();
				$obj->insertValue($table,$value,$data);
			}

			header('Location:'.BSURL.'app/user-functional.php?s=Functional&case=save');
		}

	

		break;
	}
}