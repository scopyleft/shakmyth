<?php
/**
* 
*/
class myTestBrowser extends sfTestFunctional
{
  public function signin($username, $password) 
  {  
      return $this->get('/admin/login')->
        setField('signin[username]', $username)->
        setField('signin[password]', $password)->
        click('sign in')->
          
      with('response')->begin()->
        isRedirected()->
        followRedirect()->
      end();
  }  
}