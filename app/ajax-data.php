<?php
if(!defined('BSPATH'))
{

	$bspath = dirname(__DIR__);
	include_once $bspath.'/config/database.php';

}

if(isset($_GET['case']))
{
	$case = $_GET['case'];
	switch($case)
	{
		case "optional":
		?>

		<script type="text/javascript">

              $(document).ready(function(){

              $("#proeducate").click(function(){

                  

                  var lastField = $("#education tr:last");

                  var fieldWrapper = $("<tr/>");

                  

                  var sName = $("<td><input type=\"text\" class=\"form-control rounded-0\" name=\"optionval[]\" placeholder=\"Option Value...\">");

                 

                  var removeButton = $("</td><td><span class=\"input-group-text rounded-0 btn-danger remove\"><i class=\"fa fa-times\"></i></span>");

                  removeButton.click(function() {

                      $(this).parent().remove();

                  });

                  

                  fieldWrapper.append(sName);

                  fieldWrapper.append(removeButton);

                  $("#education").append(fieldWrapper);

              });

          });

            </script>
             <table class="table table-bordered">

	            <thead class="bg-gray">

	              <th>Option Value</th>

	              <th><button type="button" class="btn btn-info border-0 btn-sm" id="proeducate"><i class="fa fa-plus"></i></button></th>

	            </thead>

	            <tbody id="education">

	              

	            </tbody>

	          </table>
		<?php
		break;
		case "role":
		?>
		<div class="form-group">
			<label>Select Company</label>
			<select class="form-control" name="company">
				<option value="">--Select--</option>
				<?php
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
						<option value="<?php echo $all['dis_id'];?>"><?php echo $all['dis_name'];?></option>
						<?php
					}
				}
				?>
			</select>
		</div>
		<?php
		break;
	}
}
?>