<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?= $pagectx['title']; ?></title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

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

</style>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<?php include $pagectx['template']; ?>
</body>
</html>