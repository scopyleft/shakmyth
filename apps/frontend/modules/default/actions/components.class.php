<?php

/**
 * pages actions.
 *
 * @package    shakmyth
 * @subpackage pages
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
 
class defaultComponents extends sfComponents
{
  public function executeNav(sfWebRequest $request)
  {     
    $this->nav_contents = sfConfig::get('app_navigation_'.$this->name);
  }
  
  public function executeLeftNav(sfWebRequest $request)
  { 

		$choices = LeftNav::buildLeftNav();

    $this->accordion = new sfUoWidgetContainersList(
      array(
        'choices' => $choices,
        'js_transformer' => 'accordion',
        'title_type'     => 'h5',
        'js_config'      => array('collapsible' => true, 'active' => false, 'clearStyle' => true) // see http://jqueryui.com/demos/accordion/#options for other config
      )
    );
  }
}