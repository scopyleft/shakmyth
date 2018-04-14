<div id="sf_dmgr_wrapper">
  <div id="sf_dmgr_header">
    <h1>Doctrine Schema Editor</h1>
  </div>

  <div id="sf_dmgr_menu">
    <?php echo get_component('sfDoctrineSchemaUI', 'menu'); ?>
  </div>

  <?php if ($sf_user->hasFlash('error') || $sf_user->hasFlash('notice')): ?>
    <div id="sf_dmgr_flash">
      <?php if ($sf_user->hasFlash('error')): ?>
        <div id="sf_dmgr_error">
          <?php echo $sf_user->getFlash('error'); ?>
        </div>
      <?php elseif ($sf_user->hasFlash('notice')): ?>
        <div id="sf_dmgr_notice">
          <?php echo $sf_user->getFlash('notice'); ?>
        </div>
      <?php endif; ?>
    </div>
  <?php endif; ?>


  <div id="sf_dmgr_content">