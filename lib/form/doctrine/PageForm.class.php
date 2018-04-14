<?php

/**
 * Page form.
 *
 * @package    form
 * @subpackage Page
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class PageForm extends BasePageForm
{
  public function configure()
  {    
	  $left_nav_file = sfConfig::get('sf_config_dir')."/left-nav.yml";
		$items = sfYaml::load($left_nav_file);
		$special_pages = sfConfig::get('app_pages_special');
		
		// add empty value on select top
		array_unshift($special_pages, '');
		array_unshift($items['items'], '');

		$this->widgetSchema['heading' ] = new sfWidgetFormChoice(array('choices' => $items['items']));
		$this->widgetSchema['special_page' ] = new sfWidgetFormChoice(array('choices' => 	$special_pages));

		/*
			TODO rigth validator
		*/
		// this->validatorSchema['heading' ] = new sfValidatorChoice(array('choices' => array($items['items'])));
		$this->validatorSchema['heading' ] = new sfValidatorString();
		$this->validatorSchema['special_page' ] = new sfValidatorString();
  }  
}