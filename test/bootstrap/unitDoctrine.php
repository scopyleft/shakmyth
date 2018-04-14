<?php

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
Doctrine::loadModels(sfConfig::get('sf_lib_dir').'/model/doctrine');
new sfDatabaseManager($configuration);

// Doctrine::loadData(sfConfig::get('sf_data_dir').'/test-fixtures');

    