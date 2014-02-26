<div class="statuses view">
<h2><?php  __('Status');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $status['Status']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $status['Status']['text']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $status['Status']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pets'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($status['Pets']['name'], array('controller' => 'pets', 'action' => 'view', $status['Pets']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Status', true), array('action' => 'edit', $status['Status']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Status', true), array('action' => 'delete', $status['Status']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $status['Status']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Statuses', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Status Comments', true), array('controller' => 'status_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status Comment', true), array('controller' => 'status_comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Status Comments');?></h3>
	<?php if (!empty($status['StatusComment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Text'); ?></th>
		<th><?php __('Status Id'); ?></th>
		<th><?php __('Owners Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($status['StatusComment'] as $statusComment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $statusComment['id'];?></td>
			<td><?php echo $statusComment['text'];?></td>
			<td><?php echo $statusComment['status_id'];?></td>
			<td><?php echo $statusComment['owners_id'];?></td>
			<td><?php echo $statusComment['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'status_comments', 'action' => 'view', $statusComment['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'status_comments', 'action' => 'edit', $statusComment['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'status_comments', 'action' => 'delete', $statusComment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statusComment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Status Comment', true), array('controller' => 'status_comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
