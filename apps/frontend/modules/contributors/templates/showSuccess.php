<h2>Biography</h2>
<div id="contributor-col-1"> 
  <p class="biography"><?php echo $sf_data->getRaw('biography') ?></p>
</div>
<div id="contributor-col-2">
	<?php echo include_component('contributors', 'contributor', array('contributor' => $profile)) ?>
  <?php if (!is_null($myths)): ?>
    <?php echo include_partial('myths/myths_list', array('myths' => $myths)) ?>
  <?php endif ?> 
</div>

