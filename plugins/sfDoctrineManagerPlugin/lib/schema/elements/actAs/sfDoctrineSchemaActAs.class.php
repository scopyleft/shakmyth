<?php
class sfDoctrineSchemaActAs extends sfDoctrineSchemaElement
{
  public function toArray()
  {
    return end($this->_data);
  }
}