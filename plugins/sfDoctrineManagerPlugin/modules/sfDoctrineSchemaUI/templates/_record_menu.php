<?php if ($sf_request->getParameter('id') && $sf_request->getParameter('action') != 'export_schema'): ?>
  <?php echo button_to('Export Schema', 'sfDoctrineSchemaUI/export_schema?id=' . $record['className']); ?>
<?php endif; ?>

<?php if ($sf_request->getParameter('id') && $sf_request->getParameter('action') != 'edit_record' || $sf_request->getParameter('elementName')): ?>
  <?php echo button_to('Edit Record', 'sfDoctrineSchemaUI/edit_record?id=' . $record['className']); ?>
<?php endif; ?>

<?php if ($sf_request->getParameter('id') && in_array($elementName = $sf_request->getParameter('elementName'), array('indexes', 'relations', 'columns'))): ?>
  <?php $handlers = sfContext::getInstance()->getUser()->getAttribute('doctrine_schema_manager')->getHandlers(); ?>
  <?php if ($sf_request->getParameter('action') == 'add_element' || $sf_request->getParameter('action') == 'save_element'): ?>
    <?php echo button_to('Edit ' . ucfirst($elementName), 'sfDoctrineSchemaUI/edit_record?id=' . $record['className'] . '&elementName=' . $elementName); ?>
  <?php else: ?>
    <?php echo button_to('Add ' . $handlers[$elementName], 'sfDoctrineSchemaUI/add_element?id=' . $record['className'] . '&elementName=' . $elementName); ?>
  <?php endif; ?>
<?php endif; ?>