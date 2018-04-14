<?php load_assets('page') ?>

<div id="sub_content">
	<h2><?php echo ucfirst($news->getTitle()) ?></h2>
	<p class="content"><?php echo $news->getRaw('content') ?></p>
</div>

<?php include_component('news', 'thirdColumn') ?>