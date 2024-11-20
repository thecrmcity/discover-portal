
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
<?php
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$table = "dis_master";
	$cond = array(
		'dis_id' => $id,
	);
	$val = $obj->getOnedata($table,$cond);
	$case = "editcompany&id=$id";
	$name = $val['dis_name'];
	$parent = $val['dis_parent'];
	$act = $val['dis_status'];

}
else
{
	$case = "company";
	$name = "";
	$parent = "";
	$act = "0";
}
?>
<div class="main-content mt-3">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 col-md-4">
				<div class="infotrack">
					<form class="" method="POST" action="<?php echo BSURL?>functions/setting.php?case=<?php echo $case;?>&p=<?php echo $siteaim;?>">
						<label>Company Name</label>
						<div class="input-group mb-3">
							
							<div class="input-group-prepend">
						      <span class="input-group-text"><input type="radio" name="active" value="1" <?php echo $act == "1"? "checked":"";?>></span>
						    </div>
							<input type="text" name="comname" class="form-control" required value="<?php echo $name; ?>">
						</div>
						
						<div class="clearfix">
							<input type="submit" value="Submit" class="btn btn-primary float-right">
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-8 col-md-8">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="bg-gray">
							<th>No</th>
							<th>Company Name</th>
							<th>Status</th>
							<th colspan="2" class="text-center">Action</th>
						</thead>
						<tbody>
							<?php
							$xl =1;
							$table = "dis_master";
							$cond = array(
								'dis_category' => 'company'
							);
							$alldata = $obj->getAlldata($table,$cond);
							if(!empty($alldata))
							{
								foreach($alldata as $all)
								{
									?>
									<tr>
										<td><?php echo $xl;?></td>
										<td><?php echo $all['dis_name'];?></td>
										<td><?php $status = $all['dis_status']; echo $status == "1" ? "Active":"Inactive";?></td>
										<td><a href="<?php echo BSURL?>app/company-master.php?id=<?php echo $all['dis_id'];?>" class="text-success"><i class="fa fa-edit"></i></a></td>
										<td><a href="<?php echo BSURL?>functions/setting.php?case=delmaster&id=<?php echo $all['dis_id'];?>" class="text-danger"><i class="fa fa-trash"></i></a></td>

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