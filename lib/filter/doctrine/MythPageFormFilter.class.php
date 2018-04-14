<?php

/**
 * MythPage filter form.
 *
 * @package    filters
 * @subpackage MythPage *
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class MythPageFormFilter extends BaseMythPageFormFilter
{
  public function configure()
  {
		$this->widgetSchema['myth_id']->setOption('order_by', array('name', 'asc')); 
			
    if (sfContext::getInstance()->getUser()->hasCredential('contributor') && !sfContext::getInstance()->getUser()->isSuperAdmin()) 
    {
      unset($this->widgetSchema['is_active']);
      
      $choices = Doctrine::getTable('Myth')->createWidgetChoicesWithProfileId(sfContext::getInstance()->getUser()->getProfile()->getId(), $is_active = false);
      
      $this->widgetSchema['myth_id'] = new sfWidgetFormChoice(array('choices' => $choices));
    }
  }
}

  