<?php

/**
 * Page filter form base class.
 *
 * @package    shakmyth
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BasePageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'heading'      => new sfWidgetFormChoice(array('choices' => array('' => ''))),
      'priority'     => new sfWidgetFormFilterInput(),
      'special_page' => new sfWidgetFormChoice(array('choices' => array('' => ''))),
      'title'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'content'      => new sfWidgetFormFilterInput(),
      'is_active'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'heading'      => new sfValidatorChoice(array('required' => false, 'choices' => array('' => ''))),
      'priority'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'special_page' => new sfValidatorChoice(array('required' => false, 'choices' => array('' => ''))),
      'title'        => new sfValidatorPass(array('required' => false)),
      'content'      => new sfValidatorPass(array('required' => false)),
      'is_active'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('page_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Page';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'heading'      => 'Enum',
      'priority'     => 'Number',
      'special_page' => 'Enum',
      'title'        => 'Text',
      'content'      => 'Text',
      'is_active'    => 'Boolean',
    );
  }
}
