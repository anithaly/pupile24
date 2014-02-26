<h2>
<?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?> >
<?php echo $this->Html->link($section['Section']['name'], array('controller' => 'sections', 'action' => 'view',$section['Section']['id']));?>
</h2>

<div class="categories form">
<?php echo $this->Form->create('Category');?>
	<fieldset>
 		<legend>Dodawanie Kategorii</legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label' => 'Nazwa'));
		echo $this->Form->input('description',array('label' => 'Opis'));
		echo $this->Form->hidden('sections_id',array('value' => $section['Section']['id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Dodaj', true));?>
</div>
