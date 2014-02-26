<div class="petsPhotos form">
<?php echo $this->Form->create('PetsPhoto');?>
	<fieldset>
 		<legend><?php __('Admin Edit Pets Photo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('title');
		echo $this->Form->input('pets_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PetsPhoto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PetsPhoto.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pets Photos', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
	</ul>
</div>