<?php
class sfWidgetFormDoctrineSchemaColumnType extends sfWidgetFormChoice
{
  protected static $_choices = array(
      'array'     => 'Array',
      'blob'      => 'Blob',
      'boolean'   => 'Checkbox',
      'clob'      => 'Clob',
      'date'      => 'Date',
      'enum'      => 'Enum',
      'integer'   => 'Integer',
      'object'    => 'Object',
      'string'    => 'String',
      'timestamp' => 'Timestamp'
    );

  public function __construct($options = array(), $attributes = array())
  {
    $options['choices'] = self::getTypeChoices();
    parent::__construct($options, $attributes);
  }

  public static function getTypeChoices()
  {
    return self::$_choices;
  }
}