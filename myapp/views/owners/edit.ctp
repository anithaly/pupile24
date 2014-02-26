<div class="breadcrumb">
  <?php echo $this->Html->link("Ustawienia", array('controller' => "owners", "action" => "settings"))?> »
  Edycja profilu
</div>

<div class="owners form single">
<?php echo $this->Form->create('Owner');?>
	<fieldset>
 		<legend><?php __('Edycja profilu'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('about');
		echo $this->Form->input('city');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Edytuj', true));?>
</div>
