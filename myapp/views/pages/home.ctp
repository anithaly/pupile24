<div class="section left-col">
  <h2>Witaj w serwisie!</h2>
  <blockquote>
    <p>    Przyjaciele nie należą do was. To wy należycie do przyjaciół. 
	<cite>Agatha Christie</cite>
  </blockquote>

  <div class="home-section">
    <h3>Ostatnio dołączyli do nas</h3>
    <?php if (!empty($last_pets)): ?>
      <ul class="list pets grid">
        <?php foreach ($last_pets as $pet):?>
        <li>
          <div class="avatar"><?php echo $this->Pets->petsAvatar($pet['PetsAvatar'],$pet['Pet']);?></div>
          <span class="name"><?php echo $this->Html->link($pet['Pet']['name'], array('controller' => 'pets','action' => 'pet', $pet['Pet']['id'])); ?></span>
          <span class="owner">Właściciel: <?php echo $this->Html->link($pet['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $pet['Owner']['id'])); ?></span>
        </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>    
  </div>
  <?php /*?>
  <div class="home-section">
    <h3>Ostatnio dodane zdjęcia</h3>
  </div>
  */ ?>

</div>

<div class="right-col">
  <div class="home-section stats">
    <p>Mamy już <?php echo $total_pets; ?> zwierzaków, <?php echo $total_photos; ?> zdjęć i <?php echo $total_articles; ?> artykułów w serwisie!</p>
  </div>
  
  <div class="home-section articles">
    <h3>Najnowsze artykuły</h3>
    <?php if (!empty($last_articles)):?>
    <ul id="lastArticles" class="articles list simple">
      <?php foreach ($last_articles as $article): ?>
        <li>
          <h3><?php echo $this->Html->link(__($this->Text->truncate($article['Article']['title'],50, array('ending' => '...', 'exact' => false)), true), array('controller' => 'articles','action' => 'view', $article['Article']['id'])); ?></h3>
          <span class="meta">
            Dodany przez: <?php if (!empty($article['Owner']['name'])): ?>
              <?php echo $this->Html->link($article['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $article['Article']['owners_id'])); ?>
            <?php else: ?>
              <em class="author-removed">konto usunięte</em>
            <?php endif; ?>
            dnia <?php echo $article['Article']['created']; ?>
          </span>
        </li>
      <?php endforeach; ?>    
    </ul>  
    <?php endif;?>
  </div>
</div>
