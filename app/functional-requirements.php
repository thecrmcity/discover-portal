
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
		
		<div class="card">
			<div class="card-header"></div>
			<div class="card-body">
				<div class="table-responsive emptable">
					<table class="table table-bordered">
						<thead class="bg-gray">
							<th>No</th>
							<th>Client Name</th>
							<th>Client Company</th>
							<th>Main Set</th>
							<th>Category</th>
							<th>Assigned</th>
							<th>Answered</th>
							<th>Unanswered</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php
							$table = "dis_operator";
							$cond = array(
								'dis_comid' => $comid,
								'dis_createdby' => $canid,
								'dis_delete' => '1',
								'dis_status' => '1',

							);
							
							$obj = new Dbconnect();
							$alldata = $obj->getAlldata($table,$cond);
							if(!empty($alldata))
							{
								$xl=1;
								foreach($alldata as $all)
								{
									$emi = $all['dis_id'];
									$table = "dis_assigned";
									$cond = array(
										'dis_mainid' => 'Functional',
										'dis_comid' => $comid,
										'dis_canid' => $emi,
										'dis_createdby' => $canid
									);
									
									$obj = new Dbconnect();
									$eta = $obj->getOnedata($table,$cond);
									
									if($eta != "")
									{
										$mainid = $eta['dis_mainid'];
										$cateid = $eta['dis_cateid'];
										
									$obj = new Dbconnect();
									?>
									<tr>
										<td><?php echo $xl;?></td>
										<td><?php echo $all['dis_name'];?></td>
										<td><?php echo $all['dis_company'];?></td>
										<td><?php echo $eta['dis_mainid'];?></td>
										<td><?php echo $obj->getCategory($cateid);?></td>
										<td><?php echo $obj->assignedQues($emi,'Functional');?></td>
										<td><?php echo $obj->answeredQues($emi,'Functional');?></td>
										<td><?php echo $obj->assignedQues($emi,'Functional')-$obj->answeredQues($emi,'Functional');?></td>
										<td><a href="function-result.php?s=<?php echo $eta['dis_mainid'];?>&id=<?php echo $emi;?>" class="badge badge-pill badge-primary">View <i class="fa fa-angle-double-right"></i></a></td>
										
									</tr>
									<?php
									$xl++;
									}
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