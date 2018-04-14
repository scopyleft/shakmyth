<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$b = new sfTestFunctional(new sfBrowser());

$b->info('5.0 - Ask homepage')->
  get('/')->

  with('request')->begin()->
    isParameter('module', 'pages')->
    isParameter('action', 'show')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Title-home')->
  end()
;
