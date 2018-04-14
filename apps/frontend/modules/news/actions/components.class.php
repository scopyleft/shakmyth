<?php

/**
 * pages actions.
 *
 * @package    shakmyth
 * @subpackage pages
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
 
class newsComponents extends sfComponents
{
  public function executeThirdColumn()
  {	
		$this->news = Doctrine::getTable('News')->getNewsByActive();
	}
}