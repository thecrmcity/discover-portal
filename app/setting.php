
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
	<div class="top-cards">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3 col-md-3 mt-4">
					<a href="<?php echo APP;?>company-master.php" class="inner-card">
						<div class="inner-icon text-primary"><i class="fa fa-industry"></i></div>
						<div class="inner-text text-right">Company <br><b style="border-bottom: 1px solid #767575;padding-bottom: 5px;"> Master</b></div>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 mt-4">
					<a href="<?php echo APP;?>master-category.php" class="inner-card">
						<div class="inner-icon text-danger"><i class="fa fa-cogs"></i></div>
						<div class="inner-text text-right">Master <br><b style="border-bottom: 1px solid #767575;padding-bottom: 5px;"> Category</b></div>
					</a>
				</div>
				<div class="col-lg-3 col-md-3 mt-4">
					<a href="<?php echo APP;?>create-question.php" class="inner-card">
						<div class="inner-icon text-success"><i class="fa fa-question-circle"></i></div>
						<div class="inner-text text-right">Create <br><b style="border-bottom: 1px solid #767575;padding-bottom: 5px;"> Questions</b></div>
					</a>
				</div>

				<div class="col-lg-3 col-md-3 mt-4">
					<a href="<?php echo APP;?>view-questions.php" class="inner-card">
						<div class="inner-icon text-info"><i class="	fa fa-quote-left"></i></div>
						<div class="inner-text text-right">Change & Modify<br><b style="border-bottom: 1px solid #767575;padding-bottom: 5px;"> Questions</b></div>
					</a>
				</div>

				<div class="col-lg-3 col-md-3 mt-4">
					<a href="<?php echo APP;?>question-assign.php" class="inner-card">
						<div class="inner-icon text-danger"><i class="fa fa-recycle"></i></div>
						<div class="inner-text text-right">Questions<br><b style="border-bottom: 1px solid #767575;padding-bottom: 5px;"> Assign to Users</b></div>
					</a>
				</div>

				<div class="col-lg-3 col-md-3 mt-4">
					<a href="<?php echo APP;?>create-admin.php" class="inner-card">
						<div class="inner-icon "  style="color: #c510be;"><i class="fa fa-user-plus"></i></div>
						<div class="inner-text text-right">Admin <br><b>Creation</b></div>
					</a>
				</div>

				<div class="col-lg-3 col-md-3 mt-4">
					<a href="<?php echo APP;?>create-child.php" class="inner-card">
						<div class="inner-icon text-gray-dark"><i class="fa fa-user-plus"></i></div>
						<div class="inner-text text-right">Admin Child <br><b>Creation</b></div>
					</a>
				</div>

				<div class="col-lg-3 col-md-3 mt-4">
					<a href="<?php echo APP;?>add-user.php" class="inner-card">
						<div class="inner-icon text-gray-dark"><i class="fa fa-user-plus"></i></div>
						<div class="inner-text text-right">User / Client<br><b>Creation</b></div>
					</a>
				</div>


				
			</div>
		</div>
</div>


<?php
$bsurl = dirname(__DIR__);
include $bsurl.'/inc/footer.php';
?>