<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$b = new myTestBrowser(new sfBrowser());
$b->signin('admin', 'tieteck')->
  click('Menu')->


  with('request')->begin()->
    isParameter('module', 'menu')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('input[type="text"]', 5)->
  end()
;

$b = new myTestBrowser(new sfBrowser());
$b->signin('jean-christophe.mayer@univ-montp3.fr', 'JeanMAYE')->

  get('/admin/menu')->

  with('request')->begin()->
    isParameter('module', 'menu')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(404)->
  end()
;

