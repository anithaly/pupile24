<div class="register">
<?php echo $this->Form->create('Owner');?>
	<fieldset>
 		<legend><?php __('Zarejestruj się'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nazwa użytkownika'));
		echo $this->Form->input('email', array('label' => 'Email'));
		echo $this->Form->input('password', array('label' => 'Hasło.'));
		echo $this->Form->input('password_verification', array('label' => 'Powtórz hasło', 'type' => 'password'));
		echo $this->Form->input('about', array('label' => 'Kilka słów o Tobie'));
		echo $this->Form->input('city', array('label' => 'Miejscowość'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Zarejestruj', true));?>
</div>
