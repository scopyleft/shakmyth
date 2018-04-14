<?php

include dirname(__FILE__).'/../../bootstrap/unit.php';
include dirname(__FILE__).'/../../bootstrap/unitDoctrine.php';

$getTable = Doctrine::getTable('Myth'); 

$t = new lime_test(16, new lime_output_color());

/**
 * createWidgetChoicesWithProfileId($profile_id, $is_active = null)
 */
$t->diag('::createWidgetChoicesWithProfileId()');
$t->isa_ok($getTable->createWidgetChoicesWithProfileId(3), 'array','verify is_array');
$t->is(count($getTable->createWidgetChoicesWithProfileId(3)), 7, 'count the return myths');
$t->is(array_key_exists(28, $getTable->createWidgetChoicesWithProfileId(3)), true, 'get a specific myth by key');
$t->is(array_search('naiad', $getTable->createWidgetChoicesWithProfileId(3)), true, 'get a specific myth by value');
$t->is_deeply(array_slice($getTable->createWidgetChoicesWithProfileId(3), 0, 1), array('' => ''), '1st is empty');

/**
 * getMythsWithFirstLetter($firstLetter = "a", $is_active = false)
 *
 **/
$t->diag('getMythsWithFirstLetter()');
$t->isa_ok($getTable->getMythsWithFirstLetter('a', true), 'Doctrine_Collection', 'return doctrine_collection myths');
$t->is($getTable->getMythsWithFirstLetter('a', true)->count(), 1, 'return actived myth');
$t->is($getTable->getMythsWithFirstLetter('z', true)->count(), 0, 'no myth for inactive letter');
$t->is($getTable->getMythsWithFirstLetter('t', true)->count(), 0, 'no myth for letter without actived myth');
$t->is($getTable->getMythsWithFirstLetter('t', false)->count(), 3, 'return inactived myth with false option');
$t->is($getTable->getMythsWithFirstLetter('taa', false)->count(), 0, 'no myth for punk letter');

/**
 * getLettersAndMythCount($is_active = false) 
 *
 **/
$t->diag('getLettersAndMythCount()');
$t->isa_ok($getTable->getLettersAndMythCount(false), 'array', 'return array letters for active');
$t->isa_ok($getTable->getLettersAndMythCount(true), 'array', 'return array letters for inactive');
$t->is(count($getTable->getLettersAndMythCount(true)), 26, 'return array letters for inactive');

$letters = $getTable->getLettersAndMythCount(true);
$t->is($letters['A'], 1, 'count actived myths begin by a letter');

$letters = $getTable->getLettersAndMythCount(false);
$t->is($letters['A'], 28, 'count inactived myths begin by a letter');


