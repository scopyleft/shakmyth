  <ul class="nav-root" id="<?php echo $name ?>">
    <?php foreach ($nav_contents as $item): ?>
      <li class="pages"><?php echo link_to(ucfirst($item['label']), $item['link']) ?></li>
    <?php endforeach; ?>
  </ul>