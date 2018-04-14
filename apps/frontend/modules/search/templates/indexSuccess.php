<h2 id="results">Search Results</h2>
<?php echo include_partial('info_results', array('count_results' => $count_results)); ?>
<?php foreach ($modules_t as $module): ?>
    <?php echo include_partial($module['module'].'/find', array(
        $module['key'] => $results[$module['key']],
        'count_results' => $results[$module['key']]->count(),
        )); ?>
<?php endforeach ?>

