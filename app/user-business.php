
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
		
		<div class="row">
			
			<div class="col-md-12 col-lg-12">
				<div class="questiondetail">
						
							<?php
							if(isset($_GET['s']))
							{
								$s = $_GET['s'];
								$id = $canid;
								$obj = new Dbconnect();
								$model = $obj->getSetModel($id,$s);
								

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
										       <i class="fa fa-angle-double-right"> <?php echo $mdname;?></i> 
										       <span class="float-right"><?php $obj = new Dbconnect(); echo $obj->anweredCount($id,$s,$mdno);?>/<?php $obj = new Dbconnect(); echo $obj->quesCount($mdno);?></span>
										      </a>
										    </div>
										    <div id="collapse<?php echo $xl;?>" class="collapse" data-parent="#accordion">
									<form class="" method="POST" action="<?php echo BSURL;?>functions/questions.php?case=answered">
										 <input type="hidden" name="userid" value="<?php echo $canid;?>">
										    		<input type="hidden" name="mainid" value="<?php echo $_GET['s'];?>">
										    		<input type="hidden" name="cateid" value="<?php echo $mdno;?>">
										      <div class="card-body">
										        <div class="table-responsive emptable">
													<table class="table table-bordered table-striped">
														<thead>
															<th width="50px">No</th>
															<th width="500px">Question</th>
															<th width="500px">Description</th>
															<th width="300px">Nature</th>
															<th width="300px">Comment</th>
															
														</thead>
														<tbody>
															<?php
															
															$table = "dis_questionset";
															$cond = array(
																'dis_master' => 'Business',
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
																		
																		'dis_canid' => $id,
																		'dis_quesid' => $qeid,
																		'dis_createdby' => $canid,
																	);
																	$obj = new Dbconnect();
																	$cost = $obj->getOnedata($table,$cond);

																	$table = "dis_answered";
																	$cond = array(
																		
																		'dis_canid' => $id,
																		'dis_quesid' => $qeid,
																	);
																	$obj = new Dbconnect();
																	$costup = $obj->getOnedata($table,$cond);
																	if($costup != "")
																	{
																		$ansort = $costup['dis_answer'];
																		$commet = $costup['dis_optional'];
																	}
																	else
																	{
																		$ansort = "";
																		$commet = "";
																	}
																	
																	?>
																	<tr>
																		<td><?php echo $xl;?></td>
																		
																		<td><?php echo $all['dis_question'];?></td>
																		<td><?php echo $all['dis_quesdetails'];?></td>
																		<td>
																			<?php
																		$nature = $all['dis_nature'];
																		$matur = $all['dis_type'];
																			switch($matur)
																			{
																				case "Bulean":
																				?>
														<input type="hidden" name="quesid[]" value="<?php echo $qeid;?>">
														<input type="hidden" name="ques<?php echo $qeid;?>" value="">
															
														<input type="radio" name="ques<?php echo $qeid;?>"  value="Yes" <?php echo $ansort=="Yes"? "checked":""?>> Yes
														<input type="radio" name="ques<?php echo $qeid;?>"  value="No" <?php echo $ansort=="No"? "checked":""?>> No
															<?php
																break;
																case "Text":
																?>
																<input type="hidden" name="quesid[]" value="<?php echo $qeid;?>">
																<textarea name="ques<?php echo $qeid;?>"  class="form-control"><?php echo $ansort;?></textarea>
																<?php
																break;
																case "Options":
																?>
																<input type="hidden" name="quesid[]" value="<?php echo $qeid;?>">
																<select name="ques<?php echo $qeid;?>" class="form-control" >
																	
																</select>
																<?php
																break;
															}
															?>
															</td>
															<td><textarea name="optional<?php echo $qeid;?>" class="form-control"><?php echo $commet;?></textarea></td>

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