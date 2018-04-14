<?php

/**
 * pages actions.
 *
 * @package    shakmyth
 * @subpackage pages
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
		  if (sfContext::getInstance()->getUser()->hasCredential('admin'))
			{
				$this->setTemplate("admin");
			}
  }
}
