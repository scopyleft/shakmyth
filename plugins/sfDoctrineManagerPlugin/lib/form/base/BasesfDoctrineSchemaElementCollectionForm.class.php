<?php
abstract class BasesfDoctrineSchemaElementCollectionForm extends sfDoctrineSchemaForm
{
  public function configure()
  {
    $className = get_class($this);
    $elementName = strtolower(substr($className, 16, strlen($className) - 30));

    $handlers = sfDoctrineSchemaManager::getHandlers();
    $className = 'sfDoctrineSchema' . ucfirst($elementName) . 'Form';

    $data = $this->getDefaults();
    foreach ($data as $name => $value)
    {
      $form = new $className($value, array(), array(), false);
      $this->embedForm($name, $form);
    }

    $handler = array_search(ucfirst($elementName), $handlers);
    $this->widgetSchema->setNameFormat('record[' . $handler . '][%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }
}