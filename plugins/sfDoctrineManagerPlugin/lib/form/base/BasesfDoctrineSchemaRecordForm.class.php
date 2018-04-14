<?php
abstract class BasesfDoctrineSchemaRecordForm extends sfDoctrineSchemaForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'abstract'    => new sfWidgetFormInputCheckbox(),
      'className'   => new sfWidgetFormInput(array('label' => 'Class Name')),
      'tableName'   => new sfWidgetFormInput(array('label' => 'Table Name')),
      'connection'  => new sfWidgetFormChoice(array('choices' => $this->getConnectionChoices())),
    ));

    $this->setValidators(array(
      'abstract'    => new sfValidatorBoolean(),
      'className'   => new sfValidatorString(array('required' => true)),
      'tableName'   => new sfValidatorString(array('required' => false)),
      'connection'  => new sfValidatorChoice(array('required' => false, 'choices' => $this->getConnectionChoices())),
    ));

    $this->widgetSchema->setNameFormat('record[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getConnectionChoices()
  {
    $choices = array('' => '');
    foreach (Doctrine_Manager::getInstance() as $name => $conn)
    {
      $choices[$name] = $name;
    }
    return $choices;
  }

  public function getTypeChoices()
  {
    $options = array();
    $options['mysql']['INNODB'] = 'INNODB';
    $options['mysql']['MyISAM'] = 'MyISAM';
    return $options;
  }
}