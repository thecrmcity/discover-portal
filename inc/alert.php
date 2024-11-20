<?php

if(isset($_GET['i']))
{
	$i = $_GET['i'];
	switch($i)
	{
		case "duplicate":
		?>
		<div class="toast" data-autohide="true">
		    <div class="toast-header bg-danger">
		      <strong class="mr-auto text-light">Data Duplicate</strong>
		      
		    </div>
		    <div class="toast-body bg-danger text-light">
		      Data already Exist!
		    </div>
		  </div>
		<?php
		break;
	}
}