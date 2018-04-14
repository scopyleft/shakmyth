<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$b = new myTestBrowser(new sfBrowser());
$b->signin('jean-christophe.mayer@univ-montp3.fr', 'JeanMAYE');

$b->
  click('Users')->
      isRedirected()->
      followRedirect()->

info('  5.0 - Contributor can click on Users to have his profile')->
  with('request')->begin()->
    isParameter('module', 'sfGuardUser')->
    isParameter('action', 'edit')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('div#sf_admin_container h1', 'Edit SfGuardUser')->
    checkElement('input[type="hidden"] #sf_guard_user_is_active', 1)->
    checkElement('input[type="hidden"] #sf_guard_user_is_active #sf_guard_user_is_super_admin', 1)->

    contains('mayer')->
  end();