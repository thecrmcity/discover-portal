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
		case "mastercate":
		$p = $_GET['p'];
		$active = $_POST['active'];
		$catename = $_POST['catename'];
		$catefor = $_POST['catefor'];
		$table = "dis_master";

		$cond = array(
			'dis_name' => $catename,
			'dis_category' => 'master',
			'dis_parent' => $catefor,
			'dis_status' => '1'
		);
		$checkpost = $obj->getOnedata($table,$cond);
		if($checkpost != "")
		{
			header('Location:'.BSURL.'app/master-category.php?i=duplicate');
		}
		else
		{
			if($active != "")
			{
				
				$data = array(
					'dis_name' => $catename,
					'dis_category' => 'master',
					'dis_parent' => $catefor,
					'dis_status' => '1'
				);
			}
			else
			{
				
				$data = array(
					'dis_name' => $catename,
					'dis_category' => 'master',
					'dis_parent' => $catefor,
					'dis_status' => '0'
				);
			}

			$obj->insertData($table,$data);
			header('Location:'.BSURL.'app/master-category.php');
		}
		
		
		break;
		case "editmaster":
		$p = $_GET['p'];
		$id = $_GET['id'];
		$active = $_POST['active'];
		$catename = $_POST['catename'];
		$catefor = $_POST['catefor'];
		$table = "dis_master";

		$cond = array(
			'dis_name' => $catename,
			'dis_category' => 'master',
			'dis_parent' => $catefor,
			'dis_status' => '1'
		);
		$checkpost = $obj->getOnedata($table,$cond);
		if($checkpost != "")
		{
			header('Location:'.BSURL.'app/master-category.php?i=duplicate');
		}
		else
		{
			if($active != "")
			{
				
				$data = array(
					'dis_name' => $catename,
					'dis_category' => 'master',
					'dis_parent' => $catefor,
					'dis_status' => '1'
				);
				
			}
			else
			{
				
				$data = array(
					'dis_name' => $catename,
					'dis_category' => 'master',
					'dis_parent' => $catefor,
					'dis_status' => '0'
				);
				
			}
			$cond = array(
					'dis_id' => $id
				);

			$obj->updateData($table,$data,$cond);
			header('Location:'.BSURL.'app/master-category.php');
		}
		break;
		case "delmaster":
		$data = array(
					
					'dis_status' => '0'
				);
		$id = $_GET['id'];
		$table = "dis_master";

		$cond = array(
					'dis_id' => $id
				);
		$obj->updateData($table,$data,$cond);
		header('Location:'.BSURL.'app/master-category.php');
		break;
		case "delques":

		$id = $_GET['id'];
		$table = "dis_questionset";
		$data = array(
					
					'dis_status' => '0'
				);
		

		$cond = array(
					'dis_id' => $id
				);
		$obj->updateData($table,$data,$cond);
		header('Location:'.BSURL.'app/view-questions.php?s=Functional');
		break;
		case "addbusiness":
		function dataval($text)
		{
			$texts = trim($text);
			$texto = str_replace("'", "\'", $texts);
			return $texto;

		}
		$question = dataval($_POST['question']);
		$quesdetails = dataval($_POST['quesdetails']);
		$master = $_POST['master'];
		$nature = $_POST['nature'];
		$subcateory = $_POST['subcateory'];
		$questyp = $_POST['questyp'];

		

		if($questyp == "Options")
		{
			$optionset = "";
			$optionval = $_POST['optionval'];
			
			foreach($optionval as $val)
			{
				$optionset .= $val.";";
			}
			$table = "dis_questionset";
				$data = array(
					'dis_master' => $master,
					'dis_category' => $subcateory,
					'dis_nature' => $nature,
					'dis_question' => $question,
					'dis_quesdetails' => $quesdetails,
					'dis_type' => $questyp,
					'dis_typevalue' => $optionset,
					'dis_status' => '1'
				);
				$obj->insertData($table,$data);
		}
		else
		{
			$table = "dis_questionset";
				$data = array(
					'dis_master' => $master,
					'dis_category' => $subcateory,
					'dis_nature' => $nature,
					'dis_question' => $question,
					'dis_quesdetails' => $quesdetails,
					'dis_type' => $questyp,
					'dis_status' => '1'
				);
				$obj->insertData($table,$data);
		}
		
		header("Location:".BSURL."app/create-question.php?s=$master");
		break;
		case "editbusinessques":
		function dataval($text)
		{
			$texts = trim($text);
			$texto = str_replace("'", "\'", $texts);
			return $texto;

		}
		$question = dataval($_POST['question']);
		$quesdetails = dataval($_POST['quesdetails']);
		$master = 'Business';
		$nature = $_POST['nature'];
		$subcateory = $_POST['subcateory'];
		$questyp = $_POST['questyp'];
		$qusid = $_POST['qusid'];
		

		if($questyp == "Options")
		{
			$optionset = "";
			$optionval = $_POST['optionval'];
			
			foreach($optionval as $val)
			{
				$optionset .= $val.";";
			}
			$table = "dis_questionset";
			$data = array(
				'dis_master' => $master,
				'dis_category' => $subcateory,
				'dis_nature' => $nature,
				'dis_question' => $question,
				'dis_quesdetails' => $quesdetails,
				'dis_type' => $questyp,
				'dis_typevalue' => $optionset,
				'dis_status' => '1'
			);
			$cond = array(
				'dis_id' => $qusid
			);
			$obj->updateData($table,$data,$cond);
		}
		else
		{
			$table = "dis_questionset";
			$data = array(
				'dis_master' => $master,
				'dis_category' => $subcateory,
				'dis_nature' => $nature,
				'dis_question' => $question,
				'dis_quesdetails' => $quesdetails,
				'dis_type' => $questyp,
				'dis_status' => '1'
			);
			$cond = array(
				'dis_id' => $qusid
			);
			$obj->updateData($table,$data,$cond);
		}
		
		header("Location:".BSURL."app/view-questions.php?s=Business");
		break;
		case "addfunctional":

		function dataval($text)
		{
			$texts = trim($text);
			$texto = str_replace("'", "\'", $texts);
			return $texto;

		}

		$question = dataval($_POST['question']);
		$quesdetails = dataval($_POST['quesdetails']);
		$master = $_POST['master'];
		$nature = $_POST['nature'];
		$subcateory = $_POST['subcateory'];

		$table = "dis_questionset";
		$data = array(
			'dis_master' => $master,
			'dis_category' => $subcateory,
			'dis_nature' => $nature,
			'dis_question' => $question,
			'dis_quesdetails' => $quesdetails,
			'dis_type' => 'Radio',
			'dis_status' => '1'
		);
		$obj->insertData($table,$data);

		header('Location:'.BSURL."app/create-question.php?s=$master");
		break;
		
		case "editfunctionalques":
		function dataval($text)
		{
			$texts = trim($text);
			$texto = str_replace("'", "\'", $texts);
			return $texto;

		}

		$question = dataval($_POST['question']);
		$quesdetails = dataval($_POST['quesdetails']);
		
		$nature = $_POST['nature'];
		$subcateory = $_POST['subcateory'];
		$qusid = $_POST['qusid'];

		$table = "dis_questionset";
		$data = array(
			'dis_master' => 'Functional',
			'dis_category' => $subcateory,
			'dis_nature' => $nature,
			'dis_question' => $question,
			'dis_quesdetails' => $quesdetails,
			'dis_type' => 'Radio',
			'dis_status' => '1'
		);
		$cond = array(
			'dis_id' => $qusid
		);
		$obj->updateData($table,$data,$cond);
		header('Location:'.BSURL."app/view-questions.php?s=Functional");
		break;
		case "addadmin":
		
		$fullname = $_POST['fullname'];
		$mobileno = $_POST['mobileno'];
		$usemail = $_POST['usemail'];
		$password = md5($_POST['password']);
		$country = $_POST['country'];
		$company = $_POST['company'];

		$table = "dis_operator";
		$cond = array(
			'dis_email' => $usemail,
			'dis_delete' => '1',
			'dis_status' => '1'
		);
		$getOne = $obj->getOnedata($table,$cond);
		if($getOne != "")
		{
			header('Location:'.BSURL.'app/create-admin.php?i=duplicate');
		}
		else
		{
			$table = "dis_operator";
			$data = array(
				'dis_comid' => $company,
				'dis_name' => $fullname,
				'dis_mobile' => $mobileno,
				'dis_email' => $usemail,
				'dis_password' => $password,
				'dis_country' => $country,
				'dis_role' => 'Admin',
				'dis_createdby' => $canid,
				'dis_delete' => '1',
				'dis_status' => '1'
			);
			$obj->insertData($table,$data);

			header('Location:'.BSURL.'app/create-admin.php');
		}

		
		break;
		case "addchild":
		$fullname = $_POST['fullname'];
		$mobileno = $_POST['mobileno'];
		$usemail = $_POST['usemail'];
		$password = md5($_POST['password']);
		$country = $_POST['country'];
		$company = $_POST['company'];

		$table = "dis_operator";
		$cond = array(
			'dis_email' => $usemail,
			'dis_delete' => '1',
			'dis_status' => '1'
		);
		$getOne = $obj->getOnedata($table,$cond);
		if($getOne != "")
		{
			header('Location:'.BSURL.'app/create-child.php?i=duplicate');
		}
		else
		{
			$table = "dis_operator";
			$data = array(
				'dis_comid' => $company,
				'dis_name' => $fullname,
				'dis_mobile' => $mobileno,
				'dis_email' => $usemail,
				'dis_password' => $password,
				'dis_country' => $country,
				'dis_role' => 'Child',
				'dis_createdby' => $canid,
				'dis_delete' => '1',
				'dis_status' => '1'
			);
			$obj->insertData($table,$data);

			header('Location:'.BSURL.'app/create-child.php');
		}

		
		
		break;
		case "adminpass":
		$id = $_GET['id'];
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];
		if($password === $confirm)
		{
			$password = md5($_POST['password']);

			$table = "dis_operator";
			$data = array(

				'dis_password' => $password
			);
			$cond = array(
				'dis_id' => $id
			);
			$obj->updateData($table,$data,$cond);
			echo "<script>alert('Password Change Successfully!'); window.location.href='".BSURL."app/create-admin.php'</script>";
		}
		else
		{
			echo "<script>alert('Password Not Correct!'); window.location.href='".BSURL."app/create-admin.php'</script>";
		}
		break;
		case "editadmin":
		$id = $_GET['id'];
		$fullname = $_POST['fullname'];
		$mobileno = $_POST['mobileno'];
		$usemail = $_POST['usemail'];
		$country = $_POST['country'];
		$company = $_POST['company'];


		if($password != "")
		{
			$table = "dis_operator";
			$data = array(

				'dis_comid' => $company,
				'dis_name' => $fullname,
				'dis_mobile' => $mobileno,
				'dis_email' => $usemail,
				'dis_country' => $country,
				'dis_role' => 'Admin',
				'dis_createdby' => $canid,
				'dis_delete' => '1',
				'dis_status' => '1'
			);
			$cond = array(
				'dis_id' => $id
			);
			$obj->updateData($table,$data,$cond);
		}
		else
		{
			$table = "dis_operator";
			$data = array(

				'dis_comid' => $company,
				'dis_name' => $fullname,
				'dis_mobile' => $mobileno,
				'dis_email' => $usemail,
				'dis_country' => $country,
				'dis_role' => 'Admin',
				'dis_createdby' => $canid,
				'dis_delete' => '1',
				'dis_status' => '1'
			);
			$cond = array(
				'dis_id' => $id
			);
			$obj->updateData($table,$data,$cond);
		}
		

		header('Location:'.BSURL.'app/create-admin.php');
		
		
		break;
		case "adduser":

		$fullname = $_POST['fullname'];
		$mobileno = $_POST['mobileno'];
		$usemail = $_POST['usemail'];
		$password = md5($_POST['password']);
		$country = $_POST['country'];
		$company = $_POST['company'];
		$comlogo = $_FILES["comlogo"]["name"];

        $target_dir = "../uploads/";
		$target_file = $target_dir . basename($_FILES["comlogo"]["name"]);
		move_uploaded_file($_FILES["comlogo"]["tmp_name"], $target_file);

		$table = "dis_operator";
		$data = array(
			'dis_comid' => $comid,
			'dis_name' => $fullname,
			'dis_mobile' => $mobileno,
			'dis_email' => $usemail,
			'dis_password' => $password,
			'dis_country' => $country,
			'dis_role' => 'User',
			'dis_company' => $company,
			'dis_logo' => $comlogo,
			'dis_createdby' => $canid,
			'dis_delete' => '1',
			'dis_status' => '1'
		);
		$obj->insertData($table,$data);

		header('Location:'.BSURL.'app/add-user.php');

		
		break;
		case "userpass":
		$id = $_GET['id'];
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];
		
		if($password === $confirm)
		{
			$password = md5($_POST['password']);

			$table = "dis_operator";
			$data = array(
				'dis_password' => $password
			);
			$cond = array(
				'dis_id' => $id
			);
			$obj->updateData($table,$data,$cond);
			echo "<script>alert('Password Change Successfully!'); window.location.href='".BSURL."app/add-user.php'</script>";
		}
		else
		{
			echo "<script>alert('Password Not Correct!'); window.location.href='".BSURL."app/add-user.php'</script>";
		}
		break;
		case "edituser":

		$id = $_GET['id'];
		$fullname = $_POST['fullname'];
		$mobileno = $_POST['mobileno'];
		$usemail = $_POST['usemail'];
		
		$country = $_POST['country'];
		$company = $_POST['company'];
		$comlogo = $_FILES["comlogo"]["name"];


		if($comlogo != "")
		{
			$target_dir = "../uploads/";
			$target_file = $target_dir . basename($_FILES["comlogo"]["name"]);
			move_uploaded_file($_FILES["comlogo"]["tmp_name"], $target_file);

			if($password != "")
			{
				$table = "dis_operator";
				$data = array(
					'dis_comid' => $comid,
					'dis_name' => $fullname,
					'dis_mobile' => $mobileno,
					'dis_email' => $usemail,
					'dis_country' => $country,
					'dis_role' => 'User',
					'dis_company' => $company,
					'dis_logo' => $comlogo,
					'dis_createdby' => $canid,
					'dis_delete' => '1',
					'dis_status' => '1'
				);
			}
			else
			{
				$table = "dis_operator";
				$data = array(
					'dis_comid' => $comid,
					'dis_name' => $fullname,
					'dis_mobile' => $mobileno,
					'dis_email' => $usemail,
					'dis_country' => $country,
					'dis_role' => 'User',
					'dis_company' => $company,
					'dis_createdby' => $canid,
					'dis_delete' => '1',
					'dis_status' => '1'
				);
			}
		}
		else
		{
			if($password != "")
			{
				$table = "dis_operator";
				$data = array(
					'dis_comid' => $comid,
					'dis_name' => $fullname,
					'dis_mobile' => $mobileno,
					'dis_email' => $usemail,
					'dis_password' => $password,
					'dis_country' => $country,
					'dis_role' => 'User',
					'dis_company' => $company,
					'dis_createdby' => $canid,
					'dis_delete' => '1',
					'dis_status' => '1'
				);
			}
			else
			{
				$table = "dis_operator";
				$data = array(
					'dis_comid' => $comid,
					'dis_name' => $fullname,
					'dis_mobile' => $mobileno,
					'dis_email' => $usemail,
					'dis_country' => $country,
					'dis_role' => 'User',
					'dis_company' => $company,
					'dis_createdby' => $canid,
					'dis_delete' => '1',
					'dis_status' => '1'
				);
			}
		}
        

		
		$cond = array(
			'dis_id' => $id
		);
		$obj->updateData($table,$data,$cond);

		header('Location:'.BSURL.'app/add-user.php');

		
		break;
		case "deluser":

		$p = $_GET['p'];
		$id = $_GET['id'];

		$table = "dis_operator";
		$data = array(
			'dis_status' => '0'
		);
		$cond = array(
			'dis_id' => $id,
		);

		$obj->updateData($table,$data,$cond);

		header('Location:'.BSURL.'app/'.$p.'.php');
		break;
		case "company":
		$p = $_GET['p'];
		$active = $_POST['active'];
		$catename = $_POST['comname'];
		$table = "dis_master";

		$cond = array(
			'dis_name' => $catename,
			'dis_category' => 'company',
			'dis_parent' => $catefor,
			'dis_status' => '1'
		);
		$checkpost = $obj->getOnedata($table,$cond);
		if($checkpost != "")
		{
			header('Location:'.BSURL.'app/company-master.php?i=duplicate');
		}
		else
		{
			if($active != "")
			{
				
				$data = array(
					'dis_name' => $catename,
					'dis_category' => 'company',
					'dis_parent' => $catefor,
					'dis_status' => '1'
				);
			}
			else
			{
				
				$data = array(
					'dis_name' => $catename,
					'dis_category' => 'company',
					'dis_parent' => $catefor,
					'dis_status' => '0'
				);
			}

			$obj->insertData($table,$data);
			header('Location:'.BSURL.'app/company-master.php');
		}
		break;
		case "editcompany":
		$p = $_GET['p'];
		$id = $_GET['id'];
		$active = $_POST['active'];
		$catename = $_POST['comname'];
		$table = "dis_master";

		$cond = array(
			'dis_name' => $catename,
			'dis_category' => 'company',
			'dis_status' => '1'
		);
		$checkpost = $obj->getOnedata($table,$cond);
		if($checkpost != "")
		{
			header('Location:'.BSURL.'app/company-master.php?i=duplicate');
		}
		else
		{
			if($active != "")
			{
				
				$data = array(
					'dis_name' => $catename,
					'dis_category' => 'company',
					'dis_status' => '1'
				);
				
			}
			else
			{
				
				$data = array(
					'dis_name' => $catename,
					'dis_category' => 'company',
					'dis_status' => '0'
				);
				
			}
			$cond = array(
					'dis_id' => $id
				);

			$obj->updateData($table,$data,$cond);
			header('Location:'.BSURL.'app/company-master.php');
		}
		break;
	}
}