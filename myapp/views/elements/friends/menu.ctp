<div class="actions">
  <h3>Przyjaciele</h3>
  <ul>
    <li><?php echo $this->Html->link("Twoi przyjaciele", array('action' => 'index')); ?> </li>
    <li><?php echo $this->Html->link("Zaproszenia do znajomości", array('action' => 'pending')); ?></li>
    <li><?php echo $this->Html->link("Wysłane zaproszenia", array('action' => 'sent')); ?></li>
    <?php /* <li><?php echo $this->Html->link("Odrzucone", array('action' => 'rejected')); ?></li> */ ?>
  </ul>
</div>
