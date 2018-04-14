<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$b = new myTestBrowser(new sfBrowser());
$b->signin('jean-christophe.mayer@univ-montp3.fr', 'JeanMAYE');

$b->
  click('Myths pages')->
  
info('  3.2 - Contributor can click on MythPage to have the MythPages list')->
  with('request')->begin()->
    isParameter('module', 'myth_page')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Myth page List')->
    checkElement('li.sf_admin_action_new a', false)->
    checkElement('option[value="batchDelete"]', false)->
    checkElement('option[value="batchActived"]', false)->
    checkElement('option[value="batchInactived"]', false)->
    checkElement('select#myth_page_filters_is_active option[value="0"]', null)-> 
    checkElement('select#myth_page_filters_is_active option', 0)->
    checkElement('select#myth_page_filters_myth_id option[value="28"]', 'apollo')-> 
    checkElement('select#myth_page_filters_myth_id option[value="29"]', false)->
    checkElement('select#myth_page_filters_myth_id option[value="30"]', 'naiad')-> 
    checkElement('select#myth_page_filters_myth_id option[value="36"]', 'scylla')->   
    checkElement('select#myth_page_filters_myth_id option', 5)->   
  end()->

info('  3.3 - Contributor can click on amphimacus Myth to have the Myths edit')->
  click('apollo')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Edit Myth page')->
    checkElement('select#myth_page_myth_category option', 'analysis')->
    checkElement('input#myth_page_is_active', false)->
    contains('Apollo')->
  end();
