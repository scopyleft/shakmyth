<?php

/**
 * MythPageIndex filter form base class.
 *
 * @package    shakmyth
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24051 2009-11-16 21:08:08Z Kris.Wallsmith $
 */
abstract class BaseMythPageIndexFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('myth_page_index_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MythPageIndex';
  }

  public function getFields()
  {
    return array(
      'keyword'  => 'Text',
      'field'    => 'Text',
      'position' => 'Number',
      'id'       => 'Number',
    );
  }
}
