<?php

include dirname(__FILE__).'/../../bootstrap/unit.php';
include dirname(__FILE__).'/../../bootstrap/unitDoctrine.php';

$categories = sfConfig::get('app_myth_categories');

$conn = Doctrine::getTable('MythPage')->getConnection();
$conn->beginTransaction();

$t = new lime_test(8, new lime_output_color());

/**
 * renewIsActive()
 */
$t->diag('renewIsActive()');

$object = Doctrine::getTable('MythPage')->findOneByMythId(3);

$t->isa_ok($object->getMyth()->renewIsActive(), 'NULL', 'myth inactive is null');
$t->ok($object->getMyth()->getIsActive() === true, 'myth inactive is always false');

$object->setIsActive(true);
$object->save();

$t->isa_ok($object->getMyth()->renewIsActive(), 'NULL', 'save an active mythpage autorun changeIsActive()');
$t->ok($object->getMyth()->getIsActive() === true, 'myth active is in true');

$object->setIsActive(false);
$object->save();

$t->isa_ok($object->getMyth()->renewIsActive(), 'NULL', 'save a inactive mythpage autorun changeIsActive()');
$t->ok($object->getMyth()->getIsActive() === false, 'myth inactive is in false');


$object = Doctrine::getTable('MythPage')->findOneByMythId(28);

$t->isa_ok($object->getMyth()->renewIsActive(), 'NULL', 'an other active mythpage, nothing to change');
$t->ok($object->getMyth()->getIsActive() === false, 'myth active is in true');

$conn->rollBack();
