<div class="articles view">
<h2><?php  __('Article');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['text']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owners'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($article['Owners']['name'], array('controller' => 'owners', 'action' => 'view', $article['Owners']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $article['Article']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Article', true), array('action' => 'edit', $article['Article']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Article', true), array('action' => 'delete', $article['Article']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $article['Article']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Article', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Owners', true), array('controller' => 'owners', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Owners', true), array('controller' => 'owners', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Articles Comments', true), array('controller' => 'articles_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Articles Comments', true), array('controller' => 'articles_comments', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Articles Comments');?></h3>
	<?php if (!empty($article['articles_comments'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Text'); ?></th>
		<th><?php __('Owners Id'); ?></th>
		<th><?php __('Articles Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($article['articles_comments'] as $articlesComments):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $articlesComments['id'];?></td>
			<td><?php echo $articlesComments['created'];?></td>
			<td><?php echo $articlesComments['text'];?></td>
			<td><?php echo $articlesComments['owners_id'];?></td>
			<td><?php echo $articlesComments['articles_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'articles_comments', 'action' => 'view', $articlesComments['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'articles_comments', 'action' => 'edit', $articlesComments['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'articles_comments', 'action' => 'delete', $articlesComments['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $articlesComments['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Articles Comments', true), array('controller' => 'articles_comments', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
