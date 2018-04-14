<?php

/**
 * Profile form.
 *
 * @package    form
 * @subpackage Profile
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ProfileForm extends BaseProfileForm
{
  public function configure()
  {  
    // $this->widgetSchema['photo'] = new sfWidgetFormInputFileEditable(array(
    //   'file_src'  => sfConfig::get('app_identities_dir').'/'.$this->getObject()->getPhoto(),
    //   'is_image'  => true,
    //   'edit_mode' => !$this->isNew(),
    // ));
    // 
    // $this->validatorSchema['photo'] = new sfValidatorFile(array(
    //   'required'   => false,
    //   'path'       => sfConfig::get('app_identities_dir'),
    //   'mime_types' => 'web_images',
    // ));
    //
    // $this->validatorSchema['photo_delete'] = new sfValidatorPass();

    $this->widgetSchema['photo'] = new sfWidgetFormInputHidden();
		$this->validatorSchema['photo'] = new sfValidatorString(array('required' => false));
    
    $this->widgetSchema['sf_guard_user_id'] = new sfWidgetFormInputHidden();
    /*
    $this->widgetSchema['myths_list'] = new sfUoWidgetFormDoctrineSelectMany(array(
    'model' => 'Myth',
    'js_transformer'=>'asm',
    ));*/

		$this->validatorSchema['first_name']->setOption('required', 'true');
		$this->validatorSchema['last_name']->setOption('required', 'true');
  }
}