<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$b = new myTestBrowser(new sfBrowser());
$b->signin('admin', 'tieteck');

$b->
  click('Myths pages')->
  
info('  2.0 - Admin can click on MythPage to have the MythPages list')->
  with('request')->begin()->
    isParameter('module', 'myth_page')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Myth page List')->
    checkElement('li.sf_admin_action_new a', 'New')->
    checkElement('option[value="batchDelete"]', 'Delete')->
    checkElement('option[value="batchActived"]', 'Actived')->
    checkElement('option[value="batchInactived"]', 'Inactived')->
    checkElement('select#myth_page_filters_is_active option[value="0"]', 'no')-> 
    checkElement('select#myth_page_filters_is_active option[value="1"]', 'yes')-> 
    checkElement('select#myth_page_filters_is_active option', 3)->
    checkElement('select#myth_page_filters_myth_id option[value="8"]', 'aegle')-> 
    checkElement('select#myth_page_filters_myth_id option[value="28"]', 'apollo')->
    checkElement('select#myth_page_filters_myth_id option[value="2"]', 'acheron')-> 
    checkElement('select#myth_page_filters_myth_id option[value="32"]', 'odipus')->
    checkElement('select#myth_page_filters_myth_id option', 42)->    
  end()->

info('  2.1 - Admin can click on amphimacus Myth to have the Myths edit')->
  click('apollo')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Edit Myth page')->
    checkElement('select#myth_page_myth_category option', 'analysis')->
    checkElement('input#myth_page_is_active', true)->
    contains('Apollo')->
  end();

