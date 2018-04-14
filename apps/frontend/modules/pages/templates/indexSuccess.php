<?php load_assets('page'); ?>

<div id="sub_content">
 <?php echo include_partial('content', array('page' => $page, 'content' => $sf_data->getRaw('content'))) ?>
</div>

<?php include_component('news', 'thirdColumn') ?>