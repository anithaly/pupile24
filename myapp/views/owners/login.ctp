<div class="log-in">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('Owner', array('action' => 'login'));?>
	<fieldset>
 		<legend>Zaloguj się</legend>
	<?php
		echo $this->Form->input('email', array('label' => 'Adres email'));
		echo $this->Form->input('password', array('label' => 'Hasło.'));
	?>
	</fieldset>
  <?php echo $this->Form->end("Zaloguj się »");?>
</div>
