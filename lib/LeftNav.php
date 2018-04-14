<?php
/**
* LeftNav 
*/
class LeftNav
{
	static public function buildLeftNav() 
	{
		$nav_items = array(); 
		$items = self::getItems();

		foreach ($items as $key => $value) 
		{
			$urls = "";
					
			$q = Doctrine_query::create()
				->from('Page p')
				->where('p.heading = ?', $key)
				->andWhere('p.is_active = ?', 1)
				->orderBy('p.priority');
				
			$pages = $q->fetchArray();
			
			if (!count($pages)) continue;

			foreach ($pages as $page) 
			{
				// detect if the page is special like : contributors
				if (!$page['special_page'])
				{
					$link = '@page?title='.$page['title'];
				}
				else
				{
					$link = '@'.$page['special_page'];
				}	
				
				$urls .= link_to(ucfirst($page['title']), $link, array('class' => 'left-nav-content pages'));
			}
			
			$nav_items[$value] = $urls;
		}

		return $nav_items;
	}
	
	static public function getItems()
	{
		$left_nav_file = sfConfig::get('app_left_nav_items_file');
		$items = sfYaml::load($left_nav_file);
		
		return $items['items'];
	}
	
}



