<div class="fans index">
	<h2><?php __('Fans');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('owners_id');?></th>
			<th><?php echo $this->Paginator->sort('pets_id');?></th>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($fans as $fan):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $this->Html->link($fan['Owners']['name'], array('controller' => 'owners', 'action' => 'view', $fan['Owners']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($fan['Pets']['name'], array('controller' => 'pets', 'action' => 'view', $fan['Pets']['id'])); ?>
		</td>
		<td><?php echo $fan['Fan']['id']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $fan['Fan']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $fan['Fan']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $fan['Fan']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fan['Fan']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Fan', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
	</ul>
</div>