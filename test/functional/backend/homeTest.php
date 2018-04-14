<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$b = new myTestBrowser(new sfBrowser());
$b->signin('jean-christophe.mayer@univ-montp3.fr', 'JeanMAYE')->

info('  1.1 - After connexion in contributor just contextual options menu are actived')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('ul.uo_widget_list_drop_down', true)->
      checkElement('a', 'Frontend')->
      checkElement('a[href*="admin"]', 'Home')->
      checkElement('a[href*="myth_page"]', 'Myths pages')->
      checkElement('a[href*="user"]', 'Users')->
      checkElement('a[href*="logout"]', '[Logout]')->
  end();
