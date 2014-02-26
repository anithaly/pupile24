<div class="pets form">
<?php echo $this->Form->create('Pet');?>
	<fieldset>
 		<legend>Edytuj pupila</legend>
	<?php
	  echo $this->Form->input('id');
		echo $this->Form->input('name', array('label' => 'Imię'));
		echo $this->Form->input('age', array('label' => 'Rok urodzenia')); 
		echo $this->Form->input('description', array('label' => 'Opis'));
		echo $this->Form->input('activity', array('label' => 'Aktywność'));
		echo $this->Form->input('food', array('label' => 'Karma'));
		echo $this->Form->input('species_id', array('label' => 'Gatunek', 'empty' => '-- wybierz gatunek --'));
	?>
	<div id="pet-race"><?php echo $this->Form->input('races_id', array('label' => "Rasa:",'empty' => '-- wybierz rasę --'));?></div>
	</fieldset>
<?php echo $this->Form->end(__('Zapisz', true));?>

<script type="text/javascript">	
	jQuery(document).ready(function($){
		$('#PetSpeciesId').change(function(event){
			$.get("<?php echo $this->Html->url( array('action' => 'getRaces')); ?>?species_id="+$(this).val(), 
				function(data){
					$('#pet-race').html(data);				
				}
			);
		})		
	})
</script>
</div>
