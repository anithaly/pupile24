<div class="articles form">
<?php echo $this->Form->create('Article');?>
	<fieldset>
 		<legend><?php __('Admin Add Article'); ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('text');
		echo $this->Form->input('owners_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Articles', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles Comments', true), array('controller' => 'articles_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articles Comments', true), array('controller' => 'articles_comments', 'action' => 'add')); ?> </li>
	</ul>
</div>