<div class="breadcrumb">
  <?php echo $this->Html->link("Pupilowa poczta", array('controller' => "messages", "action" => "index"))?> »
  <?php echo $message['Message']['title']; ?>
</div>

<?php echo $this->element('messages/menu', array('active' => 'inbox')); ?>

<div class="messages view">  
	<h2><?php echo $message['Message']['title']; ?></h2>	
  <em class="meta">Dnia <?php echo $message["Message"]['created']?> użytkownik <?php echo $message['Sender']["name"] ?> napisał(a):</em>
  <hr />
	<div class="message-content">
	  <p><?php echo nl2br($message['Message']['text']); ?></p>
	</div>
	<p>
</div>