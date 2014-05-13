<p>You have requested to unsubscribe the address  <?= $_GET['address'] ?> from this list. Please confirm that this is your address and that you want to unsubscribe.</p>

<form id="confirm_unsubscribe" name="confirm_unsubscribe" method="post" action="/acephale/unsubscribe">
	<input type="hidden" name="unsubscribe_confirmed" value="true" />
	<input type="hidden" name="address" value="<?= $_GET['address'] ?>" />
	<input type="submit" value="Please take me off the list" />
</form>