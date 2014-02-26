<div class="fans view">
<h2><?php  __('Fan');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owners'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fan['Owners']['name'], array('controller' => 'owners', 'action' => 'view', $fan['Owners']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pets'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($fan['Pets']['name'], array('controller' => 'pets', 'action' => 'view', $fan['Pets']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $fan['Fan']['id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fan', true), array('action' => 'edit', $fan['Fan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Fan', true), array('action' => 'delete', $fan['Fan']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fan['Fan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fans', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fan', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
	</ul>
</div>
