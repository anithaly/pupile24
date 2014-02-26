
<h2>
<?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?> > 
<?php echo $this->Html->link($category['Section']['name'], array('controller' => 'sections', 'action' => 'view', $category['Section']['id'])) ;?> >
<?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])) ;?>
</h2>
<ul>

<div class="categories form">
<?php echo $this->Form->create('Category');?>
	<fieldset>
 		<legend>Edycja kategorii</legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Nazwa'));
		echo $this->Form->input('description', array('label' => 'Opis'));
		echo $this->Form->hidden('sections_id', array('value' => $category['Category']['sections_id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Zapisz zmiany', true));?>
</div>

