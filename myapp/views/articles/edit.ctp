<div class="articles form">
<?php echo $this->Form->create('Article');?>
	<fieldset>
 		<legend><?php __('Edycja Aartykułu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('text');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Zapisz zmiany', true));?>
</div>

