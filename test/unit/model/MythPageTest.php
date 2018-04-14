<?php

include dirname(__FILE__).'/../../bootstrap/unit.php';
include dirname(__FILE__).'/../../bootstrap/unitDoctrine.php';

$categories = sfConfig::get('app_myth_categories');

$conn = Doctrine::getTable('MythPage')->getConnection();
// $conn->beginTransaction();

$page = new MythPage();
$page->setMythId(28);
$page->setContent('siemens');

$t = new lime_test(3, new lime_output_color());

/**
 * save() : test the searchable indexing
 */
$t->diag('save()');

$t->is($page->setMythCategory('iconography')->save(), null, 'ok: save free category');

try 
{
  $page->setMythCategory('badoom')->save();
  $t->todo('not ok: I can save bad category');
} 
catch (Exception $e) 
{
  $t->pass('ok: can t save bad category');
}

try 
{
  $page->setMythCategory('brief presentation')->save();
  $t->todo('not ok: I can save busy category');
} 
catch (Exception $e) 
{
  $t->pass('ok: can t save busy category');
}

// $conn->rollBack();