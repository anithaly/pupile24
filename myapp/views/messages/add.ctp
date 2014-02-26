<div class="breadcrumb">
  <?php echo $this->Html->link("Pupilowa poczta", array('controller' => "messages", "action" => "index"))?> »
  Nowa wiadomość
</div>

<?php echo $this->element('messages/menu', array('active' => 'inbox')); ?>  

<div class="messages form">  
<?php echo $this->Form->create('Message');?>
	<fieldset>
 		<legend>Utwórz nową wiadomość</legend>
	<?php
		echo $this->Form->input('title', array( "label" => "Tytuł wiadomości"));
		echo $this->Form->input('recipient_id', array('label' => "Adresat", 'empty' => "--  wybierz adresata --"));		
		echo $this->Form->input('text', array("label" => "Treść wiadomości"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Wyślij', true));?>
</div>