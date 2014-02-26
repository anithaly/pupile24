<div class="petsAvatars form">
	<h3>Aktualny avatar:</h3>
        <?php echo $this->Pets->petsAvatar($pet['PetsAvatar'],$pet['Pet']);?>
	<?php echo $this->Form->create('PetsAvatar', array('action' => 'createimage_step2', "enctype" => "multipart/form-data"));?>
		<fieldset>
	 		<legend>Zmiana avatara</legend>
		<?php
        		echo $this->Form->input('name', array('label' => 'Wybierz plik', 'type' => 'file')); 
			echo $this->Form->hidden('pets_id', array( 'value' => $pet['Pet']['id'] ) );
		?>
		</fieldset>
	<?php echo $this->Form->end(__('Wyślij', true));?>
</div>
