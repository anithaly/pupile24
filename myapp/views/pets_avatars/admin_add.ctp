<div class="petsAvatars form">
<?php echo $this->Form->create('PetsAvatar');?>
	<fieldset>
 		<legend><?php __('Admin Add Pets Avatar'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('pets_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pets Avatars', true), array('action' => 'index'));?></li>
	</ul>
</div>