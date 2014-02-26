<div class="statusComments form">
<?php echo $this->Form->create('StatusComment');?>
	<fieldset>
 		<legend><?php __('Admin Edit Status Comment'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('text');
		echo $this->Form->input('status_id');
		echo $this->Form->input('owners_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('StatusComment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('StatusComment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Status Comments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Statuses', true), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status', true), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
	</ul>
</div>