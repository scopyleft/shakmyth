<?php

/**
 * pages actions.
 *
 * @package    shakmyth
 * @subpackage pages
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
 
class mythsComponents extends sfComponents
{
  public function executeDicentries(sfWebRequest $request)
  {     
    $this->letters = Doctrine::getTable('Myth')->getLettersAndMythCount($is_active = TRUE);
		$this->title = Doctrine::getTable('Page')->getTitleBySPecialPage('myth_list');
  }
}