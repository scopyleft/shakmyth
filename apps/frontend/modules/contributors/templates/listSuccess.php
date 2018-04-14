<!-- $contributor->getProfile()->getPhoto() A REMPLACER  $photo -->

<h2><Contributors list><?php echo $title ?></h2>
<p><< click on photo for details >></p>
  <?php foreach ($contributors as $contributor): ?>
		<?php echo include_component('contributors', 'contributor', array('contributor' => $contributor)) ?>
  <?php endforeach; ?>
