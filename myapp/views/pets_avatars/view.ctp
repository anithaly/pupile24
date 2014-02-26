<div class="petsAvatars view">
<h2><?php  __('Pets Avatar');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $petsAvatar['PetsAvatar']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $petsAvatar['PetsAvatar']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Pets Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $petsAvatar['PetsAvatar']['pets_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pets Avatar', true), array('action' => 'edit', $petsAvatar['PetsAvatar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Pets Avatar', true), array('action' => 'delete', $petsAvatar['PetsAvatar']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $petsAvatar['PetsAvatar']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pets Avatars', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pets Avatar', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
