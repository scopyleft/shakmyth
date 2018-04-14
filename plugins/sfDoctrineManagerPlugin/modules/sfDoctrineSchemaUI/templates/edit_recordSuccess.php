<?php echo get_partial('sfDoctrineSchemaUI/header'); ?>

  <?php if ($sf_request->getParameter('id')): ?>
    <h2>Edit <?php echo $record['className']; ?> <?php echo ucfirst($elementName); ?></h2>
  <?php else: ?>
    <h2>Add Record</h2>
  <?php endif; ?>

  <?php echo get_partial('sfDoctrineSchemaUI/record_menu', array('schema' => $schema, 'record' => $record)); ?>

  <?php if (isset($record) && $sf_request->getParameter('id')): ?>
    <div id="top_sub_menu">
      <?php echo get_partial('sfDoctrineSchemaUI/sub_menu', array('record' => $record)); ?>
    </div>
  <?php endif; ?>

  <?php echo form_tag('sfDoctrineSchemaUI/save_record', 'method=POST') ?>
    <input type="hidden" name="elementName" value="<?php echo $elementName; ?>" />
    <input type="hidden" name="id" value="<?php echo $record['className']; ?>" />

    <?php $form = isset($elementForm) ? $elementForm:$form; ?>
    <?php $html = (string) $form; ?>

    <table>
      <thead>
        <tr>
          <td colspan="2">
            <?php echo submit_tag('Save'); ?>
            <?php if ($sf_request->getParameter('id')): ?>
              <?php if (!$elementName): ?>
                <?php echo button_to('Delete', 'sfDoctrineSchemaUI/delete_record?id=' . $record['className'], 'confirm=Are you sure?'); ?>
              <?php elseif ($html): ?>
                <?php echo button_to('Delete All', 'sfDoctrineSchemaUI/delete_all_elements?id=' . $record['className'] . '&elementName=' . $elementName, 'confirm=Are you sure?'); ?>
              <?php endif; ?>
            <?php endif; ?>
          </td>
        </tr>
      </thead>
      <?php if ($html): ?>
          <?php echo $html; ?>
      <?php else: ?>
        <tr><td><strong>This <?php echo $record['className']; ?> does not have any <?php echo $elementName; ?>.</strong></td></tr>
      <?php endif; ?>
      <tfoot>
        <tr>
          <td colspan="2">
            <?php echo submit_tag('Save'); ?>
            <?php if ($sf_request->getParameter('id')): ?>
              <?php if (!$elementName): ?>
                <?php echo button_to('Delete', 'sfDoctrineSchemaUI/delete_record?id=' . $record['className'], 'confirm=Are you sure?'); ?>
              <?php elseif ($html): ?>
                <?php echo button_to('Delete All', 'sfDoctrineSchemaUI/delete_all_elements?id=' . $record['className'] . '&elementName=' . $elementName, 'confirm=Are you sure?'); ?>
              <?php endif; ?>
            <?php endif; ?>
          </td>
        </tr>
      </tfoot>
    </table>
  </form>

<?php echo get_partial('sfDoctrineSchemaUI/footer'); ?>