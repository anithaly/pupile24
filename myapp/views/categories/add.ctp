<div class="categories form">
<?php echo $this->Form->create('Category');?>
	<fieldset>
 		<legend><?php __('Add Category'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nazwa'));
		echo $this->Form->input('description', array('label' => 'Opis'));
		echo $this->Form->hidden('sections_id', array('value' => ));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Dodaj', true));?>
</div>

<div class="actions">
	<h3>Działy forum</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Dodaj', true), array('controller' => 'sections', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
	</ul>

<h3>Kategorie działów</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Dodaj', true), array('controller' => 'categories', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
	</ul>

<h3>Tematy kategorii</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Dodaj', true), array('controller' => 'topics', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista', true), array('controller' => 'topics', 'action' => 'index')); ?> </li>
	</ul>
</div>

