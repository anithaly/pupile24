<div class="owners form">
<?php echo $this->Form->create('Owner');?>
	<fieldset>
 		<legend><?php __('Admin Edit Owner'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('about');
		echo $this->Form->input('city');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Owner.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Owner.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles', true), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articles', true), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Status Comments', true), array('controller' => 'status_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status Comment', true), array('controller' => 'status_comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fans', true), array('controller' => 'fans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fans', true), array('controller' => 'fans', 'action' => 'add')); ?> </li>
	</ul>
</div>