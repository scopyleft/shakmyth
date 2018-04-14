<?php

/**
 * contributors components.
 *
 * @package    shakmyth
 * @subpackage contributors
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
 
class contributorsComponents extends sfComponents
{
  public function executeContributor()
  {     
		$this->photo = Tools::slugify($this->contributor->getLastName()) . ".jpg";
		
		if (!is_file(sfConfig::get('sf_upload_dir') . '/identities/' . $this->photo)) 
		{
			$this->photo= "avatar.gif";
		}
		
		$this->contributor_link = '#';
		
		if($this->contributor->getBiography())
		{
			$this->contributor_link = url_for('@contributor_show?id='. $this->contributor->getId() . 
																						"&last_name=".strtolower($this->contributor->getLastName()));
		}
  }
}