<div class="petsPhotos form">
<?php echo $this->Form->create('PetsPhoto');?>
	<fieldset>
 		<legend><?php __('Edycja zdjęcia'); ?></legend>
	<?php
		echo $this->Form->input('id');
//		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('title');
		echo $this->Form->input('pets_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

