<?php
abstract class BasesfDoctrineSchemaUIComponents extends sfComponents
{
  public function executeMenu()
  {
    $this->schema = $this->getUser()->getAttribute('doctrine_schema_manager')->getSchema();
  }
}