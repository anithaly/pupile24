<div class="races view">
<h2><?php  __('Race');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $race['Race']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $race['Race']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Species'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($race['Species']['name'], array('controller' => 'species', 'action' => 'view', $race['Species']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Race', true), array('action' => 'edit', $race['Race']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Race', true), array('action' => 'delete', $race['Race']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $race['Race']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Races', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Race', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Species', true), array('controller' => 'species', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Species', true), array('controller' => 'species', 'action' => 'add')); ?> </li>
	</ul>
</div>
