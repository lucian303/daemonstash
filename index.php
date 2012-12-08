<?php
require_once 'DirectoryPrinter.php';
$printer = new DirectoryPrinter('-R ../uploads/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>DaemonStash</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Le styles -->
	<link href="assets/css/bootstrap.css" rel="stylesheet">
	<style>
		body {
			padding-top: 60px;
			/* 60px to make the container go all the way
				  to the bottom of the topbar */
		}

		.musicFiles {
			color: red;
			font-weight: bold;
		}
		.otherFiles {
			color: #006400;
		}
		.allFiles {
			color: blue;
		}
	</style>
	<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
	</script>
	<![endif]-->
	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="assets/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
<div class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
			</a>
			<a class="brand" href="#">
				DaemonStash
			</a>

			<div class="nav-collapse">
				<ul class="nav">
					<li>
						<a href="?type=all">
							All
						</a>
					</li>
					<li>
						<a href="?type=music">
							Music
						</a>
					</li>
					<li>
						<a href="?type=other">
							Other
						</a>
					</li>
				</ul>
			</div>
			<form class="navbar-form pull-right">
			</form>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3">
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<li class="nav-header">
						Search? ... NOT!
					</li>
					<li>
					</li>
					<li class="">
						<a href="?type=all">
							All
						</a>
					</li>
					<li class="">
						<a href="?type=music">
							Music
						</a>
					</li>
					<li class="">
						<a href="?type=other">
							Other
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="span9">
			<div class="hero-unit">
				<div>
					<h1>
						Get the fuck out!
					</h1>

					<p>
						If you've never been to the DS, don't ever come to the DS, cause you wouldn't
						understand the DS! -- Oldboy
					</p>
				</div>
				<a class="btn btn-primary" href="http://bit.ly/UtgAE8">
					Get me the fuck out of here before I die;
				</a>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<?php
					switch ($_GET['type']) {
						case 'music':
							$printer->printMusicDirectory();
							break;

						case 'other':
							$printer->printOtherDirectory();
							break;

						case 'all':
						default:
							$printer->printAllDirectory();
							break;
					}
					?>
				</div>
			</div>
			<div class="row-fluid">
			</div>
			<div class="span12">
				<br />
			</div>
			<div class="row-fluid">
			</div>
			<div class="span4">
			</div>
			<div>
				some shit here ...
			</div>
		</div>
	</div>
</div>

<script src="/assets/js/jquery-1.8.3.min.js"></script>
<script src="assets/js/bootstrap.js"></script>

</body>
</html>