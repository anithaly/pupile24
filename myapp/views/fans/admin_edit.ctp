<div class="fans form">
<?php echo $this->Form->create('Fan');?>
	<fieldset>
 		<legend><?php __('Admin Edit Fan'); ?></legend>
	<?php
		echo $this->Form->input('owners_id');
		echo $this->Form->input('pets_id');
		echo $this->Form->input('id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Fan.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Fan.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fans', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
	</ul>
</div>