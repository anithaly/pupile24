<div class="statusComments index">
	<h2><?php __('Status Comments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('text');?></th>
			<th><?php echo $this->Paginator->sort('status_id');?></th>
			<th><?php echo $this->Paginator->sort('owners_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($statusComments as $statusComment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $statusComment['StatusComment']['id']; ?>&nbsp;</td>
		<td><?php echo $statusComment['StatusComment']['text']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($statusComment['Status']['text'], array('controller' => 'statuses', 'action' => 'view', $statusComment['Status']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($statusComment['Owners']['name'], array('controller' => 'owners', 'action' => 'view', $statusComment['Owners']['id'])); ?>
		</td>
		<td><?php echo $statusComment['StatusComment']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $statusComment['StatusComment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $statusComment['StatusComment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $statusComment['StatusComment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statusComment['StatusComment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Status Comment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Statuses', true), array('controller' => 'statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status', true), array('controller' => 'statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
	</ul>
</div>