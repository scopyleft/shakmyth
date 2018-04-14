<?php

/**
 * news actions.
 *
 * @package    shakmyth
 * @subpackage news
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsActions extends sfActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->news = $this->getRoute()->getObject();

    $this->forward404Unless($this->news, "no-news");
    $this->forward404Unless($this->news->getIsActive(), "no-active");
    
    $this->content = $this->news->get('content');
    
    if($query = $this->getUser()->getAttribute('query'))
    {
      $this->content = Search::adaptContentWithQuery($this->content, $query);
    }
  }

  public function executeList(sfWebRequest $request)
  {
		$this->news = Doctrine::getTable('News')->getNewsByActive();
		$this->title = Doctrine::getTable('Page')->getTitleBySPecialPage('news_list');
	}
}
