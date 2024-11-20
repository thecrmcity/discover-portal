
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
					<li class="breadcrumb-item"><a href="<?php echo BSURL;?>app/question-assign.php"> Client List</a></li>
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
			<div class="col-lg-3 col-md-3 mt-4">
				<div class="questionlist">
					<ul>
						<li><a href="?id=<?php echo $_GET['id']?>&s=Business">Business Overview</a></li>
						<li><a href="?id=<?php echo $_GET['id']?>&s=Functional">Functional Requirement</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 mt-4">
				<div class="questiondetail">
					
							<?php
							if(isset($_GET['s']))
							{
								$s = $_GET['s'];
								$id = $_GET['id'];
								$obj = new Dbconnect();
								$model = $obj->getModule($s);
								
								if(!empty($model))
								{
									$xl =1;
									foreach($model as $md)
									{
										$mdset = explode(";", $md);
										$mdname = $mdset[0];
										$mdno = $mdset[1];
										$obj = new Dbconnect();
										?>
										<div id="accordion">

										  <div class="card">
										    <div class="card-header">
										      <a class="card-link text-dark font-weight-bold" data-toggle="collapse" href="#collapse<?php echo $xl;?>">
										       <i class="fa fa-angle-double-right"></i> <?php echo $mdname;?>
										       <span class="float-right"><?php $obj = new Dbconnect(); echo $obj->quesetCount($id,$s,$mdno);?>/<?php $obj = new Dbconnect(); echo $obj->quesCount($mdno);?></span> 
										      </a>
										    </div>
										    <div id="collapse<?php echo $xl;?>" class="collapse" data-parent="#accordion">
										    	<form class="" method="POST" action="<?php echo BSURL;?>functions/questions.php?case=assign">
										    		<input type="hidden" name="userid" value="<?php echo $_GET['id'];?>">
										    		<input type="hidden" name="mainid" value="<?php echo $_GET['s'];?>">
										    		<input type="hidden" name="cateid" value="<?php echo $mdno;?>">
										      <div class="card-body">
										        <div class="table-responsive emptable">
													<table class="table table-bordered table-striped">
														<thead>
															<th>No</th>
															<th>Question</th>
															<th>Description</th>
															<th>Nature</th>
															
															<th>
																<div class="custom-control custom-switch"><input type="checkbox" class="chk_all<?php echo $mdno;?> custom-control-input" id="customSwitch<?php echo $mdno;?>"><label class="custom-control-label" for="customSwitch<?php echo $mdno;?>"></label></div>
															</th>
														</thead>
														<tbody>
															<?php
															
															$table = "dis_questionset";
															$cond = array(
																'dis_category' => $mdno
															);
															$obj = new Dbconnect();
															$alldata = $obj->getAlldata($table,$cond);
															
															if(!empty($alldata))
															{
																$xl =1;
																foreach($alldata as $all)
																{
																	$qeid = $all['dis_id'];
																	$table = "dis_assigned";
																	$cond = array(
																		'dis_comid' => $comid,
																		'dis_canid' => $id,
																		'dis_quesid' => $qeid,
																		'dis_active' => '1',
																		'dis_createdby' => $canid,
																	);
																	$obj = new Dbconnect();
																	$cost = $obj->getOnedata($table,$cond);
																	
																	?>
																	<tr>
																		<td><?php echo $xl;?></td>
																		
																		<td><?php echo $all['dis_question'];?></td>
																		<td><?php echo $all['dis_quesdetails'];?></td>
																		<td><?php echo $all['dis_nature'];?><input type="hidden" name="ques[]" value="<?php echo $all['dis_id'];?>"></td>
																		<?php
																		if($cost != "")
																		{
																			?>
																			<td><input type="hidden" name="checkques<?php echo $qeid;?>" value="0"><input type="checkbox" name="checkques<?php echo $qeid;?>" value="1" class="chk_me<?php echo $mdno;?>" checked></td>
																			<?php
																		}
																		else
																		{
																			?>
																			<td><input type="hidden" name="checkques<?php echo $qeid;?>" value="0"><input type="checkbox" name="checkques<?php echo $qeid;?>" value="1" class="chk_me<?php echo $mdno;?>"></td>
																			<?php
																		}
																		?>
																		
																	</tr>
																	<?php
																	$xl++;
																	
																}
															}
															?>
														</tbody>
													</table>
													<script type="text/javascript">
														$(document).ready(function(){
															$(".chk_all<?php echo $mdno;?>").click(function(){
																$(".chk_me<?php echo $mdno;?>").prop('checked', this.checked);
															});
														});
													</script>
												</div>
												<div class="clearfix">
												<input type="submit" class="btn btn-primary float-right px-4 btn-sm" value="Submit">
											  </div>
										      </div>
										      </form>
										    </div>
										  </div>


										</div>
										<?php
										$xl++;
									}
								}
								
							}
							
							
							?>
						
					
				</div>
			</div>
		</div>
	</div>
</div>


<?php
$bsurl = dirname(__DIR__);
include $bsurl.'/inc/footer.php';
?>