<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
include(dirname(__FILE__).'/../../lib/myTestBrowser.class.php');

$b = new myTestBrowser(new sfBrowser());
$b->signin('jean-christophe.mayer@univ-montp3.fr', 'JeanMAYE');
