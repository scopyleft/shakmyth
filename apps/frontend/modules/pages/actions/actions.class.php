<?php

/**
 * pages actions.
 *
 * @package    shakmyth
 * @subpackage pages
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class pagesActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->page = $this->getRoute()->getObject();

    $this->forward404Unless($this->page, "no-page");
    $this->forward404Unless($this->page->getIsActive(), "no-active");
    
    $this->content = $this->page->get('content');
    /* buggy (highlight attributes content)
    if($query = $this->getUser()->getAttribute('query'))
    {
      $this->content = Search::adaptContentWithQuery($this->content, $query);
    }*/
  }

  public function executeIndex()
  {	
		$this->page = Doctrine::getTable('Page')->findOneBySpecialPage('home_page');
		$this->forward404Unless($this->page, "no-home-page");
		
		$this->content = $this->page->get('content');
	}

}
