<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$b = new sfTestFunctional(new sfBrowser());

$b->
info('4.0 - Ask contributors list')->
  get('/contributors')->
  with('request')->begin()->
    isParameter('module', 'contributors')->
    isParameter('action', 'list')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Contributors list')->
    checkElement('span#last-name', 'ALATORRE')->
  end()->
  
info('  4.1 - Ask contributor alatorre')->
  get('/contributor/2/alatorre')->
  
  with('request')->begin()->
    isParameter('module', 'contributors')->
    isParameter('action', 'show')->

  end()->
  
  with('response')->begin()->
    isStatusCode(200)->
    contains('ALATORRE')->
    checkElement('h2', 'Contributor page')->
    checkElement('span#last-name', 'ALATORRE')->
    checkElement('div.myths_list h4', 'Myths List')->
    checkElement('div.myths_list a', 'Achilles')->
  end()->
  
info('  4.2 - Ask contributor mayer')->  
  back()->
  get('/contributor/3/mayer')->
  
  with('response')->begin()->
    isStatusCode(200)->
    contains('MAYER')->
    checkElement('h2', 'Contributor page')->
    checkElement('span#last-name', 'MAYER')->
    checkElement('div.myths_list h4', 'Myths List')->
    checkElement('div.myths_list a', 'Achilles')->
  end();

/*  
TODO: Add a user without myth 

info('  4.1 - Ask contributor delord')->  
  back()->
  get('/contributor//delord')->
  
  with('response')->begin()->
    isStatusCode(200)->
    contains('DELORD')->
    checkElement('h2', 'Contributor page')->
    checkElement('span.last-name', 'DELORD')->
    checkElement('div.myths_list h2', false)->
  end();
*/
