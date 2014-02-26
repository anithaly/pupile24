<div class="breadcrumb">
	<?php if (!empty($sections)): ?>
		<?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?>  »  
		<?php echo $this->Html->link($sections['Section']['name'], array('controller' => 'sections', 'action' => 'view', $sections['Section']['id'])) ;?>
	<?php endif; ?>
</div>

<div class="view">
	<?php if (!empty($sections)): ?>
	<li>Dział: <?php echo $sections['Section']['name']; ?><br />
		Opis: <?php echo $sections['Section']['description']; ?><br />
		
		<?php if (!empty($sections['Category'])): ?>
		<ul>
			<?php foreach ($sections['Category'] as $category):?>
				<li>Kategoria: <?php echo $this->Html->link($category['name'], array('controller' => 'categories', 'action' => 'view', $category['id'])); ?><br />
				Opis:  <?php echo $category['description']; ?><br />
				<?php echo $this->Html->link(__('Edytuj', true), array('controller' => 'categories','action' => 'edit', $category['id'])); ?>
				<?php echo $this->Html->link(__('Usuń', true), array('controller' => 'categories','action' => 'delete', $category['id']), null, sprintf(__('Na pewno chcesz usunąć katogorię %s?', true), $category['name'])); ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php endif; ?>
	</li>
<?php endif; ?>
</div>

<div class="actions">
 <h3>Kategorie</h3>
	<ul>
	    	<li><?php echo $this->Html->link(__('Nowa kategoria', true), array('controller' => 'categories', 'action' => 'add', $sections['Section']['id'])); ?></li>
		<li><?php echo $this->Html->link(__('Edycja tej sekcji', true), array('controller' => 'sections', 'action' => 'edit', $sections['Section']['id'])); ?></li>
	</ul>
</div>




