<?php

require_once dirname(__FILE__).'/../lib/myth_pageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/myth_pageGeneratorHelper.class.php';

/**
 * myth_page actions.
 *
 * @package    shakmyth
 * @subpackage myth_page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class myth_pageActions extends autoMyth_pageActions
{
  protected function buildQuery()
  {  
    $q = parent::buildQuery();
        
    if (!sfContext::getInstance()->getUser()->hasCredential('admin'))
    {
      $myths_ids = array(); 

      $myths = Doctrine::getTable('Profile')->getMythsById($this->getUser()->getProfile()->getId(), $is_active = false); 
      
      if (!is_null($myths)) 
      {
        foreach ($myths as $myth) 
        {
          $myths_ids[] = (int)$myth->getId(); 
        }
      } 
      else
      {
        return $q;
      }
      
      $q->WhereIn('myth_id', $myths_ids);  
    }

    return $q;
  }
  
  public function executeBatchActived(sfWebRequest $request)
  {
    $this->toogleActive(true);
  }
  
  public function executeBatchInactived(sfWebRequest $request)
  {
    $this->toogleActive(false);
  }
  
  private function toogleActive($is_active = false)
  {
    Doctrine::getTable('MythPage')->batchActivedCollection($this->request->getParameter('ids'), $is_active);
 
    $state_title = ($is_active) ? 'actived': 'inactived'; 
    $this->getUser()->setFlash('notice', 'All selected myth-pages have been '.$state_title.' successfully.');
    $this->redirect('@myth_page');
  }
  
  public function executeAjaxMythCategory(sfWebRequest $request)
  {
    $object = new MythPage();
    $object->setMythId($request->getParameter('myth_id'));

    return $this->renderPartial('ajaxMythCategory', array('myth_categories' => Doctrine::getTable("MythPage")->getFreeCategoriesChoices($object)));
  }
}
