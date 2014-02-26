<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Nowy dział', true), array('controller' => 'sections', 'action' => 'add')); ?></li>
	</ul>
</div>

<div class="sections index">	
<h2>
<?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?>
</h2>
		
<?php if (!empty($sections)): ?>
<ul>
	<?php foreach ($sections as $forum):?>
		<li>Dział: <?php echo $this->Html->link($forum['Section']['name'], array('controller' => 'sections', 'action' => 'view', $forum['Section']['id'])); ?><br />
			Opis: <?php echo $forum['Section']['description']; ?><br />
			<?php echo $this->Html->link(__('Edytuj', true), array('action' => 'edit', $forum['Section']['id'])); ?>
			<?php echo $this->Html->link(__('Usuń', true), array('action' => 'delete', $forum['Section']['id']), null, sprintf(__('Na pewno chcesz usunąć dział %s?', true), $forum['Section']['name'])); ?>
			
			<?php if (!empty($forum['Category'])): ?>
			<ul>
				<?php foreach ($forum['Category'] as $category):?>
					<li>Kategoria: <?php echo $this->Html->link($category['name'], array('controller' => 'categories', 'action' => 'view', $category['id'])); ?><br />
					Opis:  <?php echo $category['description']; ?><br />
					<?php echo $this->Html->link(__('Edytuj', true), array('controller' => 'categories','action' => 'edit', $category['id'])); ?>
					<?php echo $this->Html->link(__('Usuń', true), array('controller' => 'categories','action' => 'delete', $category['id']), null, sprintf(__('Na pewno chcesz usunąć katogorię %s?', true), $category['name'])); ?>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>

	</ul>
<?php endif; ?>

</div>



