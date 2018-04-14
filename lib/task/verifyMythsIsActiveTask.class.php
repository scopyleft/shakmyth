<?php

class verifyMythsIsActiveTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_OPTIONAL, 'The environment', 'all'),
    ));

    $this->namespace        = 'shakmyth';
    $this->name             = 'verifyMythsIsActive';
    $this->briefDescription = 'Verify the is_active status of each myth';
    $this->detailedDescription = <<<EOF
The [verifyMythsIsActive|INFO] task does things.
Call it with:

  [php symfony verifyMythsIsActive|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

    // add your code here
    $counter = 0;
    $myths = Doctrine::getTable('Myth')->findAll();
    
    foreach ($myths as $myth) 
    {
      $is_active = $myth->getIsActive();
      $myth->changeIsActive();
      ($is_active == $myth->getIsActive()) ? null : $this->logSection($myth->getName().' =>', 'toggle'.$myth->getIsActive());
      
      $counter++;
    }
    
    $this->logSection('Verify Myth =>', 'All ('.$counter.') myths are verify.');
  }
}
