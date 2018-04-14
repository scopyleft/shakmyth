<h4 id="myth">Myths</h4>
  <?php echo include_partial('search/info_results', array('count_results' => $count_results)); ?>
  <ul class="find" id="myth-pages">
     <?php foreach ($myth_pages as $myth_page): ?>
      <?php if($myth_page->getIsActive()): ?>
        <li class="find-myth-pages">
            <a href="<?php echo url_for('@myth_show?myth_id='.$myth_page->getMythId().'&myth_name='.$myth_page->getMythName().'&myth_category='.$myth_page->getMythCategory()) ?>"><?php echo $myth_page->getMyth()->getName() ?> -  <?php echo $myth_page->getMythCategory() ?></a>
        </li>
       <?php endif ?>
      <?php endforeach; ?>
  </ul>