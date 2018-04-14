<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$b = new sfTestFunctional(new sfBrowser());

$b->info('6.0 - Ask dicentries')->
  get('/dicentries')->

  with('request')->begin()->
    isParameter('module', 'myths')->
    isParameter('action', 'list')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('li[class="letters"] > a', 'A')->
  end()
;
