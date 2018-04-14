<h2><?php echo $title ?></h2>

	<?php foreach ($news as $new): ?>
		<div class="news-bloc">
			<h3 class="news"><?php echo ucfirst($new->getTitle()) ?></h3>
			<p class="content"><?php echo $new->getRaw('content') ?></p>
		</div>
	<?php endforeach ?>