<p class="search-result-infos">
  <span class="count-results"><?php echo $count_results ?></span>
  <?php if($count_results > 1): ?>
    <?php echo 'results' ?>
  <?php else: ?>
    <?php echo 'result' ?>
  <?php endif ?>
  for
  <span id="query"><?php echo $sf_request->getParameter('query') ?></span>
</p>