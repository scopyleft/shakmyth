<?php

/**
* search
*/
class Search
{
  
  static public function adaptContentWithQuery($content, $query)
  {
    global $count;
    $pattern = '|('.$query.')|';
    $count = preg_match_all($pattern, $content, $match);
  
    function replacement($match)
    {
      global $count;
    
      return '<a name="'.$match[1].$count--.'"><a href="#'.$match[1].$count.'" class="keywords">'.$match[1].'</a></a>';
    }
  
    return preg_replace_callback($pattern, "replacement", $content, -1, $count); 
  }
}


