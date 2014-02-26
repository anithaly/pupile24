<?php echo $this->element('friends/menu', array('active' => 'pending')); ?>
<div class="messages index">
  <h2>Zaproszenia do znajomości</h2>
  <?php if($friends):?>
    <ul class="list grid friends">
    <?php foreach($friends as $friend):?>
      <li>
        <div class="avatar"><?php echo $this->Pets->avatar($friend['OwnersAvatar'],$friend['Owner']);?></div>
        <span class="name">Od: <?php echo $this->Html->link($friend['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $friend['Owner']['id'])); ?></span>
        <span class="actions">
          <?php echo $this->Html->link("Zaakceptuj", array('controller' => 'friends', 'action' => 'accept', $friend['Owner']['id']));?> | 
          <?php echo $this->Html->link("Odrzuć", array('controller' => 'friends', 'action' => 'reject', $friend['Owner']['id']));?>
        </span>
      </li>
    <?php endforeach;?>
    </ul>
  <?php else:?>
    <p>Nie masz jeszcze zaproszeń</p>
  <?php endif;?>
</div>
