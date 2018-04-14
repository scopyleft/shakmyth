<h3>Actions</h3>

<ul>
  <li><?php echo link_to('Reload Schema', 'sfDoctrineSchemaUI/reload_schema', array('confirm' => 'Are you sure? This will reload the schema information from disk.')); ?></li>
  <li><?php echo link_to('Export Schema', 'sfDoctrineSchemaUI/export_schema'); ?></li>
  <li><?php echo link_to('Save Schema', 'sfDoctrineSchemaUI/save_schema', array('confirm' => 'Are you sure? This will write the yaml schema back to disk.')); ?></li>
  <li><?php echo link_to('Add Model', 'sfDoctrineSchemaUI/add_record'); ?></li>
</ul>

<h3>Project Models</h3>

<ul>
  <?php foreach ($schema as $record): if ($record->isPlugin()) continue; ?>
    <li>
      <?php echo link_to($record['className'], 'sfDoctrineSchemaUI/edit_record?id=' . $record['className']) ?>
    </li>
  <?php endforeach; ?>
</ul>

<h3>Plugin Models</h3>

<ul>
  <?php foreach ($schema as $record): if (!$record->isPlugin()) continue; ?>
    <li>
      <?php echo link_to($record['className'], 'sfDoctrineSchemaUI/edit_record?id=' . $record['className']) ?>
    </li>
  <?php endforeach; ?>
</ul>