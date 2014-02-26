<div class="pets view">
<h2><?php  __('Pet');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pet['Pet']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pet['Pet']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Age'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pet['Pet']['age']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pet['Pet']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Activities'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pet['Pet']['activities']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Food'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pet['Pet']['food']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Species'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($pet['Species']['name'], array('controller' => 'species', 'action' => 'view', $pet['Species']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owners'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($pet['Owners']['name'], array('controller' => 'owners', 'action' => 'view', $pet['Owners']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pet['Pet']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pet', true), array('action' => 'edit', $pet['Pet']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Pet', true), array('action' => 'delete', $pet['Pet']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pet['Pet']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pet', true), array('action' => 'add')); ?> </li>
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
	<div class="related">
		<h3><?php __('Related Pets Avatars');?></h3>
	<?php if (!empty($pet['pets_avatars'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $pet['pets_avatars']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $pet['pets_avatars']['name'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pets Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $pet['pets_avatars']['pets_id'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Pets Avatars', true), array('controller' => 'pets_avatars', 'action' => 'edit', $pet['pets_avatars']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Related Fans');?></h3>
	<?php if (!empty($pet['fans'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Owners Id'); ?></th>
		<th><?php __('Pets Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pet['fans'] as $fans):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $fans['owners_id'];?></td>
			<td><?php echo $fans['pets_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'fans', 'action' => 'view', $fans['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'fans', 'action' => 'edit', $fans['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'fans', 'action' => 'delete', $fans['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $fans['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Fans', true), array('controller' => 'fans', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Pets Photos');?></h3>
	<?php if (!empty($pet['pets_photos'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Pets Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pet['pets_photos'] as $petsPhotos):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $petsPhotos['id'];?></td>
			<td><?php echo $petsPhotos['name'];?></td>
			<td><?php echo $petsPhotos['created'];?></td>
			<td><?php echo $petsPhotos['description'];?></td>
			<td><?php echo $petsPhotos['title'];?></td>
			<td><?php echo $petsPhotos['pets_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pets_photos', 'action' => 'view', $petsPhotos['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pets_photos', 'action' => 'edit', $petsPhotos['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pets_photos', 'action' => 'delete', $petsPhotos['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $petsPhotos['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pets Photos', true), array('controller' => 'pets_photos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Statuses');?></h3>
	<?php if (!empty($pet['statuses'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Text'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Pets Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pet['statuses'] as $statuses):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $statuses['id'];?></td>
			<td><?php echo $statuses['text'];?></td>
			<td><?php echo $statuses['created'];?></td>
			<td><?php echo $statuses['pets_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'statuses', 'action' => 'view', $statuses['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'statuses', 'action' => 'edit', $statuses['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'statuses', 'action' => 'delete', $statuses['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statuses['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Statuses', true), array('controller' => 'statuses', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
