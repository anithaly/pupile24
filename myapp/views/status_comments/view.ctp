<div class="statusComments view">
<h2><?php  __('Status Comment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusComment['StatusComment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusComment['StatusComment']['text']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($statusComment['Status']['text'], array('controller' => 'statuses', 'action' => 'view', $statusComment['Status']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owners'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($statusComment['Owners']['name'], array('controller' => 'owners', 'action' => 'view', $statusComment['Owners']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statusComment['StatusComment']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Status Comment', true), array('action' => 'edit', $statusComment['StatusComment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Status Comment', true), array('action' => 'delete', $statusComment['StatusComment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statusComment['StatusComment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Status Comments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status Comment', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses', true), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status', true), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
	</ul>
</div>
