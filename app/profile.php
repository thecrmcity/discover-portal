
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
		
		<div class="row mt-4">
			<div class="col-lg-4 col-md-4">
				<div class="card">
					<div class="card-header">
						<i class="fa fa-user"></i> Profile Card
					</div>
					<div class="card-body">
						<table style="width:100%">
							<?php
							$table = "dis_operator";
							$cond = array(
								'dis_id' => $canid,
							);
							$obj = new Dbconnect();
							$sab = $obj->getOnedata($table,$cond);
							if($sab != "")
							{
								$lodo = $sab['dis_logo'];;
								?>
								<tr>
									<?php
									if($lodo != "")
									{
										?>
										<td colspan="2"><img src="<?php echo BSURL?>uploads/<?php echo $sab['dis_logo'];?>"></td>
										<?php
									}
									?>
								
								</tr>
								<tr>
									<td>Full Name</td>
									<td><?php echo $sab['dis_name'];?></td>
								</tr>
								<tr>
									<td>Email Address</td>
									<td><?php echo $sab['dis_email'];?></td>
								</tr>
								<tr>
									<td>Mobile NO</td>
									<td><?php echo $sab['dis_mobile'];?></td>
								</tr>
								
								<?php
							}

							?>
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
$bsurl = dirname(__DIR__);
include $bsurl.'/inc/footer.php';
?>