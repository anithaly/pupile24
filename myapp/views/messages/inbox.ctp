<div class="breadcrumb">
  <?php echo $this->Html->link("Pupilowa poczta", array('controller' => "messages", "action" => "index"))?> »
  Skrzynka odbiorcza
</div>

<?php echo $this->element('messages/menu', array('active' => 'inbox')); ?>
<div class="messages index">
  <h2>Skrzynka odbiorcza</h2>
  <table>
    <thead>
      <tr>
        <th>Nadawca</th>
        <th>Wiadomość</th>
        <th>Data wysłania</th>
        <th>Akcje</th>
      </tr>
    </thead>
    <tbody>
      <?php if($messages):?>
      <?php foreach ($messages as $message):?>
        <tr>
          <td><?php echo $message['Sender']['name']?></td>
          <td>
            <?php if($message['Message']['is_unread']):?>
              <big><?php echo $this->Html->link($message['Message']['title'], array('action' => 'view', $message['Message']['id'])); ?></big>
            <?php else:?>
              <?php echo $this->Html->link($message['Message']['title'], array('action' => 'view', $message['Message']['id'])); ?>
            <?php endif;?>
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
