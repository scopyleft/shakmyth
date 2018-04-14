<?php

/**
 * sfGuardUser filter form.
 *
 * @package    filters
 * @subpackage sfGuardUser *
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class sfGuardUserFormFilter extends PluginsfGuardUserFormFilter
{
  public function configure()
  {
      $this->widgetSchema['myths_list'] = new sfUoWidgetFormDoctrineSelectMany(array(
      'model' => 'Myth',
      'js_transformer'=>'asm',
      'js_config' => array('removeLabel' => 'x'),
      ));
  }
}