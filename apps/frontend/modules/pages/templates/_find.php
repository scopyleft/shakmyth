<h4 id="general-page">General pages</h4>
  <?php echo include_partial('search/info_results', array('count_results' => $count_results)); ?>
  <ul class="find" id="pages">
      <?php foreach ($pages as $page): ?>
        <?php if($page->getIsActive()): ?>
          <li class="find-pages">
            <a href="<?php echo url_for('@page?title='.$page->getTitle()) ?>"><?php echo $page->getTitle() ?></a>
          </li>
        <?php endif ?>
      <?php endforeach; ?>
  </ul>