<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?= $pagectx['title']; ?></title>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<link rel="stylesheet" href="/acephale/res/default.css" type="text/css" />
<script src="/acephale/res/js/jquery.min.js"></script>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<div id="header">
		<div class="info">Your last login was on <?= time() ?> - <?= sqltime_to_time($pagectx['last_login']) ?> from <?= $pagectx['last_ip']; ?></div>
		<div class="logout"><a href="/acephale/logout">log out</a></div>
	</div>
	
	<div id="global-container">
		<h2>Hello <?= $pagectx['username']; ?>.</h2>
		<?php include $pagectx['template']; ?>	
	</div>
</body>
</html>