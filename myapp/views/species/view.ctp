<div class="species view">
<h2><?php  __('Species');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $species['Species']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $species['Species']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Species', true), array('action' => 'edit', $species['Species']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Species', true), array('action' => 'delete', $species['Species']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $species['Species']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Species', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Species', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pet', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Races', true), array('controller' => 'races', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Pets');?></h3>
	<?php if (!empty($species['Pet'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Age'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Activities'); ?></th>
		<th><?php __('Food'); ?></th>
		<th><?php __('Species Id'); ?></th>
		<th><?php __('Owners Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($species['Pet'] as $pet):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pet['id'];?></td>
			<td><?php echo $pet['name'];?></td>
			<td><?php echo $pet['age'];?></td>
			<td><?php echo $pet['description'];?></td>
			<td><?php echo $pet['activities'];?></td>
			<td><?php echo $pet['food'];?></td>
			<td><?php echo $pet['species_id'];?></td>
			<td><?php echo $pet['owners_id'];?></td>
			<td><?php echo $pet['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pets', 'action' => 'view', $pet['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pets', 'action' => 'edit', $pet['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pets', 'action' => 'delete', $pet['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pet['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pet', true), array('controller' => 'pets', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Races');?></h3>
	<?php if (!empty($species['Race'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Species Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($species['Race'] as $race):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $race['id'];?></td>
			<td><?php echo $race['name'];?></td>
			<td><?php echo $race['species_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'races', 'action' => 'view', $race['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'races', 'action' => 'edit', $race['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'races', 'action' => 'delete', $race['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $race['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Race', true), array('controller' => 'races', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
