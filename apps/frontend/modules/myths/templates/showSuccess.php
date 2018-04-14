<h2>Shakespeare's Myths</h2>
<div id="header-myth">
  <h3 class="title" id="top-title"><?php echo ucfirst($myth_page->getMyth()->getName()) ?></h3>
  <div id="header-myth-col-1">
    <ul id="myth-nav">
      <?php foreach ($categories as $category): ?>
        <?php if ($myth_page->getmyth_category() == $category): ?>
          <li id="category-selected"><?php echo ucfirst($category) ?></li>
        <?php else: ?>
          <li><?php echo link_to(ucfirst($category), '@myth_show?myth_id='.$myth_page->getMythId().'&myth_name='.$myth_page->getMyth()->getName().'&myth_category='.$category) ?></li>
        <?php endif ?>  
      <?php endforeach ?>
    </ul>
  </div>

  <div id="header-myth-col-2">
    <ul class="contributors">
    <?php foreach ($contributors as $contributor): ?>
      <li><?php echo link_to($contributor, '@contributor_show?id='.$contributor->getId().'&last_name='.$contributor->getLastName()) ?></a></li>
    <?php endforeach ?>
    </ul>

<?php if ($pdf_name): ?>
<a href="/uploads/<?php echo $pdf_name ?>"><< download article >></a>
<?php endif; ?>


	</div>
</div>  
<p class="content"><?php echo $sf_data->getRaw('content') ?></p>
<a href="#content" id="back"><< back to top >></a>