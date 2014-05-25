<script type="text/javascript">
$(function() {
	$("#loginUsername").focus();
});
</script>

<?php if( Flash::not_empty() ): ?>
<div id="notifications">
	<?php foreach( Flash::$messages as $id => $msg ) : ?>
	  <div class="flash <?= $id ?>"><?= $msg ?></div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<p>Welcome to acephale.</p>

<div id="login">
	<form id="login" name="login" action="/acephale/" method="post">
		<input type="hidden" name="action" value="login" />
		<input type="text" id="loginUsername" name="username" value="" placeholder="username" />
		<input type="password" name="password" value="" placeholder="password" />
		<input type="submit" value="Log in" />
	</form>
</div>