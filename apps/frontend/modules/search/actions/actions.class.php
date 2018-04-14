<?php

/**
 * search actions.
 *
 * @package    shakmyth
 * @subpackage search
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class searchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  private $modules = array(
      array('table' => 'MythPage', 'module' => 'myths', 'key' => 'myth_pages'),
      array('table' =>'Page', 'module' => 'pages', 'key' => 'pages'),
      array('table' => 'Profile', 'module' => 'contributors', 'key' => 'contributors'),
    );
  
  public function executeIndex(sfWebRequest $request)
  {
    $this->count_results = 0;
    $this->results = array();
    $this->modules_t = array(); // send properties to template
    if($request->hasParameter('clear_x'))
    {
      $this->getUser()->setAttribute('query', null);
      return $this->redirect($request->getReferer());
    }
    $query = $request->getParameter('query');
    if (!$query) // no query, no match
    {
      return sfView::ERROR;
    }
    
    foreach ($this->modules as $module) 
    {
       $result = Doctrine::getTable($module['table'])->getBySearch($query);
       
       if ($result->count())
       {
          $this->count_results += $result->count();
          $this->modules_t[] = $module;
          $this->results[$module['key']] = $result;
       }
    }

    if ($this->count_results === 0) // no result, no match
    {
      return sfView::ERROR;
    }
    
    $this->getUser()->setAttribute('query', $query);
  }
}
