<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$b = new sfTestFunctional(new sfBrowser());

$b->info('8.0 - Search engine')->
  get('/')->

  with('request')->begin()->
    isParameter('module', 'pages')->
    isParameter('action', 'show')->
  end()->
  
  info('  8.1 - Search ipsum')->
  click('submit', array(
    'query' => 'ipsum',
  ))->

  with('request')->begin()->
    isParameter('module', 'search')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
	
    
    checkElement('ul .find #myth-pages', 1)->
    checkElement('li.find-myth-pages', 1)->
    
    checkElement('ul .find #contributors', 1)->
    checkElement('li.find-contributors', 2)->
    
    checkElement('ul .find #pages', 1)->
    checkElement('li.find-pages', 4)->
  end()->
  
  info('  8.2 - Search badoom')->
  click('submit', array(
    'query' => 'badoom',
  ))->

  with('response')->begin()->
    checkElement('h2#no-result')->
  end()->
  
  info('  8.3 - Search contemporary')->
  click('submit', array(
    'query' => 'contemporary',
  ))->
    
  with('response')->begin()->
    checkElement('h2#results')->
    
    checkElement('ul .find #myth-pages', 1)->
    checkElement('li.find-myth-pages', 0)->
    
    checkElement('ul .find #contributors', 0)->
    checkElement('li.find-contributors', 0)->
    
    checkElement('ul .find #pages', 0)->
    checkElement('li.find-pages', 0)->
  end();  
