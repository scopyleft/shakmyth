<?php

/**
 * pages actions.
 *
 * @package    shakmyth
 * @subpackage pages
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class defaultComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAdminNav(sfWebRequest $request)
  {
    $this->menu = new sfUoWidgetAdminMenu(array(
    'js_transformer' => 'drop_down', 
    ));
  }
}
