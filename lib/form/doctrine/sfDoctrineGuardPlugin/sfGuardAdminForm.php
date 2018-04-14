<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package form
 * @package sf_guard_user
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  public function configure()
  {
    parent::configure();

    $profileForm = new ProfileForm($this->object->Profile);
    unset($profileForm['id'], $profileForm['sf_guard_user_id']);
    
    $this->widgetSchema['is_super_admin'] = new sfWidgetFormInputHidden();
    
    if (!sfContext::getInstance()->getUser()->hasCredential('admin'))
    {
      $this->widgetSchema['is_active'] = new sfWidgetFormInputHidden();     
    } 
    
    $this->embedForm('Profile', $profileForm);
    
    // special features for edit mode
    if (!is_null($this->getObject()->getId()))
    {   
      // read-only substitute : display a uniq category
      $this->widgetSchema['username'] = new sfWidgetFormChoice(array(
         'choices' => array($this->getObject()->getUserName() => $this->getObject()->getUserName()),
      ));
    } 
  }
}