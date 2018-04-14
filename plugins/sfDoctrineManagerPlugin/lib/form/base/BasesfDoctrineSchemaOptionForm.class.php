<?php
abstract class BasesfDoctrineSchemaOptionForm extends sfDoctrineSchemaForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'collate'     => new sfWidgetFormInput(),
      'charset'     => new sfWidgetFormInput(),
      'type'        => new sfWidgetFormChoice(array('multiple' => false, 'choices' => $this->getTypeChoices())),
    ));

    $this->setValidators(array(
      'collate'     => new sfValidatorString(array('required' => false)),
      'charset'     => new sfValidatorString(array('required' => false)),
      'type'        => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($this->getTypeChoices()))),
    ));

    $this->widgetSchema->setNameFormat('table[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getTypeChoices()
  {
    $options = array();
    $options['INNODB'] = 'INNODB';
    $options['MyISAM'] = 'MyISAM';
    return $options;
  }
}