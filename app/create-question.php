
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
<div class="main-content mt-3">
	<div class="container-fluid">
		<div class="card">
			<div class="card-header p-1">
				<form class="form-inline" method="GET">
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
			</div>
			<div class="card-body">
				<?php
				if(isset($_GET['s']))
				{
					$s = $_GET['s'];
					switch($s)
					{
						case "Business":
						?>
						<form class="" method="POST" action="<?php echo BSURL?>functions/setting.php?case=addbusiness&p=<?php echo $siteaim;?>">
						<div class="form-group row">
						<div class="col-lg-12 col-md-12">
						<label>Enter Question</label>
						<input type="text" name="question" class="form-control mb-3" required>
						<input type="hidden" name="master" value="<?php echo $s;?>">
					</div>
					<div class="col-lg-12 col-md-12">
						<label>Question Details</label>
						<textarea name="quesdetails" class="form-control mb-3"></textarea>
						
					</div>
					<div class="col-lg-4 col-md-4">
						<label>Question Nature</label>
						<select class="form-control mb-3" name="nature" required>
							<option value="">--Select--</option>
							<option value="Mandatory">Mandatory</option>
							<option value="Optional">Optional</option>
						</select>
					</div>
					<div class="col-lg-4 col-md-4">
						<label>Sub Category</label>
						<select class="form-control" name="subcateory" required>
							<?php
							$table = "dis_master";
							$cond = array(
								'dis_category' => 'master',
								'dis_parent' => $s
							);
							$alldata = $obj->getAlldata($table,$cond);
							if(!empty($alldata))
							{
								foreach($alldata as $all)
								{
									?>
									<option value="<?php echo $all['dis_id'];?>"><?php echo $all['dis_name'];?></option>
									<?php
								}
							}
							?>
						</select>

					</div>
					<div class="col-lg-4 col-md-4">
						<label>Question Type</label>
						<select class="form-control" name="questyp" required id="questyp">
							<option value="">--Select--</option>
							<option value="Text">Text Box</option>
							<option value="Bulean">Yes/No</option>
							<option value="Options">Option Type</option>
						</select>
					</div>

				</div>
				
				<div class="form-group row">
					<div class="col-lg-12 col-md-12">
						<div id="optionalval"></div>
					</div>
				</div>
				<div class="clearfix">
					<input type="submit" value="Submit" class="btn btn-primary float-right">
					
				</div>
			</form>
						<?php
						break;
						case "Functional":
						?>
						<form class="" method="POST" action="<?php echo BSURL?>functions/setting.php?case=addfunctional&p=<?php echo $siteaim;?>">
							<div class="form-group">
						
								<label>Enter Question</label>
								<input type="text" name="question" class="form-control mb-3" required>
								<input type="hidden" name="master" value="<?php echo $s;?>">
							</div>
							<div class="form-group">
						
								<label>Question Details</label>
								<textarea name="quesdetails" class="form-control mb-3"></textarea>
								
							</div>
							<div class="form-group row">
								<div class="col-lg-4 col-md-4">
									<label>Question Nature</label>
									<select class="form-control mb-3" name="nature" required>
										<option value="">--Select--</option>
										<option value="Mandatory">Mandatory</option>
										<option value="Optional">Optional</option>
									</select>
								</div>
								<div class="col-lg-4 col-md-4">
									<label>Sub Category</label>
									<select class="form-control" name="subcateory" required>
										<?php
										$table = "dis_master";
										$cond = array(
											'dis_category' => 'master',
											'dis_parent' => $s
										);
										$alldata = $obj->getAlldata($table,$cond);
										if(!empty($alldata))
										{
											foreach($alldata as $all)
											{
												?>
												<option value="<?php echo $all['dis_id'];?>"><?php echo $all['dis_name'];?></option>
												<?php
											}
										}
										?>
									</select>

								</div>
							</div>
							<div class="clearfix">
					<input type="submit" value="Submit" class="btn btn-primary float-right">
					
				</div>

						</form>
						<?php
						break;
					}
				}
				?>
			</div>
		</div>
		
		
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#questyp").on('change', function(){
			var questyp = $("#questyp").val();
				// alert(questyp);
			if(questyp == "Options")
			{
				$.ajax({
					url: 'ajax-data.php?case=optional',
					type: 'get',
					success: function (data) {
						$("#optionalval").html(data);
						// console.log(data);
					}
				});
			}
			
		});
	});
</script>
<?php
$bsurl = dirname(__DIR__);
include $bsurl.'/inc/footer.php';
?>