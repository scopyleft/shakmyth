<?php
class sfValidatorDoctrineSchemaColumnType extends sfValidatorBase
{
  public function __construct($options = array(), $attributes = array())
  {
    $options['choices'] = sfWidgetFormDoctrineSchemaColumnType::getTypeChoices();
    parent::__construct($options, $attributes);
  }
}