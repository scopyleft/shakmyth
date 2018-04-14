<h2><?php echo $title ?></h2>
<ul id="dicentries">
  <?php foreach ($letters as $letter => $count): ?>
      <li class="letters">
      <?php if ($count): ?>
        <?php if($sf_user->getAttribute('letter_choice') == $letter): ?>
          <?php $id_letter_selected = 'id="letter-selected"' ?>
        <?php else: ?>
          <?php $id_letter_selected = '' ?>
        <?php endif ?>
        <a href="<?php echo url_for('@myth_list?letter_choice='.$letter) ?>" <?php echo $id_letter_selected ?> ><?php echo $letter ?></a>
      <?php else: ?>
        <?php echo $letter ?>
      <?php endif ?>
    </li>
  <?php endforeach ?>
</ul>
