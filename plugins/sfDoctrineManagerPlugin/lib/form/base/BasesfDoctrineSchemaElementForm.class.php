<?php
abstract class BasesfDoctrineSchemaElementForm extends sfDoctrineSchemaForm
{
  protected $_single = false;

  public function __construct($defaults = array(), $options = array(), $CSRFSecret = null, $single = false)
  {
    $this->_single = $single;
    parent::__construct($defaults, $options, $CSRFSecret);
  }

  public function configure()
  {
    $data = $this->getDefaults();

    if (!$this->_single)
    {
      $this->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
      $this->validatorSchema['delete'] = new sfValidatorBoolean(array('required' => false));
    }

    $className = get_class($this);
    $elementName = strtolower(substr($className, 16, strlen($className) - 20));
    $elementClassName = 'sfDoctrineSchema' . ucfirst($elementName);
    $template = call_user_func_array(array(new $elementClassName(array(), array()), 'getTemplate'), array());

    foreach ($data as $key => $value)
    {
      if ($value === null)
      {
        $data[$key] = $template[$key];
      }
    }
    $this->setDefaults($data);
    foreach ($template as $name => $value)
    {
      $this->widgetSchema[$name] = $this->getWidgetForElement($elementName, $name, $value);
      $this->validatorSchema[$name] = $this->getValidatorForElement($elementName, $name, $value, array('required' => false));
    }

    $this->widgetSchema->setNameFormat($elementName . '[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    parent::configure();
    parent::setup();
  }
}