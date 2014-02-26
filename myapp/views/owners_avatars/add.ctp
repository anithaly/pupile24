<div class="breadcrumb">
  <?php echo $this->Html->link("Ustawienia", array('controller' => "owners", "action" => "settings"))?> »
  Edycja avatara
</div>
<div class="ownersAvatars form">
	<?php echo $this->Form->create('OwnersAvatar', array('action' => 'createimage_step2', "enctype" => "multipart/form-data"));?>
		<fieldset>
	 		<legend>Zmiana avatara</legend>
		  <?php
        echo $this->Form->input('name', array('label' => 'Wybierz plik', 'type' => 'file')); 
		  ?>
		</fieldset>
	<?php echo $this->Form->end(__('Wyślij', true));?>
</div>

<div class="side">
  <h3>Aktualny avatar</h3>
	<?php if ($owner['OwnersAvatar']['name']): ?>
		<div><?php echo $html->image($owner['OwnersAvatar']['name'], array('alt' => 'avatar')); ?></div>
	<?php else: ?>
		<div><?php echo $html->image('av_owner.gif', array('alt' => 'avatar')); ?></div>
	<?php endif; ?>  
</div>