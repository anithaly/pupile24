<div id="profil">
  <h2>Profil użytkownika: <?php echo $owner['Owner']['name']; ?></h2>

  <div id="col1">
    <div class="avatar">
      <?php echo $this->Pets->avatar($owner['OwnersAvatar'],$owner['Owner']);?>
    </div>

    <?php if($this->Session->read('Auth.Owner.id')): ?>
      <div class="pet-actions">      
        <?php if ($this->Pets->canBeFriends($owner['Owner']['id'],$this->Session->read('Auth.Owner.id'))): ?> 
          <?php echo $this->Html->link('Zaproś do znajomych', array('controller' => 'friends', 'action' => 'add', $owner['Owner']['id'])); ?>
        <?php endif;?>     
      </div>
    <?php endif; ?>

    <div class="owner-details">
      <h3>Informacje</h3>
      <p>Dołączył/a: <?php echo $owner['Owner']['created']; ?></p>
      <?php if (!empty($owner['Owner']['about'])): ?>
      <div>
        Kilka słów o sobie:
        <p><?php echo $owner['Owner']['about']; ?></p>
      </div>
      <?php endif; ?>

      <?php if (!empty($owner['Owner']['city'])): ?>
        <p>Skąd: <?php echo $owner['Owner']['city']; ?></p>
      <?php endif; ?>
    </div>

    <div class="owner-friends"> 
      <h4>Znajomi</h4>
	<?php if (!empty($friends)): ?>
		<?php  foreach($friends as $friend): ?>
			<div class="avatar"><?php echo $this->Pets->avatar($friend['OwnersAvatar'],$friend['Owner']);?></div>
			<div><?php echo $friend['Owner']['name']; ?></div>
		<?php endforeach; ?>
	<?php else: ?>
	<span>Brak znajomych</span>
	<?php endif;?>
    </div>

  </div><!-- col1-->

  <div id="col2">
    <div id="owners-pets"> 
      <?php if($owner['Pet']): ?>
      <h3>Właściciel pupilów:</h3>
      <ul class="pets list grid">
        <?php foreach ($owner['Pet'] as $pet): ?>
          <li class="pet">
            <div class="avatar">
              <?php echo $this->Pets->petsAvatar($pet['PetsAvatar'],$pet);?>
            </div>            
            <?php echo $this->Html->link($pet['name'], array('controller' => 'pets', 'action' => 'pet', $pet['id'])); ?>
          </li>
        <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <div>Użytkownik nie posiada jeszcze żadnych zwierząt.</div>
      <?php endif; ?>
    </div>

    <div id="favourites"> 
      <h3>Ulubione:</h3>
      <?php if(!empty($favourites)): ?>    
        <ul class="pets list grid">
        <?php foreach ($favourites as $fav): ?>
          <li class="pet">
            <div class="avatar">
              <?php echo $this->Pets->petsAvatar($fav["Pet"]['PetsAvatar'],$fav["Pet"]);?>
            </div>            
            <?php echo $this->Html->link($fav["Pet"]['name'], array('controller' => 'pets', 'action' => 'pet', $fav["Pet"]['id'])); ?>
          </li>
        <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <div>Użytkownik nie posiada jeszcze ulubionych zwierząt.</div>
      <?php endif; ?>
    </div>
  </div><!-- col2-->

  <div id="col3">
    <div id="owners-articles"> 
      <h3>Artykuły</h3>
      <?php if (!empty($articles)): ?>
      <ul class="list">
        <?php foreach($articles as $article):?>
          <li><?php echo $this->Html->link(__($this->Text->truncate($article['Article']['title'],50, array('ending' => '...', 'exact' => false)), true), array('controller' =>'articles', 'action' => 'view', $article['Article']['id'])); ?></li>
        <?php endforeach; ?>
      <?php else: ?>
        <span>Brak artykułow</span>
      <?php endif; ?>

    </div>
    <div id="owners-posts"> 
      <h3>Aktywność na froum</h3>
      <?php if (!empty($posts)): ?>
        <ul class="list">
        <?php foreach($posts as $post):?>
          <li><em><?php echo $this->Text->truncate($post['Post']['text'], 20, array('ending' => '...', 'exact' => false)); ?></em> w temacie <strong><?php echo $this->Html->link($post['Topic']['name'], array('controller' => 'topics', 'action' => 'view', $post['Topic']['id']))?></strong></li>
        <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <span>Brak postów</span>
      <?php endif; ?>
    </div>
  </div><!-- col3-->
</div>

