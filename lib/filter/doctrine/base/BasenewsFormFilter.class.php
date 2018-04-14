<?php

/**
 * News filter form base class.
 *
 * @package    shakmyth
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseNewsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'priority'  => new sfWidgetFormFilterInput(),
      'title'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'summary'   => new sfWidgetFormFilterInput(),
      'content'   => new sfWidgetFormFilterInput(),
      'is_active' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'priority'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'title'     => new sfValidatorPass(array('required' => false)),
      'summary'   => new sfValidatorPass(array('required' => false)),
      'content'   => new sfValidatorPass(array('required' => false)),
      'is_active' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('news_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'News';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'priority'  => 'Number',
      'title'     => 'Text',
      'summary'   => 'Text',
      'content'   => 'Text',
      'is_active' => 'Boolean',
    );
  }
}
