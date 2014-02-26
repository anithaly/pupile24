<div class="categories form">
<?php echo $this->Form->create('Section');?>
	<fieldset>
 		<legend>Edycja Kategorii</legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name',array('label' => 'Nazwa'));
		echo $this->Form->input('description',array('label' => 'Opis'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Zmień', true));?>
</div>
<div class="actions">
		<h3>Działy forum</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Dodaj', true), array('controller' => 'sections', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Lista działów', true), array('controller' => 'sections', 'action' => 'index')); ?> </li>
	</ul>
</div>
