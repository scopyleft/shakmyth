<?php
class sfDoctrineSchemaColumn extends sfDoctrineSchemaElement
{
  protected $_template = array(
      'type'          => 'string',
      'name'          => '',
      'length'        => 255,
      'primary'       => false,
      'autoincrement' => false,
      'fixed'         => false,
      'sequence'      => false,
      'default'       => '',
      'values'        => array()
    );
}