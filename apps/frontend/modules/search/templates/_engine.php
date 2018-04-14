<?php use_helper('Route') ?>

<form action="<?php echo url_for('@default_search') ?>" method="get" name="search_engine">
  <input type="text" name="query" value="<?php echo $sf_user->getAttribute('query') ?>" id="search_keywords" />
  <input type="image" src="/media/ok.gif" id="ok" name="submit" alt="submit" title="Search entire website" />
  <input type="image" src="/media/clear.jpg" id="search-clear" name="clear" alt="clear" title="Clear this search" />
  <a id="search-help" href="<?php echo url_for('page', array('title' => "How to search")) ?>" title="How to search ?"><img src="/media/search-help.gif" alt="Help" /></a>
</form>