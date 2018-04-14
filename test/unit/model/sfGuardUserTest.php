<?php

include dirname(__FILE__).'/../../bootstrap/unit.php';
include dirname(__FILE__).'/../../bootstrap/unitDoctrine.php';

$categories = sfConfig::get('app_myth_categories');

$conn = Doctrine::getTable('sfGuardUser')->getConnection();
$conn->beginTransaction();

$t = new lime_test(8, new lime_output_color());

/**
 * renewIsActive()
 */
$t->diag('update preserve photo and superadmin');

$object = Doctrine::getTable('sfGuardUser')->find(1);

$t->diag('retrieve admin object');
$t->ok($object->getProfile()->getFirstName() === 'stephane', 'admin firstname is Stephane');
$t->ok($object->getUserName() === 'admin', 'he s an admin');
$t->ok($object->getIsActive() === true, 'admin is active');
$t->ok($object->getIsSuperAdmin() === true, 'admin is superadmin');

$object->getProfile()->setFirstName('johnatan');
$object->setUserName('wadge');
$object->save();

$t->ok($object->getProfile()->getFirstName() === 'johnatan', 'admin firstname is johnatan');
$t->ok($object->getUserName() === 'wadge', 'admin is Wadge');
$t->ok($object->getIsActive() === true, 'admin is active');
$t->ok($object->getIsSuperAdmin() === true, 'admin is superadmin');

$conn->rollBack();
