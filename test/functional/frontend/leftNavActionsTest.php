<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$b = new sfTestFunctional(new sfBrowser());

$b->info('9.0 - Ask a simple page')->
  get('/')->
  with('response')->begin()->
		checkElement('h5.uo_widget_containers_list_title',3)->
		checkElement('a.left-nav-content')->
		checkElement('a.left-nav-content', 6)->
  end()
;

    