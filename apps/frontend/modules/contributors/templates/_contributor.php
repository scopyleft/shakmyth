<div class="contributor">
	<a href="<?php echo $contributor_link ?>" class="contributor" name="contributor">
		<img class="user-pic" src="<?php echo sfConfig::get('app_identities_dir') . '/' . $photo ?>" />
	</a>
	<span class="name" id="first-name"><?php echo ucfirst($contributor->getFirstName()) ?></span>
	<span class="name" id="last-name"><?php echo strtoupper($contributor->getLastName()) ?></span>
</div>