<?php
abstract class BasesfDoctrineSchemaForm extends sfForm
{
  protected
    $_requiredFields = array();

  public function configure()
  {  
    parent::configure();
    foreach ($this->_requiredFields as $field)
    {
      $this->validatorSchema[$field]->setOption('required', true);
    }
  }

  public function getWidgetForActAs($name, $value, $options, $attributes)
  {
    switch ($name)
    {
      case 'type':
        return new sfWidgetFormDoctrineSchemaColumnType($options, $attributes);
      break;
      default:
        return $this->getWidgetForAttribute($name, $value, $options, $attributes);
    }
  }

  public function getWidgetForColumn($name, $value, $options, $attributes)
  {
    switch ($name)
    {
      case 'primary':
      case 'autoincrement':
      case 'fixed':
      case 'sequence':
        $opts = $options;
        $opts['choices'] = array(1 => 'Yes', 0 => 'No');
        return new sfWidgetFormSelectRadio($opts, $attributes);
      break;
      case 'type':
        return new sfWidgetFormDoctrineSchemaColumnType($options, $attributes);
      break;
    }
  }

  public function getWidgetForIndex($name, $value, $options, $attributes)
  {
    switch ($name)
    {
      case 'type':
        return new sfWidgetFormChoice(array('choices' => array('' => '', 'unique' => 'Unique')));
      break;
    }
  }

  public function getWidgetForAttribute($name, $value, $options, $attributes)
  {
    $type = gettype($value);
    switch ($value)
    {
      case 'boolean':
        $opts = $options;
        $opts['choices'] = array(1 => 'Yes', 0 => 'No');
        return new sfWidgetFormSelectRadio($opts, $attributes);
      break;
    }
  }

  public function getWidgetForRelation($name, $value, $options, $attributes)
  {
    switch ($name)
    {
      case 'type':
      case 'foreignType':
        return new sfWidgetFormChoice(array('choices' => array(0 => 'One', 1 => 'Many')));
      break;
      case 'class':
        $schema = sfContext::getInstance()->getUser()->getAttribute('doctrine_schema_manager')->getSchema();
        $classes = array();
        foreach ($schema as $className => $class)
        {
          $name = $class->isPlugin() ? 'Plugin Models':'Project Models';
          $classes[$name][$className] = $className;
        }
        return new sfWidgetFormChoice(array('choices' => $classes));
      break;
    }
  }

  public function getWidgetForElement($element, $name, $value, $options = array(), $attributes = array())
  {
    $function = 'getWidgetFor' . ucfirst($element);
    if (method_exists($this, $function))
    {
      $widgetClass = $this->$function($name, $value, $options, $attributes);
    }
    if (!isset($widgetClass))
    {
      $widgetClass = new sfWidgetFormInput($options, $attributes);
    }
    return $widgetClass;
  }

  public function getValidatorForElement($element, $name, $value, $options = array(), $messages = array())
  {
    $function = 'getValidatorFor' . ucfirst($element);
    if (method_exists($this, $function))
    {
      $validatorClass = $this->$function($name, $value, $options, $attributes);
    }
    if (!isset($validatorClass))
    {
      $validatorClass = new sfValidatorString($options, $messages);
    }
    return $validatorClass;
  }
}