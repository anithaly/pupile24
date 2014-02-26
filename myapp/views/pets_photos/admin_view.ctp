<div class="petsPhotos view">
<h2><?php  __('Pets Photo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $petsPhoto['PetsPhoto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $petsPhoto['PetsPhoto']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $petsPhoto['PetsPhoto']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $petsPhoto['PetsPhoto']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $petsPhoto['PetsPhoto']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pets'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($petsPhoto['Pets']['name'], array('controller' => 'pets', 'action' => 'view', $petsPhoto['Pets']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pets Photo', true), array('action' => 'edit', $petsPhoto['PetsPhoto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Pets Photo', true), array('action' => 'delete', $petsPhoto['PetsPhoto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $petsPhoto['PetsPhoto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets Photos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets Photo', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
	</ul>
</div>
