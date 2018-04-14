<?php

/**
 * ContributorMyth form base class.
 *
 * @method ContributorMyth getObject() Returns the current form's model object
 *
 * @package    shakmyth
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseContributorMythForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'profile_id' => new sfWidgetFormInputHidden(),
      'myth_id'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'profile_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'profile_id', 'required' => false)),
      'myth_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'myth_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contributor_myth[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContributorMyth';
  }

}
