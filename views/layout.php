<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?= $pagectx['title']; ?></title>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src="res/js/jquery.min.js"></script>

<style type="text/css">
input {
	display: block;
}

#container {
	width: 300px;
	margin: 0 auto 0 auto;
}

.flash {
	font-size: 0.85em;
}
.alert {
	color: red;
	font-weight: bold;
}

.warning {
	color: magenta;
}

.notice {
	color: blue;
}

#menu {
}

#menu dd {
	font-size: 0.75em;
	color: darkgrey;
	margin: 0 0 1em 0;
	padding: 0;
}
</style>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<?php include $pagectx['template']; ?>
</body>
</html>