<div class="pets form">
<?php echo $this->Form->create('Pet');?>
	<fieldset>
 		<legend><?php __('Admin Add Pet'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('age');
		echo $this->Form->input('description');
		echo $this->Form->input('activities');
		echo $this->Form->input('food');
		echo $this->Form->input('species_id');
		echo $this->Form->input('owners_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pets', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Species', true), array('controller' => 'species', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Species', true), array('controller' => 'species', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets Avatars', true), array('controller' => 'pets_avatars', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets Avatars', true), array('controller' => 'pets_avatars', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fans', true), array('controller' => 'fans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fans', true), array('controller' => 'fans', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets Photos', true), array('controller' => 'pets_photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets Photos', true), array('controller' => 'pets_photos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses', true), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Statuses', true), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
	</ul>
</div>