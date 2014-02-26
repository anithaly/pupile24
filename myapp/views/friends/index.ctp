<?php echo $this->element('friends/menu', array('active' => 'index')); ?>
<div class="messages index">
  <h2>Twoi przyjaciele</h2>
  <?php if($friends):?>
    <ul class="list grid friends">
    <?php foreach($friends as $friend):?>
      <li>
        <div class="avatar"><?php echo $this->Pets->avatar($friend['OwnersAvatar'],$friend['Owner']);?></div>
        <span class="name"><?php echo $this->Html->link($friend['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $friend['Owner']['id'])); ?></span>
        <span class="actions">
          <?php echo $this->Html->link("Zakończ znajomość", array('controller' => 'friends', 'action' => 'break_friendship', $friend['Owner']['id']));?>
        </span>
      </li>
    <?php endforeach;?>
    </ul>
  <?php else:?>
    <p>Nie masz jeszcze znajomych</p>
  <?php endif;?>
</div>