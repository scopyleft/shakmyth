<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$b = new myTestBrowser(new sfBrowser());
$b->signin('admin', 'tieteck')->

info('  1.0 - After connexion in admin all options menu are actived')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('ul.uo_widget_list_drop_down', true)->
      checkElement('a', 'Frontend')->
      checkElement('a[href*="admin"]', 'Home')->
      checkElement('a[href*="myth"]', 'Myths')->
      checkElement('a[href*="myth_page"]', 'Myths pages')->
      checkElement('a[href*="/page"]', 'Pages')->
      checkElement('a[href*="user"]', 'Users')->
      checkElement('a[href*="group"]', 'Groups')->
      checkElement('a[href*="permission"]', 'Permissions')->
      checkElement('a[href*="logout"]', '[Logout]')->
  end();
