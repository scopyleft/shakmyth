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
    <div class="container">
      <div id="header">
        <h1 id="site-title"><a href="<?php echo url_for('@home_page') ?>">A Dictionary of Shakespeare's Classical Mythology</a></h1>
        <?php include_component('default', 'nav', array("name" => "top-nav")) ?>
        
        <div id="search-engine">
          <h3>search entire website</h3>
          <?php include_partial('search/engine') ?>
        </div>
        <a href="<?php echo url_for('@home_page') ?>" id="banner"><img src="/media/banner_0<?php echo rand(1,2) ?>.jpg"></a>
        
        <div id="banner-icons">
          <?php echo link_to(image_tag('/media/logo_cnrs.jpg', array('id' => 'logo-cnrs')), 'http://www.cnrs.fr/') ?>
          <?php echo link_to(image_tag('/media/logo_upv_2012.jpg', array('id' => 'logo-upv')), 'http://www.univ-montp3.fr') ?>
          <?php echo link_to(image_tag('/media/logo_ircl.jpg', array('id' => 'logo-ircl')), 'http://www.ircl.cnrs.fr') ?>
        </div>
      </div>
      <div id="left-nav">
        <?php include_component('default', 'leftNav', array("name" => "left-nav")) ?> 
        <?php image_tag('/media/backend.gif', array('id' => 'icon-backend')) ?>
        
				<div id="icons-bar">
        	<?php echo link_to(image_tag('/media/icon_home.gif', array('class' => 'icons')), '@home_page') ?>
        	<?php echo link_to(image_tag('/media/icon_contact.gif', array('class' => 'icons')), 'page', array('title' => 'contact')) ?>
        	<?php echo link_to(image_tag('/media/icon_copyright.gif', array('class' => 'icons')), 'page', array('title' => 'copyright')) ?>
				</div>
      </div>

      <div id="content">
        <?php echo $sf_content ?>
      </div>
  </body>
</html>

    