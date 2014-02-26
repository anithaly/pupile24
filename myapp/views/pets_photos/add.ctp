<div class="petsPhotos form">
	<?php echo $this->Form->create('PetsPhoto', array('action' => 'create', "enctype" => "multipart/form-data"));?>
		<fieldset>
	 		<legend><?php __('Dodaj zdjęcia'); ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('description');
        		echo $this->Form->input('name', array("type" => "file")); 
			echo $this->Form->hidden('pets_id', array( 'value' => $pet['Pet']['id'] ) );
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Wyślij', true));?>
</div>
