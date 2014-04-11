<head>
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
	<form class="complete" action='searchresult.php' method="POST">
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
						<input type="text" id="startdate" name="startdate" placeholder="" class="input-xlarge">
					    <label class="control-label"  for="username">EndDate</label>
						<input type="text" id="enddate" name="enddate" placeholder="" class="input-xlarge">
						<label class="control-label"  for="username">Duration</label>
						<input type="text" id="duration" name="duration" placeholder="" class="input-xlarge">
				
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

</body>