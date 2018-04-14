<h4 id="contributor">Contributors</h4>
  <?php echo include_partial('search/info_results', array('count_results' => $count_results)); ?>
  <ul class="find" id="contributors">
    <?php foreach ($contributors as $contributor): ?>
      <?php if($contributor->User->getIsActive()): ?>
        <li class="find-contributors">
          <a href="<?php echo url_for('@contributor_show?id='.$contributor->getId()."&last_name=".$contributor->getLastName()) ?>"><?php echo ucfirst($contributor->getLastName()) ?> - <?php echo ucfirst($contributor->getFirstName()) ?></a>
        </li>
      <?php endif ?>
    <?php endforeach; ?>
  </ul>
