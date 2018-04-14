<?php load_assets('layout') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
    <div id="header">
      <h1 id="site-title">A Dictionary of Shakespeare's Classical Mythology</h1>
      <?php if ($sf_user->isAuthenticated()): ?>
        <p id="logger">Connect as <?php echo $sf_user->getUserName() ?></p>
        <div id="admin-nav">
          <?php include_component('default', 'adminNav') ?>
        </div>
      <?php endif ?>
    </div>
    <div id="content">
      <?php echo $sf_content ?>
    </div>
    <script type="text/javascript">sfMediaBrowserWindowManager.init('<?php echo url_for('sf_media_browser_select') ?>');</script>
  </body>
</html>
