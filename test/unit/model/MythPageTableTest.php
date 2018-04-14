<?php

include dirname(__FILE__).'/../../bootstrap/unit.php';
include dirname(__FILE__).'/../../bootstrap/unitDoctrine.php';

$categories = sfConfig::get('app_myth_categories');
$getTable = Doctrine::getTable('MythPage'); 

$conn = $getTable ->getConnection();
$conn->beginTransaction();

$t = new lime_test(42, new lime_output_color());

 /**
 * getCategoriesByMythId($myth_id, $is_active = FALSE)
 */
$t->diag('::getCategoriesByMythId()');

$cat_by_myth = $getTable->getCategoriesByMythId(28);

$t->isa_ok($cat_by_myth, 'array','is_array');
$t->is($cat_by_myth[3], $categories[3], 'cat[3] eq. result[3]');
$t->is(count($categories), 8, 'correct number of element');
$t->diag('::getCategoriesByMythId() active');

$cat_active_by_myth = $getTable->getCategoriesByMythId(28, true);

$t->isa_ok($cat_active_by_myth, 'array','is_array');
$t->is(count($cat_active_by_myth), 0, 'correct number of element');

/**
 * getFreeCategoriesChoices($object)
 */
$object = $getTable->find(5);

$t->diag('::getFreeCategoriesChoices()');

$busy_cat = $getTable->getCategoriesByMythId(28);
$free_cat = $getTable->getFreeCategoriesChoices($object);

$t->isa_ok($free_cat, 'array', 'is_array');
$t->is(count($busy_cat)+count($free_cat), count($categories), 'busy_cat + free_cat = total_cat');
$t->isnt(array_search('iconography', $free_cat), false, 'iconography is in free');
$t->is(array_search($categories[2], $free_cat), true, 'category 2 not in free_cat');
$t->is(array_search($categories[6], $free_cat), false, 'category 6 not in free_cat');
$t->isnt(array_search($categories[4], $busy_cat), false,'category 4 not in busy_cat');
$t->isnt(array_search($categories[7], $free_cat), false,'category 7 not in free_cat');
$t->ok(!isset($free_cat['']), 'no empty records ');
$t->ok(!array_search('contemporary occurrences', $free_cat), 'Contemporary Occurences not exist in free_cat');
$t->ok(array_search($object->getMythCategory(), $busy_cat), 'getMythCategory() in busy_cat');
$t->is_deeply(array_keys($free_cat), array_values($free_cat), 'keys eq. values');

/**
 * getOneWithCategoryAndMyth($myth_id, $category = null, $is_active = FALSE)
 */ 
$t->diag('::getOneWithCategoryAndMyth()');
$t->isa_ok($getTable->getOneWithCategoryAndMyth(28) , 'MythPage', 'default got a MythPage object');
$t->is($getTable->getOneWithCategoryAndMyth(28)->getMythCategory() , 'brief presentation', 'default => Brief Description');
$t->is($getTable->getOneWithCategoryAndMyth(28, 'classical sources')->getMythCategory() , 'classical sources', 'get a inactive myth page');
$t->is($getTable->getOneWithCategoryAndMyth(29, 'some secondary sources', true)->getMythCategory() , 'some secondary sources', 'get an active myth page');
$t->is($getTable->getOneWithCategoryAndMyth(28, 'classical sources', true), false, 'can t get an inactive myth page with is_active option');

/**
 * CountMythPages($myth_id, $is_active = FALSE)
 */
$myth_without_activated_myth_page_with_Active = $getTable->countMythPages(28, true);
$myth_without_myth_page_with_Active = $getTable->countMythPages(2, true);
$myth_with_activated_myth_page_with_Active = $getTable->countMythPages(3, true);

$myth_without_activated_myth_page = $getTable->countMythPages(30);
$myth_without_myth_page = $getTable->countMythPages(2);
$myth_with_activated_myth_page = $getTable->countMythPages(3);

$invalid_myth = $getTable->countMythPages('800');

$t->diag('countMythPages()');
$t->isa_ok($myth_without_activated_myth_page, 'integer', 'is int without_activated_myth_page');
$t->isa_ok($myth_with_activated_myth_page, 'integer', 'is int with_activated_myth_page');
$t->isa_ok($myth_with_activated_myth_page, 'integer', 'is int');
$t->ok($myth_without_activated_myth_page > 0, 'without_activated_myth_page');
$t->ok($myth_without_myth_page == 0, 'without_myth_page');
$t->ok($myth_with_activated_myth_page >0 , 'with_activated_myth_page');
$t->ok($myth_without_activated_myth_page_with_Active == 0, 'without_activated_myth_page_with_Active');
$t->ok($myth_without_myth_page_with_Active == 0, 'without_myth_page_with_Active');
$t->ok($myth_with_activated_myth_page_with_Active >0 , 'with_activated_myth_page_with_Active');
$t->ok($invalid_myth == 0, 'invalid myth');

/**
 * batchActivedCollection($ids, $state)
 *
 **/
$t->diag('batchActivedCollection()');

$ids = array(1, 2, 5);

$t->is($getTable->find(1)->getIsActive(), true , '1st record is actived');
$t->is($getTable->batchActivedCollection($ids, $is_active = true), 1, 'Ok to pass a collection in active');
$t->is($getTable->find(1)->getIsActive(), true, '1st record is now actived');
$t->is($getTable->find(5)->getIsActive(), true, '1th record is now actived');
$t->is($getTable->find(2)->getIsActive(), true, '2nd record is actived');

$t->is($getTable->batchActivedCollection($ids, $is_active = false), 1, 'Ok to pass a collection in inactive');
$t->is($getTable->find(1)->getIsActive(), false, '1st record is now inactived');
$t->is($getTable->find(5)->getIsActive(), false, '1th record is now inactived');
$t->is($getTable->find(2)->getIsActive(), false, '2nd record is now inactived');

$t->is($getTable->batchActivedCollection(array(1), $is_active = true), 1, '2nd record is now actived');

try 
{
  $t->is($getTable->batchActivedCollection(array(1000), $is_active = false), 1, 'None');
  $t->fail('Bad id 1000 not exist');
} 

catch (Exception $e) 
{
  $t->pass('None');
}

$conn->rollBack();



  