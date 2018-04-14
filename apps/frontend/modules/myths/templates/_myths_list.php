<ul class="myths_list">
 <?php foreach ($myths as $myth): ?>
   <li class="myth"><a href="<?php echo url_for('@myth_show?myth_id='.$myth->getId().'&myth_name='.$myth->getName()) ?>"><?php echo ucfirst($myth->getName()) ?></a></li>
 <?php endforeach ?>
</ul>


