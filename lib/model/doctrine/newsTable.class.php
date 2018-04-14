<?php

class newsTable extends Doctrine_Table
{
	public function getNewsByActive() 
  { 
    $q = $this->createQuery('n')
				->Where('n.is_active = ?', 1)
				->orderBy('n.priority')
				->execute();

    return $q;
  }
}
