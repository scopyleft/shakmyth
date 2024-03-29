<?php

require_once dirname(__FILE__).'/../lib/pageGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pageGeneratorHelper.class.php';

/**
 * page actions.
 *
 * @package    shakmyth
 * @subpackage page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class pageActions extends autoPageActions
{ 
  public function executeBatchActived(sfWebRequest $request)
  {
    $this->toogleActive(true);
  }

  public function executeBatchInactived(sfWebRequest $request)
  {
    $this->toogleActive(false);
  }

  private function toogleActive($state = true)
  {
    $ids = $this->request->getParameter('ids');

    $q = Doctrine_Query::create()
      ->from('Page p')
      ->whereIn('p.id', $ids);

    foreach ($q->execute() as $myth_page)
    {
      $myth_page->setIsActive($state);
      $myth_page->save();
    }

    $state_title = ($state) ? 'actived': 'inactived'; 
    $this->getUser()->setFlash('notice', 'All selected pages have been '.$state_title.' successfully.');
    $this->redirect('@myth_page');
  }
}
