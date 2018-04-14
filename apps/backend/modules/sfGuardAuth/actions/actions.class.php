<?php

require_once sfConfig::get('app_sfGuardAuthModuleLib_dir').'/BasesfGuardAuthActions.class.php';

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
  public function executeSignout($request)
  {
    if (sfConfig::get('sf_environment') !== 'test')
    {
      session_destroy();
      session_write_close();
      session_regenerate_id();
    }
    
    parent::executeSignout($request);
  }
}
