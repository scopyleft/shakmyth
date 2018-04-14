<?php

/**
 * sfGuardUser form.
 *
 * @package    form
 * @subpackage sfGuardUser
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
    if (!sfContext::getInstance()->getUser()->hasCredential('admin'))
    { 
      unset($this->widgetSchema['groups_list']);
      unset($this->widgetSchema['permissions_list']);              
    }
  }
}