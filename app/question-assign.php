
<?php
$bsurl = dirname(__DIR__);
include $bsurl.'/inc/header.php';
$siteaim = basename($_SERVER['SCRIPT_FILENAME'],'.php');
$sitename = str_replace('-', ' ', $siteaim);
$pagename = ucwords($sitename);
?>
<div class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6 col-lg-6 col-md-6">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo BSURL;?>app/dashboard.php"><i class="fa fa-home"></i> Home</a></li>
					<li class="breadcrumb-item"><a href="<?php echo BSURL;?>app/setting.php"> Setting</a></li>
              		<li class="breadcrumb-item active"><?php echo $pagename;?></li>
				</ul>
			</div>
			<div class="col-sm-6 col-lg-6 col-md-6">
				<div class="clearfix">
					<div class="float-right breadcrumb text-light rightbreak">
						<span class="mr-2"><i class="fa fa-industry"></i> </span> <?php $obj = new Dbconnect(); echo $obj->getCompany($comid); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="main-content">
	<div class="container-fluid">
		
		<div class="card mt-4">
			<div class="card-header p-1">
				<form class="form-inline" method="GET"><div class="input-group"><input type="text" name="s" class="form-control" placeholder="Fine Name"><div class="input-group-append"><button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button></div></div></form>
			</div>
			<div class="card-body">
				<div class="table-responsive emptable">
					<table class="table table-bordered">
						<thead>
							<th>No</th>
							<th>Client Name</th>
							<th>Company Name</th>
							<th>Mobile No</th>
							<th>Email Address</th>
							<th>Country</th>
							<th>Business</th>
							<th>Functional</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php
							if(isset($_GET['s']))
							{
								$s = $_GET['s'];
								$table = "dis_operator";
								$cond = " (dis_name LIKE '%$s%') AND dis_role = 'User' AND dis_createdby = '$canid' AND dis_delete = '1' AND dis_status = '1'";
								
								$obj = new Dbconnect();
								$data = $obj->findAll($table,$cond);
							}
							else
							{
								$table = "dis_operator";
								$cond = array(
									'dis_role' => 'User',
									'dis_createdby' => $canid,
									'dis_delete' => '1',
									'dis_status' => '1'
								);
								$obj = new Dbconnect();
								$data = $obj->getAlldata($table,$cond);
							}
							
							
							if(!empty($data))
							{
								$xl =1;
								foreach($data as $dd)
								{
									$obj = new Dbconnect();
									?>
									<tr>
										<td><?php echo $xl;?></td>
										<td><?php echo $dd['dis_name'];?></td>
										<td><?php echo $dd['dis_company'];?></td>
										<td><?php echo $dd['dis_mobile'];?></td>
										<td><?php echo $dd['dis_email'];?></td>
										<td><?php $counid = $dd['dis_country']; echo $obj->getCountry($counid);?></td>
										<td><?php $emi = $dd['dis_id']; echo $obj->businessCount($emi);?></td>
										<td><?php $emi = $dd['dis_id']; echo $obj->functionalCount($emi);?></td>
										<td><?php $emi = $dd['dis_id']; echo $obj->businessCount($emi) != "0" ? "Assigned":"Not Assigned";?></td>
										<td><a href="assign-question.php?id=<?php echo $dd['dis_id']?>" class="badge badge-pill badge-primary"> Assign Questions <i class="fa fa-angle-double-right"></i></a></td>
										

									</tr>
									<?php
									$xl++;
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
$bsurl = dirname(__DIR__);
include $bsurl.'/inc/footer.php';
?>