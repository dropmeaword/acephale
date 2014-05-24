<div class="resultset">
	<?php if( Flash::not_empty() ): ?>
	<div id="notifications">
		<?php foreach( Flash::$messages as $id => $msg ) : ?>
		  <div class="flash <?= $id ?>"><?= $msg ?></div>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<p><?= $pagectx['result']; ?></p>

	<?php if(!empty($pagectx['results'])): ?>
	<ul>
		<?php foreach($pagectx['results'] as $addr): ?>
		<li><?= $addr ?></li>
		<?php endforeach; ?>
	<ul>
	<?php endif; ?>
</div>
