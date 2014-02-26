<div class="petsAvatars form">
<?php echo $this->Form->create('PetsAvatar');?>
	<fieldset>
 		<legend><?php __('Admin Edit Pets Avatar'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('pets_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PetsAvatar.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PetsAvatar.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pets Avatars', true), array('action' => 'index'));?></li>
	</ul>
</div>