<?php

require_once sfConfig::get('app_sfGuardUserModuleLib_dir').'/BasesfGuardUserActions.class.php';
require_once sfConfig::get('app_sfGuardUserModuleLib_dir').'/sfGuardUserGeneratorConfiguration.class.php';
require_once sfConfig::get('app_sfGuardUserModuleLib_dir').'/sfGuardUserGeneratorHelper.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 12896 2008-11-10 19:02:34Z fabien $
 */
class sfGuardUserActions extends BasesfGuardUserActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if (!sfContext::getInstance()->getUser()->hasCredential('admin'))
    {
      $this->redirectToEditMyProfile(); 
    }
    
    parent::executeIndex($request);
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    // be sure a contributor can consult only his profile
    if ($this->getUser()->hasCredential('contributor') 
        && $request->getParameter('id') !== $this->getUser()->getGuardUser()->getId()
        && !$this->getUser()->isSuperAdmin())
    {
      $this->redirectToEditMyProfile();
    } 
    
    parent::executeEdit($request);
  }
  
  private function redirectToEditMyProfile()
  {
    $this->redirect('@sf_guard_user_edit?id='.$this->getUser()->getGuardUser()->getId());      
  }
}
