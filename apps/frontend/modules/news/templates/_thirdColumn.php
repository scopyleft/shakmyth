<?php load_assets('third_column') ?>

<div id="third-column">
	<?php foreach ($news as $new): ?>
		<div class="news">
			<h3 class="news"><?php echo ucfirst($new->getTitle()) ?></h3>
			<p class="content"><?php echo $new->getRaw('summary') ?></p>
			<a href="<?php echo url_for('@news_show?title='.$new->getTitle()) ?>"><< read more >></a>
		</div>
	<?php endforeach ?>
</div>