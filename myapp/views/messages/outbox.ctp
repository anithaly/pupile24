<div class="breadcrumb">
  <?php echo $this->Html->link("Pupilowa poczta", array('controller' => "messages", "action" => "index"))?> »
  Wiadomości wysłane
</div>

<?php echo $this->element('messages/menu', array('active' => 'outbox')); ?>

<div class="messages index">
  <h2>Wiadomości wysłane</h2>
  <table>
    <thead>
      <tr>
        <th>Adresat</th>
        <th>Wiadomość</th>
        <th>Data wysłania</th>
        <th scope="col">Akcje</th>
      </tr>
    </thead>
    <tbody>
      <?php if($messages):?>
      <?php foreach ($messages as $message):?>
        <tr>
          <td><?php echo $message['Recipient']['name']?></td>
          <td class="left">
            <?php echo $this->Html->link(__($message['Message']['title'], true), array('action' => 'view', $message['Message']['id'])); ?>
            <p><?php echo $message['Message']['text']?></p>
          </td>
          <td><?php echo $message['Message']['created']?></td>
          <td>
            <?php echo $this->Html->link("Pokaż", array('action' => 'view', $message['Message']['id'])); ?>
            <?php echo $this->Html->link('Usuń', array('action' => 'delete', $message['Message']['id']), null, sprintf('Na pewno chcesz usunąć wiadomość:\n%s?', $message['Message']['title'])); ?>
          </td>          
        </tr>
      <?php endforeach; ?>    
      <?php else:?>
        <tr><td colspan="4"><p>Brak wiadomości w skrzynce</p></td></tr>
      <?php endif;?>
    </tbody>    
  </table>
</div>
