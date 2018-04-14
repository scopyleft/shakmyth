<?php echo get_partial('sfDoctrineSchemaUI/header'); ?>
<?php echo get_partial('sfDoctrineSchemaUI/record_menu', array('schema' => $schema, 'record' => $record)); ?>

  <?php $name = $sf_request->getParameter('elementName'); ?>
  <?php $handlers = sfDoctrineSchemaManager::getHandlers(); $name = $handlers[$name]; ?>
  <h2>Add <?php echo $sf_request->getParameter('id'); ?> <?php echo $name; ?></h2>

  <?php echo form_tag('sfDoctrineSchemaUI/save_element', 'method=POST') ?>
    <input type="hidden" name="elementName" value="<?php echo $sf_request->getParameter('elementName'); ?>" />
    <input type="hidden" name="id" value="<?php echo $sf_request->getParameter('id'); ?>" />

    <table>
      <thead>
        <tr>
          <td colspan="2">
            <input type="submit" name="save" value="Save" />
            <input type="submit" name="save_and_add" value="Save & Add" />
          </td>
        </tr>
      </thead>
      <?php echo $form; ?>
      <tfoot>
        <tr>
          <td colspan="2">
            <input type="submit" name="save" value="Save" />
            <input type="submit" name="save_and_add" value="Save & Add" />
          </td>
        </tr>
      </tfoot>
    </table>
  </form>

<?php echo get_partial('sfDoctrineSchemaUI/footer'); ?>