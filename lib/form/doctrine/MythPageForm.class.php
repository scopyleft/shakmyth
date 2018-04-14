<?php

/**
 * MythPage form.
 *
 * @package    form
 * @subpackage MythPage
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class MythPageForm extends BaseMythPageForm
{
  public function configure()
  {
    if (sfContext::getInstance()->getUser()->hasCredential('contributor') && !sfContext::getInstance()->getUser()->isSuperAdmin())
    {
      unset($this->widgetSchema['is_active']);
    } 
    
    $this->widgetSchema['myth_id']->setOption('add_empty', true);
		$this->widgetSchema['myth_id']->setOption('order_by', array('name', 'asc')); 
			
    // modify select with myth context in edit mode
    if (!is_null($this->getObject()->getId()))
    {   
      // read-only substitute : display a uniq category
      // TODO: in one line
      $choices = $this->widgetSchema['myth_id']->getChoices(); 
      $this->widgetSchema['myth_id'] = new sfWidgetFormChoice(array(
         'choices' => array(
           $this->getObject()->getMythId() => $choices[$this->getObject()->getMythId()]),
         ));
         
      $choices = $this->widgetSchema['myth_category']->getChoices();  
      $this->widgetSchema['myth_category'] = new sfWidgetFormChoice(array(
         'choices' => array(
           $this->getObject()->getMythCategory() => $choices[$this->getObject()->getMythCategory()]),
         ));
    }
  }
} 