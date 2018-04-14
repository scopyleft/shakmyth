<?php

class LeftNavForm extends sfForm
{
  public function configure()
  {
	// identify the file with left menu item 
	$items = leftNav::getItems();
	$widgets = array();
	$validators = array();
	// to increment key index : item1, item2, ...
	$count = 1;
	
	// extract each menu item
	foreach ($items as $item) 
	{
	  // create array sfWidget with current value  	
	  $widgets['item'.$count] = new sfWidgetFormInputText(array(), array('value' => $item));
	
	  // create array validator
	  $validators['item'.$count++] = new sfValidatorString(array('max_length' => 15));
	}
	
	$this->setWidgets($widgets);
    $this->setValidators($validators);
  }
}

