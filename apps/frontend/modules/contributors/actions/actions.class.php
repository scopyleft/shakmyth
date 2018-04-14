<?php

/**
 * contributors actions.
 *
 * @package    shakmyth
 * @subpackage contributors
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class contributorsActions extends sfActions
{  
  public function executeList(sfWebRequest $request)
  { 
    $this->contributors = Doctrine::getTable('profile')->getActiveContributors();
    $this->forward404Unless($this->contributors, "no-contributor");

		// dynamic Title
		$this->title = Doctrine::getTable('Page')->getTitleBySPecialPage('contributor_list');
  }

  public function executeShow(sfWebRequest $request)
  {    
    $this->profile = $this->getRoute()->getObject();
    $this->myths = Doctrine::getTable('Profile')->getMythsById($this->profile->getId(), $is_active = true);
    
    $this->forward404Unless($this->getUser()->is_inGroup($this->profile), "no-contributor");
    $this->forward404Unless($this->profile->getUser()->getIsActive(), "no-active");
    
    $this->biography = $this->profile->get('biography');
    
    if($query = $this->getUser()->getAttribute('query'))
    {
      $this->biography = Search::adaptContentWithQuery($this->biography, $query);
    }
  }
}
