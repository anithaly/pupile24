<?php echo $this->element('friends/menu', array('active' => 'sent')); ?>

<div class="messages index">
  <h2>Twoi przyjaciele</h2>
  <?php if($friends):?>
    <ul class="list grid friends">
    <?php foreach($friends as $friend):?>
      <li>
        <div class="avatar"><?php echo $this->Pets->avatar($friend['OwnersAvatar'],$friend['Owner']);?></div>
        <?php echo $this->Html->link($friend['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $friend['Owner']['id'])); ?>
      </li>
    <?php endforeach;?>
    </ul>
  <?php else:?>
    <p>Nie masz jeszcze wysłanych zaproszeń</p>
  <?php endif;?>
</div>

