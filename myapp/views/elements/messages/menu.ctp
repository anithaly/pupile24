<div class="actions">
  <h3>Pupilowa poczta</h3>
  <ul>
    <li><?php echo $this->Html->link("Nowa wiadomość", array('action' => 'add')); ?> </li>
    <li><?php echo $this->Html->link("Skrzynka odbiorcza", array('action' => 'inbox')); ?></li>
    <li><?php echo $this->Html->link("Wiadomości wysłane", array('action' => 'outbox')); ?></li>
  </ul>
</div>