<div class="statuses form">
<?php echo $this->Form->create('Status');?>
	<fieldset>
 		<legend><?php __('Admin Add Status'); ?></legend>
	<?php
		echo $this->Form->input('text');
		echo $this->Form->input('pets_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Statuses', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Status Comments', true), array('controller' => 'status_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status Comment', true), array('controller' => 'status_comments', 'action' => 'add')); ?> </li>
	</ul>
</div>