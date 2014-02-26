<div class="breadcrumb">
  <?php echo $this->Html->link("Ustawienia", array('controller' => "owners", "action" => "settings"))?> »
  Zmiana hasła
</div>
<div class="owners form single">
<?php echo $this->Form->create('Owner');?>
	<fieldset>
 		<legend><?php __('Zmiana hasła'); ?></legend>
	<?php
		echo $this->Form->input('new_password', array('label' => 'Nowe hasło', 'type' => 'password'));
		echo $this->Form->input('repeat_password', array('label' => 'Powtórz hasło','type' => 'password'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Zmień', true));?>
</div>
