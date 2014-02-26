
<h2>
<?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?>
</h2>


<div class="categories form">
<?php echo $this->Form->create('Section');?>
	<fieldset>
 		<legend><?php __('Dodawanie działu froum'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nazwa'));
		echo $this->Form->input('description', array('label' => 'Opis'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Dodaj', true));?>
</div>

