<div class="owners view">
<h2><?php  __('Owner');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $owner['Owner']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $owner['Owner']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $owner['Owner']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $owner['Owner']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $owner['Owner']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('About'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $owner['Owner']['about']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $owner['Owner']['city']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Owner', true), array('action' => 'edit', $owner['Owner']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Owner', true), array('action' => 'delete', $owner['Owner']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $owner['Owner']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owner', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets', true), array('controller' => 'pets', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles', true), array('controller' => 'articles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articles', true), array('controller' => 'articles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Status Comments', true), array('controller' => 'status_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Status Comment', true), array('controller' => 'status_comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Fans', true), array('controller' => 'fans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fans', true), array('controller' => 'fans', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Pets');?></h3>
	<?php if (!empty($owner['pets'])):?>
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
		foreach ($owner['pets'] as $pets):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pets['id'];?></td>
			<td><?php echo $pets['name'];?></td>
			<td><?php echo $pets['age'];?></td>
			<td><?php echo $pets['description'];?></td>
			<td><?php echo $pets['activities'];?></td>
			<td><?php echo $pets['food'];?></td>
			<td><?php echo $pets['species_id'];?></td>
			<td><?php echo $pets['owners_id'];?></td>
			<td><?php echo $pets['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'pets', 'action' => 'view', $pets['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'pets', 'action' => 'edit', $pets['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'pets', 'action' => 'delete', $pets['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pets['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pets', true), array('controller' => 'pets', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Articles');?></h3>
	<?php if (!empty($owner['articles'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Text'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Owners Id'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($owner['articles'] as $articles):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $articles['id'];?></td>
			<td><?php echo $articles['title'];?></td>
			<td><?php echo $articles['text'];?></td>
			<td><?php echo $articles['created'];?></td>
			<td><?php echo $articles['owners_id'];?></td>
			<td><?php echo $articles['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'articles', 'action' => 'view', $articles['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'articles', 'action' => 'edit', $articles['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'articles', 'action' => 'delete', $articles['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $articles['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Articles', true), array('controller' => 'articles', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Status Comments');?></h3>
	<?php if (!empty($owner['status_comment'])):?>
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
		foreach ($owner['status_comment'] as $statusComment):
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
<div class="related">
	<h3><?php __('Related Fans');?></h3>
	<?php if (!empty($owner['fans'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Owners Id'); ?></th>
		<th><?php __('Pets Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($owner['fans'] as $fans):
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
