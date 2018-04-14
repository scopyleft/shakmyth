<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$b = new sfTestFunctional(new sfBrowser());

$b->info('7.0 - Ask a simple page')->
  get('/page/title-home')->

  with('request')->begin()->
    isParameter('module', 'pages')->
    isParameter('action', 'show')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Title-home')->
  end()
;
