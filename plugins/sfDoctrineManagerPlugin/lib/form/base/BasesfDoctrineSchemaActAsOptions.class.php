<?php
abstract class BasesfDocttrineSchemaActAsOptions extends sfDoctrineSchemaForm
{
  protected $_child = false;

  public function __construct($defaults = array(), $options = array(), $CSRFSecret = null, $child = false)
  {
    $this->_child = $child;
    parent::__construct($defaults, $options, $CSRFSecret);
  }

  public function configure()
  {
    $defaults = $this->getDefaults();
    if (!$this->_child)
    {
      $this->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
      $this->validatorSchema['delete'] = new sfValidatorBoolean();
    }

    $this->_embedOptionsForms($defaults);
  }

  protected function _embedOptionsForms($data)
  {
    foreach ($data as $key => $value)
    {
      if (is_array($value) && $key == 'builder' && isset($data['uniqueBy']) && isset($data['uniqueIndex']))
      {
        $value = array(1 => $value[0], $value[1]);
      }

      if (is_array($value))
      {
        $this->_embedOptionsForm($key, $value);
      }
      else
      {
        $this->_embedOptionsWidget($key, $value);
      }
    }
  }

  protected function _embedOptionsForm($name, $data)
  {
    $form = new sfDoctrineSchemaActAsOptions($data, array(), null, true);
    $form->child = true;
    $this->embedForm($name, $form);
  }

  protected function _embedOptionsWidget($name, $data)
  {
    $this->widgetSchema[$name] = $this->getWidgetForElement('actAs', $name, $data);
    $this->validatorSchema[$name] = $this->getValidatorForElement('actAs', $name, $data, array('required' => false));
  }
}