<div class="news-section index single">
  
  <div class="welcome">
    <h2>Witaj <?php echo $owner['Owner']['name']?>!</h2>
  </div>
  
  <div class="home-section">
    <h3>Najnowsze statusy</h3>
    <?php if(!empty($statuses)):?>
      <?php foreach($statuses as $status):?>
        <p><?php echo $status['Pet']['name']?> (<?php echo $status['Status']['created']?>):<br/>
          <?php echo $status['Status']['text'];?></p>
      <?php endforeach;?>
    <?php else:?>
      <p>Brak statusów do wyświetlenia</p>
    <?php endif;?>
  </div>
  
  <div class="home-section">
    <h3>Najnowsze zdjęcia</h3>
    <?php if(!empty($photos)):?>      
      <?php foreach($photos as $photo):?>
        <?php $thumb = '<img src="'. UPLOADS_PATH . 'small_' . $photo['PetsPhoto']['name'] . '" alt="' . $photo['PetsPhoto']['title'].'" />'; ?>
        <?php echo $this->Html->link($thumb, array('action' => 'view', 'controller' => 'pets_photos', $photo['PetsPhoto']['id']),array('escape' => false))?>
      <?php endforeach;?>
    <?php else:?>
      <p>Brak zdjęć do wyświetlenia</p>
    <?php endif;?>
    
  </div>
  
  <div class="home-section">
    <h3>Komentarze</h3>
    <?php if(!empty($comments)):?>      
    <?php else:?>
      <p>Brak komentarzy do wyświetlenia</p>
    <?php endif;?>
    
  </div>

  <div class="home-section">
    <h3>Artykuły znajomych</h3>
    <?php if(!empty($articles)):?>
      <ul class="list simple">
        <?php foreach($articles as $article):?>
          <li><?php echo $this->Html->link(__($this->Text->truncate($article['Article']['title'],50, array('ending' => '...', 'exact' => false)), true), array('controller' => 'articles', 'action' => 'view', $article['Article']['id'])); ?></li>
        <?php endforeach;?>
      </ul>
    <?php else:?>
      <p>Brak artykułów do wyświetlenia</p>
    <?php endif;?>
    
  </div>   
  
</div>
