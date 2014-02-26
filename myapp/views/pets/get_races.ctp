<div class="input select required">
	<label for="PetRacesId">Rasa</label>
	<select id="PetRacesId" name="data[Pet][races_id]">
		<option> -- Wybierz rasę --</option>
		<?php foreach($races as $race):?>
			<option value="<?php echo $race['Race']['id']?>"><?php echo $race['Race']['name']?></option>
		<?php endforeach;?>
	</select>
</div>
