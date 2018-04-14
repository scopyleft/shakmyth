<?php
/**
* 
*/
class DocAnalyzer implements Doctrine_Search_Analyzer_Interface
{
  public function analyze($text)
  {
    $bad_words = sfYaml::load(sfConfig::get('sf_config_dir')."/bad-words.yml");
    $_stopwords = $bad_words['all']['bad-words']['uk'];

    $text = preg_replace('/^[A-Za-z]\'/', '$2', $text);
    $text = preg_replace('/[\'`´"]/', '', $text);
    $text = Doctrine_Inflector::unaccent($text);
    $text = preg_replace('/[^A-Za-z0-9]/', ' ', $text);
    $text = str_replace('  ', ' ', $text);
    
    $terms = explode(' ', $text);
    
    $ret = array();
    if ( ! empty($terms)) 
    {
      foreach ($terms as $i => $term) 
      {
        if (empty($term) OR strlen($term) < 3) 
        {
            continue;
        }
        $lower = strtolower(trim($term));
      
        if (in_array($lower, $_stopwords, true)) 
        {
          continue;
        }

        $ret[$i] = $lower;
      }
    }

    return $ret;     
  }
}