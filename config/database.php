<?php

class Dbconnect
{
	protected $host = "localhost";
	protected $user = "root";
	protected $pass = "";
	protected $dbname = "discover";

	public $keycol = "";
	public $valcol = "";
	public $keyinst = "";
	public $valinst = "";

	public $ukeycol = "";
	public $uvalcol = "";

	
	public $dvalcol = "";
	

	public $conn = "";

	public function __construct()
	{
		$this->init();
		$sql = mysqli_connect($this->host,$this->user,$this->pass,$this->dbname);
		return $this->conn = $sql;
		

	}
	public function init()
	{
		
		

		if (!defined('BSURL')) {
	        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	        //  $domain = $_SERVER['HTTP_HOST'].'/';
	        $domain = $_SERVER['HTTP_HOST'].'/discover/';
	        $baseurl = $protocol.$domain;

	        define('BSURL', $baseurl);
	    }

		if (!defined('US')) {
	        define('US', '/');
	    }

	    if (!defined('APP')) {
	        define('APP', BSURL.'app'.US);
	    }

	    if (session_status() == PHP_SESSION_NONE) {
	        session_start();

	       
	    }

	}

	public function getOnedata($table,$cond)
	{
		foreach($cond as $key => $val)
		{
			$this->keycol .="$key='$val' AND "; 
		}
		$keydata = rtrim($this->keycol,' AND ');
		
		$sql = "SELECT * FROM $table WHERE $keydata";
		
		$res = mysqli_query($this->conn,$sql);
		if(mysqli_num_rows($res) > 0)
		{
			$row = mysqli_fetch_assoc($res);
			return $row;
		}
		
	}
	
	
	public function getAlldata($table,$cond)
	{
		foreach($cond as $key => $val)
		{
			$this->keycol .="$key='$val' AND "; 
		}
		$keydata = rtrim($this->keycol,' AND ');
		
		$sql = "SELECT * FROM $table WHERE $keydata";

		$res = mysqli_query($this->conn,$sql);
		if(mysqli_num_rows($res) > 0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$rowlist[] = $row;
			}
			return $rowlist;
			exit();
		}
		
	}
	public function getWithoutcond($table)
	{
		$sql = "SELECT * FROM $table";
		$res = mysqli_query($this->conn,$sql);
		if(mysqli_num_rows($res) > 0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$rowlist[] = $row;
			}
			return $rowlist;
		}

	}
	public function insertData($table,$data)
	{

		foreach($data as $key => $val)
		{
			$this->keyinst .="`$key`, ";
			$this->valinst .="'$val', ";
		}
		$keydata = rtrim($this->keyinst,', ');
		$valdata = rtrim($this->valinst,', ');

		$sql = "INSERT INTO $table ($keydata) VALUES($valdata)";
		$res = mysqli_query($this->conn,$sql);
		return $res;
	}
	public function insertValue($table,$value,$data)
	{
		$sql = "INSERT INTO $table($value) VALUES($data)";
		$res = mysqli_query($this->conn,$sql);
		return $res;
	}
	public function updateValue($table,$data,$cond)
	{
		$sql = "UPDATE $table SET $data WHERE $cond";
		
		$res = mysqli_query($this->conn,$sql);
		return $res;
	}
	public function updateData($table,$data,$cond)
	{
		foreach($data as $key => $val)
		{
			$this->ukeycol .= "`$key`='$val', ";
		}
		foreach($cond as $ckey => $cval)
		{
			$this->uvalcol .= "`$ckey`='$cval' AND ";
		}
		$ukeydata = rtrim($this->ukeycol,', ');
		$uvaldata = rtrim($this->uvalcol,'AND ');

		$sql = "UPDATE $table SET $ukeydata WHERE $uvaldata";
		
				
		$res = mysqli_query($this->conn,$sql);
		return $res;
	}
	public function deleteData($table,$cond)
	{
		
		foreach($cond as $ckey => $cval)
		{
			$this->dvalcol .= "`$ckey`='$cval' AND ";
		}
		
		$dvaldata = rtrim($this->dvalcol,'AND ');

		$sql = "DELETE FROM $table WHERE $dvaldata";
		$res = mysqli_query($this->conn,$sql);
		return $res;
	}
	public function getCountry($id)
	{
		$sql = "SELECT * FROM dis_country WHERE id='$id'";
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['country'];
		}
	}
	public function getCategory($id)
	{
		$sql = "SELECT * FROM dis_master WHERE dis_id='$id'";
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['dis_name'];
		}
		
	}
	public function getCompany($id)
	{
		$sql = "SELECT * FROM dis_master WHERE dis_id='$id'";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['dis_name'];
		}
		
	}
	public function getModule($id)
	{
		$sql = "SELECT * FROM dis_questionset WHERE dis_master='$id' AND dis_status='1' GROUP BY dis_category";
		
		$res = mysqli_query($this->conn,$sql);
		
		if(mysqli_num_rows($res) > 0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$catid = $row['dis_category'];

				$rowlist[] = $this->cateroyName($catid).";".$catid;

			}
			return $rowlist;
		}
	}
	public function cateroyName($id)
	{
		$sql = "SELECT * FROM dis_master WHERE dis_id='$id'";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['dis_name'];
		}
	}
	public function quesCount($id)
	{
		$sql = "SELECT COUNT(dis_question) AS quescont FROM dis_questionset WHERE dis_category='$id'";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['quescont'];
		}
	}
	public function quesetCount($id,$val,$can)
	{
		$sql = "SELECT COUNT(dis_quesid) AS quescont FROM dis_assigned WHERE dis_canid='$id' AND dis_mainid='$val' AND dis_cateid='$can' AND  dis_active='1' ";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['quescont'];
		}
	}
	public function assignedQues($id,$val)
	{
		$sql = "SELECT COUNT(dis_quesid) AS quescont FROM dis_assigned WHERE dis_canid='$id' AND dis_mainid='$val' AND  dis_active='1' ";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['quescont'];
		}
	}
	public function anweredCount($id,$val,$can)
	{
		$sql = "SELECT COUNT(dis_quesid) AS quescont FROM dis_answered WHERE dis_canid='$id' AND dis_mainid='$val' AND dis_cateid='$can' AND (dis_answer !='' OR dis_optional !='' )";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['quescont'];
		}
		else
		{
			return "0";
		}
	}
	public function answeredQues($id,$val)
	{
		$sql = "SELECT COUNT(dis_quesid) AS quescont FROM dis_answered WHERE dis_canid='$id' AND dis_mainid='$val' AND (dis_answer !='' OR dis_optional !='' )";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['quescont'];
		}
		else
		{
			return "0";
		}
	}
	public function findAll($table,$cond)
	{
		$sql = "SELECT * FROM $table WHERE $cond ";
		
		$res = mysqli_query($this->conn,$sql);
		if(mysqli_num_rows($res) > 0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$rowlist[] = $row;
			}
			return $rowlist;
			exit();
		}
	}
	public function businessCount($id)
	{
		$sql = "SELECT COUNT(dis_quesid) AS quescont FROM dis_assigned WHERE dis_canid='$id' AND dis_mainid='Business' AND dis_active='1' ";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['quescont'];
		}
	}
	public function functionalCount($id)
	{
		$sql = "SELECT COUNT(dis_quesid) AS quescont FROM dis_assigned WHERE dis_canid='$id' AND dis_mainid='Functional' AND dis_active='1' ";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['quescont'];
		}
	}
	public function getSetQuestions($id,$s)
	{
		$sql = "SELECT * FROM dis_assigned WHERE dis_canid='$id' AND dis_mainid='$s' AND dis_status='1' ";
		
		$res = mysqli_query($this->conn,$sql);
		if(mysqli_num_rows($res) > 0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$rowlist[] = $row;
			}
			return $rowlist;
			exit();
		}
	}

	public function getSetModel($id,$s)
	{
		$sql = "SELECT * FROM dis_assigned WHERE dis_canid='$id' AND dis_mainid='$s' AND dis_status='1' GROUP BY dis_cateid ";
		
		$res = mysqli_query($this->conn,$sql);
		if(mysqli_num_rows($res) > 0)
		{
			while($row = mysqli_fetch_assoc($res))
			{
				$catid = $row['dis_cateid'];
				$rowlist[] = $this->cateroyName($catid).";".$catid;

			}
			return $rowlist;
		}
	}

	public function quesetMapped($mdno,$id)
	{
		$sql = "SELECT COUNT(dis_quesid) AS quescont FROM dis_answered WHERE dis_canid='$id' AND dis_cateid='$mdno' ";
		
		$res = mysqli_query($this->conn,$sql);
		$row = mysqli_fetch_assoc($res);
		if($row != "")
		{
			return $row['quescont'];
		}
	}

	
}

$obj = new Dbconnect();

$comid = $_SESSION['comid'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];
$canid = $_SESSION['id'];

?>