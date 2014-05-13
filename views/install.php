<?php
$pre = InstallHandler::check_preconditions();
if( isset($pre) ) {
	echo "<div class='flash warning'>$pre</div>";
}
?>
<?php if( Flash::not_empty() ): ?>
<div id="notifications">
	<?php foreach( Flash::$messages as $id => $msg ) : ?>
	  <div class="flash <?= $id ?>"><?= $msg ?></div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<div id="dialog">
	<p>Looks like Acephale is not installed. Let's roll our sleeves and install this puppy.</p>
	<form id="installer" name="installer" action="/acephale/install" method="post">
		<input type="hidden" name="action" value="install" />
		<input type="text" name="admin_username" value="" placeholder="administrator username" />
		<input type="text" name="admin_email" value="" placeholder="email address" />
		<input type="password" name="admin_password" value="" placeholder="password" />
		<input type="password" name="admin_password_verify" value="" placeholder="repeat password" />

		<input type="submit" value="Install &#187;" />
	</form>
</div>