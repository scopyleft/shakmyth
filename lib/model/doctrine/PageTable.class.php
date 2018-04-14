<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PageTable extends Doctrine_Table
{
  public function getBySearch($query)
  {
    return GlobalDoctrineModel::searching($this, $query);
  }
  
  /**
   * isActiveByTitle
   *
   * Test if an active page exist return null if no pages
   *
   * @return true, false or null
   * @author PointBar
   **/
  public function setIsActiveByTitle($title)
  {
    $object = $this->findOneByTitle($title);
    $state = is_object($object) ?  ($object->getIsActive() ? true : false) : null;
    
    return $state;  
  }

	public function getTitleBySPecialPage($special_page_name)
	{
		return $this->findOneBySpecialPage($special_page_name)->getTitle();
	}
}