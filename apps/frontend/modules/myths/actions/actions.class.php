<?php

/**
 * myth actions.
 *
 * @package    shakmyth
 * @subpackage myth
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class mythsActions extends sfActions
{
  public function executeList(sfWebRequest $request)
  {   
    $this->getUser()->addLetterChoice($request->getParameter('letter_choice'));
    $this->myths = Doctrine::getTable('Myth')->getMythsWithFirstLetter($this->getUser()->getAttribute('letter_choice'), $is_active = TRUE); 
  }

  public function executeShow(sfWebRequest $request)
  { 
    $request->getParameter('myth_category') ? $category = $request->getParameter('myth_category') : $category = null ;
    $this->myth_page = Doctrine::getTable('MythPage')->getOneWithCategoryAndMyth($request->getParameter('myth_id'), $category, $is_active = TRUE);
    $request->getParameter('myth_category') ? $category = $request->getParameter('myth_category') : $category = null ;
    $this->categories = Doctrine::getTable('MythPage')->getCategoriesByMythId($request->getParameter('myth_id'), $is_active = TRUE);
    $this->contributors = Doctrine::getTable('Profile')->getProfilesByMythId($request->getParameter('myth_id'), $is_active = TRUE); 
   
    $this->forward404Unless($this->myth_page, 'no_myth');
    
/*
	TODO 
*/
$part1 = preg_replace('~[^\\pL\d]+~u', '-', $this->myth_page->getMythName());
$part2 = preg_replace('~[^\\pL\d]+~u', '-', $this->myth_page->get('myth_category'));

$this->pdf_name = $this->content = $part1 ."_". $part2 .".pdf";

if (!is_file(sfConfig::get("sf_upload_dir") . '/' . $this->pdf_name)) {
	$this->pdf_name = false;
}


    $this->content = $this->myth_page->get('content');
    
    if($query = $this->getUser()->getAttribute('query'))
    {
      $this->content = Search::adaptContentWithQuery($this->content, $query);
    }
  }
}
