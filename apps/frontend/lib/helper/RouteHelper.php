<?php

/**
 * Find a "Special page"
 * @param string $name the special page name
 */
function get_special_page($name)
{
  return Doctrine::getTable('Page')->findOneBySpecialPage($name);
}
