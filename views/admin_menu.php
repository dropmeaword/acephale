<script type="text/javascript">
$(function() {
	$( "#lnkAddNew" ).click(function() {
		$( "#formRemove" ).hide();
		$( "#formSearch" ).hide();
		$( "#formAdd" ).show();

   		$("#results").hide();
   		$("#results").html("");
	});
	$( "#lnkRemove" ).click(function() {
		$( "#formRemove" ).show();
		$( "#formSearch" ).hide();
		$( "#formAdd" ).hide();

   		$("#results").hide();
   		$("#results").html("");
	});

	$( "#lnkSearch" ).click(function() {
		$( "#formRemove" ).hide();
		$( "#formSearch" ).show();
		$( "#formAdd" ).hide();

   		$("#results").hide();
   		$("#results").html("");
	});

/*
	$("#formAdd").submit(function() {
		$.ajax({
           type: "POST",
           url: "/acephale/manage",
           data: $("#formAdd").serialize(), // serializes the form's elements.
           success: function(data)
           {
           		$("#results").show();
           		$("#results").html(data);
           }
         });
    	return false; // avoid to execute the actual submit of the form.
   	});

	$("#formRemove").submit(function() {
		$.ajax({
           type: "POST",
           url: "/acephale/manage",
           data: $("#formRemove").serialize(), // serializes the form's elements.
           success: function(data)
           {
           		$("#results").show();
           		$("#results").html(data);
           }
         });
    	return false; // avoid to execute the actual submit of the form.
	});

	$("#formSearch").submit(function() {
		$.ajax({
           type: "POST",
           url: "/acephale/manage",
           data: $("#formSearch").serialize(), // serializes the form's elements.
           success: function(data)
           {
           		$("#results").show();
           		$("#results").html(data);
           }
         });
    	return false; // avoid to execute the actual submit of the form.
	});
*/
});

</script>

<div id="dialog">
	<dl id="menu">
		<dt><a id="lnkAddNew" href="/acephale/manage/add">Add new subscribers</a></dt>
		<dd>Add a new email address to the newsletter</dd>
		<dt><a id="lnkRemove" href="/acephale/manage/remove">Remove existing subscribers</a></dt>
		<dd>Take off an existing email address from the newsletter</dd>
		<dt><a id="lnkSearch"  href="/acephale/manage/search">Search</a></dt>
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

	<?php if( isset($pagectx['result']) && isset($pagectx['results']) ): ?>
		<?php include "views/manage_result.php"; ?>
	<?php endif; ?>

	<?php if( array_key_exists("action", $pagectx) ): ?>
		<?php if($pagectx['action'] == 'add'): ?>
		<form id="formAdd" class="form" name="formAdd" action="/acephale/manage" method="post">
			<label for="addresses">Only one email address per line please.</label>
			<input type="hidden" name="action" value="add" />
			<textarea name="addresses" cols="28" rows="8"></textarea>
			<input type="submit" id="btnAddSubscribers" value="Add subscribers &#187;" />
		</form>
		<?php elseif($pagectx['action'] == 'remove'): ?>
		<form id="formRemove" class="form" name="formRemove" action="/acephale/manage" method="post">
			<label for="addresses">Only one email address per line please.</label>
			<input type="hidden" name="action" value="remove" />
			<textarea name="addresses" cols="28" rows="8"></textarea>
			<input type="submit" id="btnRemoveSubscribers" value="Remove subscribers &#187;" />
		</form>
		<?php elseif($pagectx['action'] == 'search'): ?>
		<form id="formSearch" class="form" name="formSearch" action="/acephale/manage" method="post">
			<input type="hidden" name="action" value="search" />
			<input type="text" name="term" placeholder="email address" style="float:left;" />
			<input type="submit" id="btnSearch" value="Search for address" style="float:left;" />
		</form>
		<?php endif; ?>
	<?php endif; ?>
</div>