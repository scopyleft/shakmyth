<?php
abstract class BasesfDoctrineSchemaAttributeForm extends sfDoctrineSchemaForm
{
  public function configure()
  {
    $defaults = $this->getDefaults();
    $attributes = $this->getAttributes();
    foreach ($attributes as $name => $value)
    {
      $constValue = Doctrine_Manager::getInstance()->getAttribute($name);
      if (!array_key_exists($name, $defaults))
      {
        $defaults[$name] = $constValue;
      }
      if (is_array($value) && count($value) > 1)
      {
        $this->widgetSchema[$name] = new sfWidgetFormChoice(array('choices' => $value));
        $this->validatorSchema[$name] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys($value)));
      } else {
        $this->widgetSchema[$name] = $this->getWidgetForElement('attribute', $name, $constValue);
        $this->validatorSchema[$name] = $this->getValidatorForElement('attribute', $name, $constValue, array('required' => false));
      }
    }
    $this->setDefaults($defaults);

    $this->widgetSchema->setNameFormat('record[attributes][%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getAttributes()
  {
    $attributes = array();
    $reflect = new ReflectionClass('Doctrine');
    $constants = $reflect->getConstants();
    foreach (array_keys($constants) as $constant)
    {
      $constant = strtolower($constant);
      if (substr($constant, 0, 5) == 'attr_')
      {
        $name = strtolower(substr($constant, 5, strlen($constant)));
        $constantValue = Doctrine_Manager::getInstance()->getAttribute($name);
        if (is_object($constantValue))
        {
          continue;
        }
        $attributes[$name] = array('' => '');
        foreach (array_keys($constants) as $c2)
        {
          $c2 = strtolower($c2);
          if (strpos($c2, $name) !== false && $c2 != $constant)
          {
            $value = str_replace($name . '_', '', $c2);
            $attributes[$name][$value] = sfInflector::humanize($value);
          }
        }
        
      }
    }
    return $attributes;
  }
}