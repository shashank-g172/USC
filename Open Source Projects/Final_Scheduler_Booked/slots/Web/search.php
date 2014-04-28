<head>

<?php 
require_once('connection.php');
define('ROOT_DIR', '../');
require_once(ROOT_DIR . 'Pages/ProfilePage.php');


$page =  new ProfilePage();
$page->Display('globalheader.tpl');

?>
<script type="text/javascript">


function validateForm()
{
	var Name=document.forms["search"]["username"].value;
	var SDate=document.forms["search"]["startdate"].value;
	var EDate=document.forms["search"]["enddate"].value;
	var Location=document.forms["search"]["location"].value;
	
		
	if ((Name==null || Name=="") && (SDate==null || SDate=="") && (EDate==null || EDate=="") && (Location==null || Location==""))
	{
		alert("\nSearch paramters cannot be empty. Please enter a value");
		return false;
	}

	return true;
}

</script>

<link class="cssdeck" rel="stylesheet" href="scripts/js/bootstrap.min.css">
<link rel="stylesheet" href="scripts/js/bootstrap-responsive.min.css" class="cssdeck">
</head>
<body>
<div id="wrapper">
	<div class="title" style="margin:20px">
		<span class="byline" style="font-size:24px">Search Surgery Center</span>
	</div>
	<div>
		<ul class="nav nav-tabs">
				<li class="active"><a href="#name" data-toggle="tab">Search By Name</a></li>
				<li><a href="#start_date" data-toggle="tab">Search By Date</a></li>
				<li><a href="#location" data-toggle="tab">Search By Location</a></li>
			</ul>
	</div>
	<form class="complete" name="search" action='searchresult.php' method="POST" onsubmit="return validateForm()">
	<div id="myTabContent" class="tab-content">
				<div class="tab-pane active in" id="name">
						<fieldset>
								<legend>Search By Name</legend>
								<label class="control-label"  for="username">Surgery Center Name</label>
									<input type="text" id="username" name="username" placeholder="" class="input-xlarge">
						</fieldset>
					            
				</div>
				<div class="tab-pane fade" id="start_date">
				  <fieldset>
					<legend>Search By Date</legend>	
						<label class="control-label"  for="username">StartDate</label>
						<input type="date" id="startdate" name="startdate" placeholder="" class="input-xlarge" min="<?php echo date('Y-m-d'); ?>">
					    <label class="control-label"  for="username">EndDate</label>
						<input type="date" id="enddate" name="enddate" placeholder="" class="input-xlarge" min="<?php echo date('Y-m-d'); ?>">
						<label class="control-label"  for="username">Duration</label>
						<!-- <input type="text" id="duration" name="duration" placeholder="" class="input-xlarge"> --> 
				       
				        <select name="duration">
								<option value="0.5">0.5</option>
								<option value="1">1</option>
								<option value="1.5">1.5</option>
								<option value="2">2</option>
								<option value="2.5">2.5</option>
								<option value="3">3</option>
								<option value="3.5">3.5</option>
								<option value="4">4</option>
								<option value="4.5">4.5</option>
								<option value="5">5</option>
								<option value="5.5">5.5</option>
								<option value="6">6</option>
						</select>
					</fieldset>
				</div>
				<div class="tab-pane fade" id="location">
					<fieldset>
						<legend>Search By Location</legend>
						<label class="control-label"  for="username">Current Location</label>
						<input type="text" id="location" name="location" placeholder="" class="input-xlarge">
					</fieldset>
				</div>
			<div>
				<input type="submit" name="Search" value="Search"/>
			</div>
			</div>
			</form>
	
</div>

<script class="cssdeck" src="scripts/js/jquery.min.js"></script>
<script class="cssdeck" src="scripts/js/bootstrap.min.js"></script>
<?php
$page->Display('globalfooter.tpl');

?>
</body>