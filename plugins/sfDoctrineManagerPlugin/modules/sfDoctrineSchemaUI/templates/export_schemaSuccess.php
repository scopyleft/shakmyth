<?php echo get_partial('sfDoctrineSchemaUI/header'); ?>
<?php
$options = array();
$options['schema'] = $schema;
if (isset($record))
{
  $options['record'] = $record;
}
?>

<?php echo get_partial('sfDoctrineSchemaUI/record_menu', $options); ?>

  <h2>Export Schema</h2>

  <pre><code><?php echo $yaml; ?></code></pre>

<?php echo get_partial('sfDoctrineSchemaUI/footer'); ?>