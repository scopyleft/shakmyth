<?php

/**
 * Myth form.
 *
 * @package    form
 * @subpackage Myth
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class MythForm extends BaseMythForm
{
  public function configure()
  {
    unset($this->widgetSchema['is_active']);
    
    $this->widgetSchema['profiles_list'] = new sfUoWidgetFormDoctrineSelectMany(array(
      'model' => 'Profile',
      'js_transformer'=>'asm',
      'js_config' => array('removeLabel' => 'x'),
      ));
  }
}