<?php

/**
 * menu actions.
 *
 * @package    shakmyth
 * @subpackage menu
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class menuActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
	public function executeIndex(sfWebRequest $request)
	{
		$left_nav_file = sfConfig::get('app_left_nav_items_file');

		if ($request->isMethod('post'))
		{
			$left_nav_items = array("items" => array(
			  'item1' => $request->getParameter('item1'),
			  'item2' => $request->getParameter('item2'),
			  'item3' => $request->getParameter('item3'),
			  'item4' => $request->getParameter('item4'),
			  'item5' => $request->getParameter('item5'),
			  'item6' => $request->getParameter('item6'),
			  'item7' => $request->getParameter('item7'),
			  'item8' => $request->getParameter('item8'),
			  'item9' => $request->getParameter('item9'),
			  'item10' => $request->getParameter('item10'),
			  'item11' => $request->getParameter('item11'),
			));

		file_put_contents($left_nav_file, sfYAML::dump($left_nav_items));
		}

		$this->form = new LeftNavForm();
	}
}
