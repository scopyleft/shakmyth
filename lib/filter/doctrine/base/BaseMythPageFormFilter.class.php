<?php

/**
 * MythPage filter form base class.
 *
 * @package    shakmyth
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseMythPageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'myth_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Myth'), 'add_empty' => true)),
      'myth_category' => new sfWidgetFormChoice(array('choices' => array('' => '', 'brief presentation' => 'brief presentation', 'classical sources' => 'classical sources', 'some secondary sources' => 'some secondary sources', 'occurrences in Shakespeare' => 'occurrences in Shakespeare', 'some contemporary references' => 'some contemporary references', 'analysis' => 'analysis', 'selected bibliography' => 'selected bibliography', 'iconography' => 'iconography'))),
      'content'       => new sfWidgetFormFilterInput(),
      'is_active'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'myth_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Myth'), 'column' => 'id')),
      'myth_category' => new sfValidatorChoice(array('required' => false, 'choices' => array('' => '', 'brief presentation' => 'brief presentation', 'classical sources' => 'classical sources', 'some secondary sources' => 'some secondary sources', 'occurrences in Shakespeare' => 'occurrences in Shakespeare', 'some contemporary references' => 'some contemporary references', 'analysis' => 'analysis', 'selected bibliography' => 'selected bibliography', 'iconography' => 'iconography'))),
      'content'       => new sfValidatorPass(array('required' => false)),
      'is_active'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('myth_page_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MythPage';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'myth_id'       => 'ForeignKey',
      'myth_category' => 'Enum',
      'content'       => 'Text',
      'is_active'     => 'Boolean',
    );
  }
}
