<?php

/**
 * Profile filter form base class.
 *
 * @package    shakmyth
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'first_name'       => new sfWidgetFormFilterInput(),
      'last_name'        => new sfWidgetFormFilterInput(),
      'biography'        => new sfWidgetFormFilterInput(),
      'photo'            => new sfWidgetFormFilterInput(),
      'myths_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Myth')),
    ));

    $this->setValidators(array(
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'first_name'       => new sfValidatorPass(array('required' => false)),
      'last_name'        => new sfValidatorPass(array('required' => false)),
      'biography'        => new sfValidatorPass(array('required' => false)),
      'photo'            => new sfValidatorPass(array('required' => false)),
      'myths_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Myth', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addMythsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.ContributorMyth ContributorMyth')
          ->andWhereIn('ContributorMyth.myth_id', $values);
  }

  public function getModelName()
  {
    return 'Profile';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'sf_guard_user_id' => 'ForeignKey',
      'first_name'       => 'Text',
      'last_name'        => 'Text',
      'biography'        => 'Text',
      'photo'            => 'Text',
      'myths_list'       => 'ManyKey',
    );
  }
}
