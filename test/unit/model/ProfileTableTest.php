<?php

include dirname(__FILE__).'/../../bootstrap/unit.php';
include dirname(__FILE__).'/../../bootstrap/unitDoctrine.php';

$getTable = Doctrine::getTable('Profile'); 

$t = new lime_test(12, new lime_output_color());

/**
 * getProfilesByMythId($request->getParameter('myth_id'), $is_active = null)
 *
 **/  
$t->diag('::getProfilesByMythId()');
$t->isa_ok($getTable->getProfilesByMythId(28), 'Doctrine_Collection', 'result is a doctrine collection');
$t->is(count($getTable->getProfilesByMythId(28)), 3, 'count the return contributors');
$t->is(count($getTable->getProfilesByMythId(28, $is_active = true), true), 2, 'count the return active contributors');
$t->is(count($getTable->getProfilesByMythId(28, $is_active = false), false), 1, 'count the return inactive contributors');
$t->is(array_search('mayer', $getTable->getProfilesByMythId(28)->get(1)->toArray()), true, 'mayer is here');
$t->is(array_search('delord', $getTable->getProfilesByMythId(28)->get(2)->toArray()), true, 'delord is here');
$t->is(array_search('delord', $getTable->getProfilesByMythId(28, $is_active = false)->getFirst()->toArray()), true, 'delord is here with inactive');

/**
 * getMythsById($profile_id, $is_active = FALSE)
 *
 **/
$t->diag('getMythsById()');

$t->isa_ok($getTable->getMythsById($profile_id = 2), 'Doctrine_Collection', 'return doctrine_collection myths');
$t->is($getTable->getMythsById($profile_id = 3, $is_active = true)->count(), 2, 'return actived myth for profile');
$t->is($getTable->getMythsById($profile_id = 2, $is_active = null)->count(), 2, 'return inactived and actived myth for profile');
$t->is($getTable->getMythsById($profile_id = 2, $is_active = false)->count(), 1, 'return inactived myth for profile');

$t->is($getTable->getMythsById($profile_id = 1, $is_active = true), null, 'return null for profile without associated myth');