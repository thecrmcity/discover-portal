
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
		<?php

		if(isset($_GET['case']))
		{
			$e = $_GET['e'];
			$table = "dis_questionset";
			$cond = array(
				'dis_id' => $e
			);
			$obj = new Dbconnect();
			$one = $obj->getOnedata($table,$cond);
			$case = $_GET['case'];
			switch($case)
			{
				case "Functional":
				?>
				<form class="mt-4" method="POST" action="<?php echo BSURL?>functions/setting.php?case=editfunctionalques">
				<div class="form-group">
			
					<label>Enter Question</label>
					<input type="text" name="question" class="form-control mb-3" required value="<?php echo $one['dis_question'];?>">
					<input type="hidden" name="qusid" value="<?php echo $e;?>">
				</div>
				<div class="form-group">
			
					<label>Question Details</label>
					<textarea name="quesdetails" class="form-control mb-3"><?php echo $one['dis_quesdetails'];?></textarea>
					
				</div>
				<div class="form-group row">
					<div class="col-lg-4 col-md-4">
						<label>Question Nature</label>
						<select class="form-control mb-3" name="nature" required>
							<option value="">--Select--</option>
							<option value="Mandatory" <?php echo $one['dis_nature'] == "Mandatory" ? "selected":""?>>Mandatory</option>
							<option value="Optional" <?php echo $one['dis_nature'] == "Optional" ? "selected":""?> >Optional</option>
						</select>
					</div>
					<div class="col-lg-4 col-md-4">
						<label>Sub Category</label>
						<select class="form-control" name="subcateory" required>
							<?php
							$table = "dis_master";
							$cond = array(
								'dis_category' => 'master',
								'dis_parent' => 'Functional'
							);
							$obj = new Dbconnect();
							$alldata = $obj->getAlldata($table,$cond);
							if(!empty($alldata))
							{
								foreach($alldata as $all)
								{
									?>
		<option value="<?php echo $all['dis_id'];?>" <?php echo $all['dis_id'] == $one['dis_category'] ? "selected":"";?> ><?php echo $all['dis_name'];?></option>
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
				case "Business":
				?>
				<form class="mt-4" method="POST" action="<?php echo BSURL?>functions/setting.php?case=editbusinessques">
						<div class="form-group row">
						<div class="col-lg-12 col-md-12">
						<label>Enter Question</label>
						<input type="text" name="question" class="form-control mb-3" required value="<?php echo $one['dis_question'];?>">
						<input type="hidden" name="qusid" value="<?php echo $e;?>">
					</div>
					<div class="col-lg-12 col-md-12">
						<label>Question Details</label>
						<textarea name="quesdetails" class="form-control mb-3"><?php echo $one['dis_quesdetails'];?></textarea>
						
					</div>
					<div class="col-lg-4 col-md-4">
						<label>Question Nature</label>
						<select class="form-control mb-3" name="nature" required>
							<option value="">--Select--</option>
							<option value="Mandatory" <?php echo $one['dis_nature'] == "Mandatory" ? "selected":""?>>Mandatory</option>
							<option value="Optional" <?php echo $one['dis_nature'] == "Optional" ? "selected":""?>>Optional</option>
						</select>
					</div>
					<div class="col-lg-4 col-md-4">
						<label>Sub Category</label>
						<select class="form-control" name="subcateory" required>
							<?php
							$table = "dis_master";
							$cond = array(
								'dis_category' => 'master',
								'dis_parent' => 'Business'
							);
							$obj = new Dbconnect();
							$alldata = $obj->getAlldata($table,$cond);
							if(!empty($alldata))
							{
								foreach($alldata as $all)
								{
									?>
									<option value="<?php echo $all['dis_id'];?>" <?php echo $all['dis_id'] == $one['dis_category'] ? "selected":"";?>><?php echo $all['dis_name'];?></option>
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
							<option value="Text" <?php echo $one['dis_type'] == "Text" ? "selected":"";?> >Text Box</option>
							<option value="Bulean" <?php echo $one['dis_type'] == "Bulean" ? "selected":"";?>>Yes/No</option>
							<option value="Options" <?php echo $one['dis_type'] == "Options" ? "selected":"";?>>Option Type</option>
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
			}
			
			?>
			
			<?php
		}
		?>
		
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