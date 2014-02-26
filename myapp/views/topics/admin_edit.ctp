<div class="topics form">

<?php echo $this->Form->create('Topic');?>
	<fieldset>
 		<legend><?php __('Admin Edit Topic'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Nazwa'));
		echo $this->Form->input('description', array('label' => 'Opis'));
		echo $this->Form->hidden('categories_id', array('value' => $topic['Topic']['categories_id']));
		echo $this->Form->hidden('owners_id', array('value' => $topic['Topic']['owners_id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Zapisz zmiany', true));?>
</div>
