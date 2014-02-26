<h2>
<?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?> > 
<?php echo $this->Html->link($category['Section']['name'], array('controller' => 'sections', 'action' => 'view', $category['Section']['id']));?> > 
<?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id']));?>
</h2>

<div class="topics form">
<?php echo $this->Form->create('Topic', array('action' => 'create'));?>
	<fieldset>
 		<legend>Nowy temat</legend>
	<?php
		echo $this->Form->input('Topic.name', array('label' => 'Tytuł'));
		echo $this->Form->input('Topic.description', array('label' => 'Opis'));
		echo $this->Form->input('Post.0.text', array('label' => 'Tekst'));
		echo $this->Form->hidden('Topic.categories_id', array('value' => $category['Category']['id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Utwórz nowy temat', true));?>
</div>
