<?php

/**
* 
*/
class DocTools
{
  static public function addIsActive($q, $is_active = FALSE)
  {
    if ($is_active === FALSE)
    {
      return $q;
    }
    
    return $q->addWhere('is_active = true');
  }
}
