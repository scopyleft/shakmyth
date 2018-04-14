<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$conn = Doctrine::getTable('Myth')->getConnection();
$conn->beginTransaction();

$b = new myTestBrowser(new sfBrowser());
$b->setTester('doctrine', 'sfTesterDoctrine');
$b->signin('admin', 'tieteck');

$b->
  click('Myths')->
  
info('  2.0 - Admin can click on Myth to have the Myths list')->
  with('request')->begin()->
    isParameter('module', 'myth')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Myth List')->
    checkElement('td[class="sf_admin_text sf_admin_list_td_name"]', 20)->
  end()->

info('  2.1 - Admin can click on amphimacus Myth to have the Myths edit')->
  click('amphimacus')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Edit Myth')->
    contains('amphimacus')->
  end()->

back()->
 
info('  2.2 - Admin click on page 2 to obtain the next myths list')->
  click('2')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Myth List')->
    checkElement('td[class="sf_admin_text sf_admin_list_td_name"]', 20)->
  end()->

info('  2.3 - Admin click on apollo and obtain the affiliate contributors')->
  click('apollo')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Edit Myth')->
    checkElement('select.uo_widget_form_select_many_asm option', 3+1)->
    contains('apollo')->
  end()->

  click('Save', array('myth' => array(
    'profiles_list' =>  array (3 => '1')
    ),
  ))->

isRedirected()->   
followRedirect()->
  
info('  2.4 - Admin create a new myth')->
  click('Myths')->
  click('New')->
    
  click('Save', array('myth' => array(
    'name' => 'wadge1',
    'profiles_list' =>   array (0 => '1', 2 => '3')
    ),
  ))->

  with('doctrine')->begin()->
    check('myth', array(
      'name'  => 'wadge1',
      'is_active' => false,
      ))->
  end()
  ;
 
$conn->rollBack();