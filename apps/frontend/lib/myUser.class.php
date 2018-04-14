<?php

class myUser extends sfBasicSecurityUser
{ 
  public function addLetterChoice($letter_choice="")
  {
    // user select a letter => set it
    if($letter_choice)
    {
        $this->setAttribute('letter_choice', $letter_choice);
    }
    // old user choice => set it -or- finaly set to "A"
    elseif(!$this->getAttribute('letter_choice'))
    {
        $this->setAttribute('letter_choice', "A");
    }
  }
  
  public function is_inGroup($user, $group = "contributor")
  {
    $groups = $user->getUser()->getGroups();
    
    foreach ($groups as $group) 
    {
      if($group->getName() == $group)
      {
        return true;
      }
    }

    return false;
  }
}
