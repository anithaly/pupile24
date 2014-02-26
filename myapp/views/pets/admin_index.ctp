<div class="pets index">
	<h2><?php __('Pets');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('age');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('activities');?></th>
			<th><?php echo $this->Paginator->sort('food');?></th>
			<th><?php echo $this->Paginator->sort('species_id');?></th>
			<th><?php echo $this->Paginator->sort('owners_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pets as $pet):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pet['Pet']['id']; ?>&nbsp;</td>
		<td><?php echo $pet['Pet']['name']; ?>&nbsp;</td>
		<td><?php echo $pet['Pet']['age']; ?>&nbsp;</td>
		<td><?php echo $pet['Pet']['description']; ?>&nbsp;</td>
		<td><?php echo $pet['Pet']['activities']; ?>&nbsp;</td>
		<td><?php echo $pet['Pet']['food']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pet['Species']['name'], array('controller' => 'species', 'action' => 'view', $pet['Species']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($pet['Owners']['name'], array('controller' => 'owners', 'action' => 'view', $pet['Owners']['id'])); ?>
		</td>
		<td><?php echo $pet['Pet']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $pet['Pet']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pet['Pet']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pet['Pet']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pet['Pet']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Pet', true), array('action' => 'add')); ?></li>
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