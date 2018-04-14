<?php
class Tools
{ 
	static public function resume($text, $length=100)
	{
    sfContext::getInstance()->getConfiguration()->loadHelpers('Text');
    return truncate_text(strip_tags($text), $length);
	}
	
	static public function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
 
	  // trim
	  $text = trim($text, '-');
		
	  // transliterate
	  if (function_exists('iconv'))
	  {
	    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	  }
	
	 	 // lowercase
	  $text = strtolower($text);
	
	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);
 
	  if (empty($text))
	  {
	    return 'n-a';
	  }
 
	  return $text;
	}
}

