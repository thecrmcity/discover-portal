
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
<div class="top-cards">
	<div class="container-fluid">
		<div class="row">
			<?php
			if($role == "User")
			{
				?>
				<div class="col-lg-3">
					<a href="<?php echo APP;?>user-business.php?s=Business" class="inner-card">
						<div class="inner-icon text-warning"><i class="fa fa-behance"></i></div>
						<div class="inner-text text-right">Business & Project <br><b>Overview</b></div>
					</a>
				</div>
				<div class="col-lg-3">
					<a href="<?php echo APP;?>user-functional.php?s=Functional" class="inner-card">
						<div class="inner-icon text-primary"><i class="fa fa-google-wallet"></i></div>
						<div class="inner-text text-right">Functional <br><b> Requirements</b></div>
					</a>
				</div>


				
				<?php
			}
			else
			{
				?>
				<div class="col-lg-3">
					<a href="<?php echo APP;?>business-overview.php" class="inner-card">
						<div class="inner-icon text-warning"><i class="fa fa-behance"></i></div>
						<div class="inner-text text-right">Business & Project <br><b>Overview</b></div>
					</a>
				</div>
				<div class="col-lg-3">
					<a href="<?php echo APP;?>functional-requirements.php" class="inner-card">
						<div class="inner-icon text-primary"><i class="fa fa-google-wallet"></i></div>
						<div class="inner-text text-right">Functional <br><b> Requirements</b></div>
					</a>
				</div>
				<div class="col-lg-3">
					<a href="<?php echo APP;?>software-licence.php" class="inner-card">
						<div class="inner-icon text-info"><i class="fa fa-rocket"></i></div>
						<div class="inner-text text-right">Software Licence <br><b>Requirements</b></div>
					</a>
				</div>
				<div class="col-lg-3">
					<a href="<?php echo APP;?>setting.php" class="inner-card">
						<div class="inner-icon text-danger"><i class="fa fa-cogs"></i></div>
						<div class="inner-text text-right">Featured Global <br><b>Setting</b></div>
					</a>
				</div>


				<?php
			}
			?>
			
			
		</div>
		<?php
		if($role == "User")
		{
			$id = $_SESSION['id'];
			$bsyassined = $obj->businessCount($id);
			$fsyassined = $obj->functionalCount($id);
		?>
		<div class="row mt-3">
			<div class="col-lg-4 col-md-4">
				<div class="card">
					<div class="card-header">Business & Project Overview</div>
					<div class="card-body">
						<div class="infocard">
							<ul>
								<li>Required questions</li>
								<li><?php echo $bsyassined;?>/36</li>
							</ul>
							<div class="progress">
							    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width:100%"></div>
							</div>
							<ul style="margin-top: 30px;">
								<li>Functional Questions</li>
								<li><?php echo $fsyassined;?>/4</li>
							</ul>
							<div class="progress">
							    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width:100%"></div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-outline-info float-right">Update</button>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-4">
				<div class="card">
					<div class="card-header">Functional Requirements</div>
					<div class="card-body">
						<div class="table-responsive">
							<table style="width: 100%;">
								<tr>
									<td>Must</td>
									<td>84</td>
								</tr>
								<tr>
									<td>Should</td>
									<td>131</td>
								</tr>
								<tr>
									<td>Could</td>
									<td>97</td>
								</tr>
								<tr>
									<td>Not</td>
									<td>158</td>
								</tr>
								<tr>
									<td>Unsure</td>
									<td>0</td>
								</tr>
								<tr>
									<td>Unanswered</td>
									<td>0</td>
								</tr>
								<tr>
									<th>TOTAL</th>
									<th>470</th>
								</tr>

							</table>
						</div>
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-outline-info float-right">Update</button>
					</div>
				</div>
			</div>

			<?php
			if($role != "User")
			{
				?>
				<div class="col-lg-4 col-md-4">
				<div class="card">
					<div class="card-header">Software licence requirements (BC)</div>
					<div class="card-body">
						
					</div>
					<div class="card-footer">
						<button type="button" class="btn btn-outline-info float-right">Update</button>
					</div>
					
				</div>
			</div>
				<?php
			}
			else
			{
				?>
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
										<td colspan="2"><img src="<?php echo BSURL?>uploads/<?php echo $sab['dis_logo'];?>" width="150px"></td>
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
									<td>Mobile No</td>
									<td><?php echo $sab['dis_mobile'];?></td>
								</tr>

								<tr>
									<td>Company Name</td>
									<td><?php echo $sab['dis_company'];?></td>
								</tr>
								<tr>
									<td>Country</td>
									<td><?php $conti = $sab['dis_country']; echo $obj->getCountry($conti);?></td>
								</tr>
								
								<?php
							}

							?>
							
						</table>
					</div>
				</div>
			</div>
				<?php
			}

			?>

		</div>
		<?php
		}
		?>
	</div>
</div>


<?php
$bsurl = dirname(__DIR__);
include $bsurl.'/inc/footer.php';
?>