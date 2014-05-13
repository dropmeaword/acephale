<script type="text/javascript">
$(function() {
	$( "button#btnconfirm" ).click(function() {
		$( "div#frmmistake" ).hide();
		$( "div#frmconfirm" ).show();
	});
	$( "button#btnmistake" ).click(function() {
		$( "div#frmconfirm" ).hide();
		$( "button#btnconfirm" ).hide();
		$( "div#frmmistake" ).show();
	});
});

</script>

<div id="container">
	<img src="res/img/acephale.resized.jpg" alt="" title="without a head" />
	<p>Does this email address <?= $_GET['address'] ?> belong to you?</p>
	<div id="buttons" style="width: 200px;">
		<button id="btnconfirm" style="float:left;">Yes</button>&nbsp;<button id="btnmistake"  style="float:right;">Nay</button>
	</div>

	<div id="frmmistake" style="display:none">
		<p>Then you shouldn't really be unsubscribing other people from their favorite mailing list.</p>
	</div>

	<div id="frmconfirm" style="display:none">
		<p>Are you sure you want to unsubscribe from the list <?= mm_get_list_name(); ?>?</p>

		<form id="confirm_unsubscribe" name="confirm_unsubscribe" method="post" action="/acephale/unsubscribe">
			<input type="hidden" name="unsubscribe_confirmed" value="true" />
			<input type="hidden" name="address" value="<?= $_GET['address'] ?>" />
			<input type="submit" value="Yes please, take me off the list" />
		</form>
	</div>
</div>
