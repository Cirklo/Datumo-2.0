<!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<head>

<!-- BEGIN Meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>A jQuery powered HTML5 navigation menu</title>

<meta name="description" content="A jQuery powered HTML5 navigation menu" />
<meta name="author" content="Joe Pettersson, http://www.joepettersson.com" />

<!-- BEGIN Navigation bar CSS - This is where the magic happens -->
<link rel="stylesheet" href="css/navbar.css">
<!-- END Navigation bar CSS -->

<!-- BEGIN JavaScript -->
<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<!-- END JavaScript -->

</head>

<body>	
	
	<nav>
		<ul class="dropdown" id="menu">
			<li><a href=#>Home</a>
			<li><a href=#>Reports</a>
				<ul class="dropdown"> <!-- item submenu -->
					<li class="rtarrow"><a href=#>My reports</a>
						<ul>
							<li><a href=#>Report 1</a></li>
							<li><a href=#>Report 2</a></li>
							<li><a href=#>Report 3</a></li>
							<li><a href=#>Report 4</a></li>
							<li><a href=#>Report 5</a></li>
							<li><a href=#>Report 6</a></li>
							<li><a href=#>Report 7</a></li>
							<li><a href=#>Report 8</a></li>
						</ul>
					</li>
					<li><a href=#>Create report</a></li>
					<li class="rtarrow"><a href=#>Treeviews</a>
						<ul>
							<li><a href=#>Users per department</a></li>
						</ul>
					</li>
					<li><a href=#>Plots</a></li>
					<li><a href=#>Export to Excel</a></li>
				</ul> <!-- close submenu -->
			</li>
			<li><a href=#>Help</a>
			<li><a href=#>Helpdesk</a>
			<li><a href=#>Options</a> <!-- main item -->
				<ul class="dropdown"> <!-- item submenu -->
					<li><a href=#>About Datumo</a></li>
					<li><a href=#>About Cirklo</a></li>
					<li><a href=#>Donations</a></li>
				</ul> <!-- close submenu -->
			</li>
		</ul>
	</nav>
	
	
	
</body>
</html>