<?php $edit = array('actAs', 'attributes', 'columns', 'indexes', 'relations'); ?>
<ul>
  <?php foreach ($edit as $name): ?>
    <li><?php echo link_to(ucwords($name), 'sfDoctrineSchemaUI/edit_record?id=' . $record['className'] . '&elementName=' . $name); ?></li>
  <?php endforeach; ?>
</ul>