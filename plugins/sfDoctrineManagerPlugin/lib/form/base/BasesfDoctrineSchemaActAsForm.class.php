<?php
abstract class BasesfDoctrineSchemaActAsForm extends sfDoctrineSchemaForm
{
  public function configure()
  {
    $allBehaviors = $this->getBehaviors();
    $allBehaviorChoices = !empty($allBehaviors) ? array_combine(array_values($allBehaviors), array_values($allBehaviors)):array();
    $defaults = $this->getDefaults();

    $enabledBehaviors = array();
    foreach ($defaults as $name => $info)
    {
      if (isset($defaults[$name]) && ($defaults[$name] == 'on' || is_array($defaults[$name])))
      {
        $enabledBehaviors[$name] = $name;
        $defaults[$name] = $info;
      } else {
        unset($defaults[$name]);
      }
    }
    $this->setDefaults($defaults);

    foreach ($allBehaviors as $className => $name)
    {
      $instance = new $className();

      $options = array();
      if (isset($enabledBehaviors[$name]))
      {
        $existingOptions = (array) $defaults[$name];
        $options = $instance->getOptions();
        $options = !empty($options) ? array_merge($options, $existingOptions):array();
      }

      $this->widgetSchema[$name] = new sfWidgetFormInputCheckbox();
      $this->validatorSchema[$name] = new sfValidatorBoolean();

      if (!empty($options))
      {
        $optionsForm = new sfDoctrineSchemaActAsOptions($options);
        $this->embedForm($name, $optionsForm);
      }
    }

    $this->widgetSchema->setNameFormat('record[actAs][%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getBehaviors()
  {
    $behaviors = array();
    $templates = glob(Doctrine::getPath() . '/Doctrine/Template/*.php');
    foreach ($templates as $template)
    {
      $info = pathinfo($template);
      $name = $info['filename'];
      $className = 'Doctrine_Template_' . $name;
      $code = 'class Mock_' . $className . ' extends ' . $className . '
{
  public function getOptions()
  {
    $options = array();
    $vars = get_class_vars(get_class($this));
    if (isset($vars[\'_options\']))
    {
      $options = $vars[\'_options\'];
    }
    $className = get_class($this->_plugin);
    if ($className)
    {
      $instance = new $className(array());
      $options = $instance->getOptions();
    }
    return $this->clean($options);
  }

  public function clean($options)
  {
    foreach ($options as $key => $value)
    {
      if (is_object($value))
      {
        unset($options[$key]);
      }
    }
    return $options;
  }

  public function contains($key)
  {
    return true;
  }
}';
      eval($code);
      $behaviors['Mock_' . $className] = $name;
    }
    return $behaviors;
  }
}