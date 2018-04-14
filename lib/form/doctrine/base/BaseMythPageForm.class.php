<?php

/**
 * MythPage form base class.
 *
 * @method MythPage getObject() Returns the current form's model object
 *
 * @package    shakmyth
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseMythPageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'myth_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Myth'), 'add_empty' => false)),
      'myth_category' => new sfWidgetFormChoice(array('choices' => array('' => '', 'brief presentation' => 'brief presentation', 'classical sources' => 'classical sources', 'some secondary sources' => 'some secondary sources', 'occurrences in Shakespeare' => 'occurrences in Shakespeare', 'some contemporary references' => 'some contemporary references', 'analysis' => 'analysis', 'selected bibliography' => 'selected bibliography', 'iconography' => 'iconography'))),
      'content'       => new sfWidgetFormTextarea(),
      'is_active'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'myth_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Myth'))),
      'myth_category' => new sfValidatorChoice(array('choices' => array('' => '', 'brief presentation' => 'brief presentation', 'classical sources' => 'classical sources', 'some secondary sources' => 'some secondary sources', 'occurrences in Shakespeare' => 'occurrences in Shakespeare', 'some contemporary references' => 'some contemporary references', 'analysis' => 'analysis', 'selected bibliography' => 'selected bibliography', 'iconography' => 'iconography'), 'required' => false)),
      'content'       => new sfValidatorString(array('required' => false)),
      'is_active'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('myth_page[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MythPage';
  }

}
