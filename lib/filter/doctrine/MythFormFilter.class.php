<?php

/**
 * Myth filter form.
 *
 * @package    filters
 * @subpackage Myth *
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class MythFormFilter extends BaseMythFormFilter
{
  public function configure()
  {
    $this->widgetSchema['profiles_list'] = new sfUoWidgetFormDoctrineSelectMany(array(
      'model' => 'Profile',
      'js_transformer' => 'asm',
      'js_config' => array('removeLabel' => 'x'),
    ));
  }
}