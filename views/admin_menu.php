<style type="">
#header h2 {
	font-size: 8pt;
}

#header {
	background: yellow;
	color: black;
}

#header .logout {
	font-size: 8pt;
	float: right;
}

#dialog {
	float: left;
}

#forms {
	margin: 0 12px 0 24px;
	float: left;
}

.form p {
	color: darkgrey;
	font-size: 0.85em;
	margin: 0 0 8px 0;
	padding: 0;
}
</style>

<script type="text/javascript">
$(function() {
	$( "formRemove" ).hide();
	$( "formSearch" ).hide();
	$( "formAdd" ).hide();

	$( "lnkAddNew" ).click(function() {
		$( "formRemove" ).hide();
		$( "formSearch" ).hide();
		$( "formAdd" ).show();
	});
	$( "lnkRemove" ).click(function() {
		$( "formRemove" ).show();
		$( "formSearch" ).hide();
		$( "formAdd" ).hide();
	});

	$( "lnkSearch" ).click(function() {
		$( "formRemove" ).hide();
		$( "formSearch" ).show();
		$( "formAdd" ).hide();
	});
});

</script>

<div id="header">
	<h2>Your last login was on <?= $pagectx['last_login']; ?> from <?= $pagectx['last_ip']; ?></h2>
	<div class="logout"><a href="/acephale/logout">log out</a></div>
</div>

<h2>Hello <?= $pagectx['username']; ?>.</h2>

<div id="dialog">
	<dl id="menu">
		<dt><a id="lnkAddNew" href="#">Add new subscribers</a></dt>
		<dd>Add a new email address to the newsletter</dd>
		<dt><a id="lnkRemove" href="#">Remove existing subscribers</a></dt>
		<dd>Take off an existing email address from the newsletter</dd>
		<dt><a id="lnkSearch"  href="#">Search</a></dt>
		<dd>Search for a particular subscriber</dd>
	</dl>
</div>

<?php if( Flash::not_empty() ): ?>
<div id="notifications">
	<?php foreach( Flash::$messages as $id => $msg ) : ?>
	  <div class="flash <?= $id ?>"><?= $msg ?></div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<div id="forms">
	<form id="formAdd" class="form" name="formAdd" action="/acephale/manage" method="post">
		<p>Only one email address per line please.</p>
		<input type="hidden" name="action" value="add" />
		<textarea name="addresses" cols="28" rows="8"></textarea>
		<input type="submit" value="Add subscribers &#187;" />
	</form>

	<form id="formRemove" class="form" name="formRemove" action="/acephale/manage" method="post">
		<p>Only one email address per line please.</p>
		<input type="hidden" name="action" value="remove" />
		<textarea name="addresses" cols="28" rows="8"></textarea>
		<input type="submit" value="Remove subscribers &#187;" />
	</form>

	<form id="formSearch" class="form" name="formSearch" action="/acephale/manage" method="post">
		<input type="hidden" name="action" value="search" />
		<input type="text" name="term" placeholder="email address"/>
		<input type="submit" value="Search for address" />
	</form>
</div>