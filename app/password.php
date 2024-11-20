
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
						<i class="fa fa-key"></i> Change Password
					</div>
					<div class="card-body">
						<form class="" method="POST" action="<?php echo BSURL?>functions/password.php">
							<div class="form-group">
								<label>New Password</label>
								<input type="password" name="newpass" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password" name="confimpass" class="form-control" required>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-info px-3 float-right" value="Change Password" name="change">
							</div>
						</form>
					</div>
					<div class="card-footer">
						<?php
						if(isset($_GET['msg']))
						{
							$msg = $_GET['msg'];
							switch($msg)
							{
								case "save":
								?>
								<span class="alert alert-success p-1">Password Change Successfully!</span>
								<?php
								break;
								case "error":
								?>
								<span class="alert alert-danger p-1">Password Not Match!</span>
								<?php
								break;
							}
						}
						?>
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