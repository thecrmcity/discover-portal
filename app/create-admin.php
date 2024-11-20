
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
	 	
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<?php
				if(isset($_GET['case']))
				{
					$case = $_GET['case'];
					switch($case)
					{
						case "edit":
						$id = $_GET['id'];
						$table = "dis_operator";
						$cond = array(
							'dis_id' => $id
						);
						$obj = new Dbconnect();
						$one = $obj->getOnedata($table,$cond);
						if($one != "")
						{
							$case = "editadmin&id=$id";
							$name = $one['dis_name'];
							$mobile = $one['dis_mobile'];
							$email = $one['dis_email'];
							$country = $one['dis_country'];
							$company = $one['dis_comid'];


						}
						?>
						<form class="infotrack mt-4" method="POST" action="<?php echo BSURL?>functions/setting.php?case=<?php echo $case;?>">
					<h5 class="text-center border-bottom pb-2" style="color: #597b81;font-family: arial;">Admin Creation</h5>
					<div class="form-group">
						
							<label>Name</label>
							<input type="text" name="fullname" class="form-control" required value="<?php echo $name;?>">
						</div><div class="form-group">
						
							<label>Mobile No</label>
							<input type="tel" name="mobileno" minlength="10" maxlength="15" class="form-control" required value="<?php echo $mobile;?>">
						</div><div class="form-group">
							<label>Email Address</label>
							<input type="email" name="usemail" class="form-control" required autocomplete="off" value="<?php echo $email;?>">
						</div>
						

						<div class="form-group">
						
							<label>Country</label>
							<select class="form-control" name="country">
								<option value="">--Select--</option>
								<?php
									$table = "dis_country";
									$obj = new Dbconnect();
									$alldata = $obj->getWithoutcond($table);
									if(!empty($alldata))
									{
										foreach($alldata as $all)
										{
											?>
											<option value="<?php echo $all['id'];?>" <?php echo $country == $all['id'] ? "selected":"";?>><?php echo $all['country'];?></option>
											<?php
										}
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Select Company</label>
							<select class="form-control" name="company">
								<option value="">--Select--</option>
								<?php
								$table = "dis_master";
								$cond = array(
									'dis_category' => 'company'
								);
								$obj = new Dbconnect();
								$alldata = $obj->getAlldata($table,$cond);
								if(!empty($alldata))
								{
									foreach($alldata as $all)
									{
										?>
										<option value="<?php echo $all['dis_id'];?>" <?php echo $company == $all['dis_id'] ? "selected":"";?>><?php echo $all['dis_name'];?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" value="Save" class="btn btn-primary">
						</div>
					
						</form>
						<?php
						break;
						case "password":
						?>
						<form class="infotrack mt-4" method="POST" action="<?php echo BSURL?>functions/setting.php?case=adminpass&id=<?php echo $_GET['id']?>">
							<div class="form-group">
								<label>New Password</label>
								<input type="password" name="password" class="form-control" required autocomplete="off" >
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password" name="confirm" class="form-control" required autocomplete="off" >
							</div>
							<div class="form-group">
								<input type="submit" value="Change Password" class="btn btn-primary">
							</div>
						</form>
						<?php
						break;
						case "":
						break;
						
					}
				}
				else
				{
					?>
					<form class="infotrack mt-4" method="POST" action="<?php echo BSURL?>functions/setting.php?case=addadmin">
					<h5 class="text-center border-bottom pb-2" style="color: #597b81;font-family: arial;">Admin Creation</h5>
					<div class="form-group">
						
							<label>Name</label>
							<input type="text" name="fullname" class="form-control" required >
						</div><div class="form-group">
						
							<label>Mobile No</label>
							<input type="tel" name="mobileno" minlength="10" maxlength="15" class="form-control" required >
						</div><div class="form-group">
							<label>Email Address</label>
							<input type="email" name="usemail" class="form-control" required autocomplete="off" >
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required autocomplete="off" >
						</div>

						<div class="form-group">
						
							<label>Country</label>
							<select class="form-control" name="country" required>
								<option value="">--Select--</option>
								<?php
									$table = "dis_country";
									$obj = new Dbconnect();
									$alldata = $obj->getWithoutcond($table);
									if(!empty($alldata))
									{
										foreach($alldata as $all)
										{
											?>
											<option value="<?php echo $all['id'];?>" ><?php echo $all['country'];?></option>
											<?php
										}
									}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Select Company</label>
							<select class="form-control" name="company" required>
								<option value="">--Select--</option>
								<?php
								$table = "dis_master";
								$cond = array(
									'dis_category' => 'company'
								);
								$obj = new Dbconnect();
								$alldata = $obj->getAlldata($table,$cond);
								if(!empty($alldata))
								{
									foreach($alldata as $all)
									{
										?>
										<option value="<?php echo $all['dis_id'];?>" ><?php echo $all['dis_name'];?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" value="Save" class="btn btn-primary">
						</div>
					
						</form>
					<?php
				}
				?>
				
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="table-responsive mt-4">
					<table class="table table-bordered">
						<thead class="bg-gray">
							<th>No</th>
							<th>Full Name</th>
							<th>Mobile No</th>
							<th>Email Address</th>
							<th>Country</th>
							<th>Status</th>
							<th><i class="fa fa-lock"></i></th>
							<th colspan="2">Action</th>
						</thead>
						<tbody>
							<?php
							$table = "dis_operator";
							$cond = array(
								'dis_role' => 'Admin',
								'dis_delete' => '1',
							);
							$obj = new Dbconnect();
							$alldata = $obj->getAlldata($table,$cond);
							if(!empty($alldata))
							{
								$xl = 1;
								foreach($alldata as $all)
								{
									?>
									<tr>
										<td><?php echo $xl;?></td>
										<td><?php echo $all['dis_name'];?></td>
										<td><?php echo $all['dis_mobile'];?></td>
										<td><?php echo $all['dis_email'];?></td>
										<td><?php $country = $all['dis_country']; echo $obj->getCountry($country)?></td>
										<td><?php $status = $all['dis_status']; echo $status == "1" ? "Active":"Inactive"; ?></td>
										<td><a href="<?php echo APP?>create-admin.php?case=password&id=<?php echo $all['dis_id'];?>" class="text-success"><i class="fa fa-key"></i></a></td>
										<td><a href="<?php echo APP?>create-admin.php?case=edit&id=<?php echo $all['dis_id'];?>" class="text-success"><i class="fa fa-edit"></i></a></td>
										<td><a href="<?php echo BSURL?>functions/setting.php?case=deluser&id=<?php echo $all['dis_id'];?>&p=<?php echo $siteaim;?>" class="text-danger"><i class="fa fa-trash"></i></a></td>

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
include $bsurl.'/inc/alert.php';
include $bsurl.'/inc/footer.php';
?>