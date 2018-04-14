<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$b = new myTestBrowser(new sfBrowser());
$b->setTester('doctrine', 'sfTesterDoctrine');
$conn = Doctrine::getTable('sfGuardUser')->getConnection();
$conn->beginTransaction();

// $q = Doctrine::getTable('Myth')->findAll();
// foreach ($q->toArray() as $rec) {
// 
//   $rec .= array_search("apollo", $rec);
// }



$b->signin('admin', 'tieteck');

$b->
  click('Users')->

info('  4.0 - Admin can click on Users to have the Users list')->
  with('request')->begin()->
    isParameter('module', 'sfGuardUser')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'User list')->
    checkElement('li.sf_admin_action_new a', 'New')->
    checkElement('option[value="batchDelete"]', 'Delete')->
  end()->
  click('New')->
	with('response')->debug()->end();
	/*

  
info('  4.1 - Admin create a new profile')->
  click('New')->
  click('Save', array('sf_guard_user' => array(
    'is_super_admin' => '1',
    'is_active' => '1',
    'username' => 'wadge@sensio',
    'password' => 'malox',
    'password_again ' => 'malox',
    'Profile' => array(
       'first_name' => 'johnatan',
       'last_name' => 'wadge',
       'biography' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
       'myths_list' =>  array(
         0 => '1',
         1 => '28',
         2 => '3',
        )
  ))))->
  
click('Users');

// info('  4.3 - Admin ask the new record in edit mode')->
//   click('wadge@sensio')->
//   
//   with('response')->begin()->
//     isStatusCode(200)->
//     checkElement('div#sf_admin_container h1', 'Edit SfGuardUser')->
//     contains('wadge')->
//   end()->
//     
//   with('doctrine')->debug()->
//     check('sfGuardUser', array(
//       'username'  => 'admin',
//       'is_active' => true,
//       'is_super_admin' => true,
//     ))->
//     check('Profile', array(
//       'sf_guard_user_id' => 1,
//       'first_name' => 'stephane',
//     ))->

$b->info('  4.4 - Admin can update his profile without lost is_active and is_superadmin')->
  click('admin')->
  
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Edit SfGuardUser')->
    checkElement('input [checked="checked"] #sf_guard_user_is_active ', true)->
    checkElement('input #sf_guard_user_is_super_admin', true)->
    checkElement('select#sf_guard_user_groups_list', true)->
    checkElement('select#sf_guard_user_permissions_list', true)->
  end()->
  
  click('Save', array(
    'sfGuardAdmin' => array('username' => 'wadge',), 
    'Profile' => array('first_name' => 'johnatan'),
  ))->
  
  back()-> 

info('  4.5 - Admin can click on User to have the User Edit')->
  click('chiarisophie@hotmail.com')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Edit SfGuardUser')->
    contains('chiari')->
  end()->
  
  with('doctrine')->begin()->
    check('sfGuardUser', array(
      'username'  => 'admin',
      'is_active' => true,
      'is_super_admin' => true,
    ))->
    check('Profile', array(
      'sf_guard_user_id' => 1,
      'first_name' => 'stephane',
    ))->
  end()
;

$conn->rollBack();