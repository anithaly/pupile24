<div class="races form">
<?php echo $this->Form->create('Race');?>
	<fieldset>
 		<legend><?php __('Edit Race'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('species_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Race.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Race.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Races', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Species', true), array('controller' => 'species', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Species', true), array('controller' => 'species', 'action' => 'add')); ?> </li>
	</ul>
</div>