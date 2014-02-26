<div class="owners index single">
  <h2>Użytkownicy</h2>
  
  <div class="sorter">Sortuj po:
    <?php echo $this->Paginator->sort('dacie rejestracji','created');?>,
    <?php echo $this->Paginator->sort('nicku','nick');?>
  </div>  

  <ul class="owners list grid">
  <?php foreach ($owners as $owner):?>
  <li>
    <div class="avatar">
      <?php if (!empty($owner['OwnersAvatar']['id'])): ?>
        <?php echo $html->image('/uploads/'.$owner['OwnersAvatar']['name']); ?>
      <?php else: ?>
        <?php echo $html->image('av_owner.gif', array('alt' => 'avatar')); ?>
      <?php endif; ?>
    </div>
    <h3><?php echo $this->Html->link($owner['Owner']['name'], array('controller' => 'owners' , 'action' => 'profil', $owner['Owner']['id'])); ?></h3>
    <span class="date">W serwisie od: <?php echo $owner['Owner']['created']; ?></span>    
  </li>
  <?php endforeach; ?>
  </ul>
  <?php echo $this->element('shared/paginator');?>
</div>
