
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
				<form class="form-inline float-left" method="GET">
					<div class="input-group">
						<select class="form-control" name="s">
							<option value="">--Select--</option>
							<option value="Business">Business</option>
							<option value="Functional">Functional</option>
						</select>
						<div class="input-group-append">
					      <input type="submit" class="input-group-text btn-sm" value="GO">
					    </div>
					    
					</div>
				</form>
				<div class="float-right">
					<?php
					if(isset($_GET['s']))
					{
						$s = $_GET['s'];
						?>
						<a href="<?php echo APP?>create-question.php?s=<?php echo $s;?>" class="btn btn-outline-info">Create <?php echo $s;?> Questions</a>
						<?php
					}
					?>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="bg-gray">
							<th>No</th>
							<th>Category</th>
							<th>Question</th>
							<th>Question Details</th>
							<th>Nature</th>
							<th>Type</th>
							<th>Status</th>

							<th colspan="2" class="text-center">Action</th>
						</thead>
						<tbody>
							<?php
							if(isset($_GET['s']))
							{
								$s = $_GET['s'];
								$table = "dis_questionset";
								$cond = array(
									'dis_master' => $s
								);
								$alldata = $obj->getAlldata($table,$cond);
								if(!empty($alldata))
								{
									$xl =1;
									foreach($alldata as $all)
									{
										?>
										<tr>
											<td><?php echo $xl;?></td>
											<td><?php $cate = $all['dis_category']; echo $obj->getCategory($cate);?></td>
											<td><?php echo $all['dis_question'];?></td>
											<td><?php echo $all['dis_quesdetails'];?></td>
											<td><?php echo $all['dis_nature'];?></td>
											<td><?php echo $all['dis_type'];?></td>
											<td><?php $status = $all['dis_status']; echo $status == "1"? "Active":"Inactive";?></td>
											<td><a href="<?php echo APP?>edit-question.php?case=<?php echo $s;?>&e=<?php echo $all['dis_id'];?>" class="text-success"><i class="fa fa-edit"></i></a></td>
											<td><a href="<?php echo BSURL?>functions/setting.php?case=delques&id=<?php echo $all['dis_id'];?>" class="text-danger"><i class="fa fa-trash"></i></a></td>



										</tr>
										<?php
										$xl++;
									}
								}
								else
								{
									?>
								<tr>
									<td colspan="8" class="text-center">No Data</td>
								</tr>
								<?php
								}
							}
							else
							{
								?>
								<tr>
									<td colspan="8" class="text-center">No Data</td>
								</tr>
								<?php
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