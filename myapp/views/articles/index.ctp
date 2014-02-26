<div class="articles index single">
  <h2>Artykuły</h2>
  <p>Spis artykułów/porad/dzielenia się doświadczeniem z innymi użytkownikami. Artykuł może być komentowany przez zalogowanych użytkowników. Komentarze są widoczne dla wszystkich odwiedzających serwis.</p>
  <div class="sorter">Sortuj według:
      <?php echo $this->Paginator->sort('tytułu','title');?>,
      <?php echo $this->Paginator->sort('daty publikacji' ,'created');?>,
      <?php echo $this->Paginator->sort('autora' ,'created');?>
  </div>

  <ul class="articles list">
  <?php foreach ($articles as $article):?>
    <li>
      <h3><?php echo $this->Html->link(__($this->Text->truncate($article['Article']['title'],50, array('ending' => '...', 'exact' => false)), true), array('action' => 'view', $article['Article']['id'])); ?></h3>
      <p><?php echo $this->Text->truncate($article['Article']['text'], 250, array('ending' => '...', 'exact' => false)); ?>
        <?php echo $this->Html->link("czytaj dalej »", array('action' => 'view', $article['Article']['id'])); ?>
        </p>
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
<div class="paginator">
  <span class="info"><?php echo $this->Paginator->counter(array('format' => __('Strona %page% z %pages% | Atrykułów %current% z %count%', true)));?></span>
  <span class="paging">
    <?php echo $this->Paginator->prev('« poprzednia', array(), null, array('class'=>'disabled'));?> |
    <?php echo $this->Paginator->numbers();?> |
    <?php echo $this->Paginator->next('następna »', array(), null, array('class' => 'disabled'));?>
  </span>
</div>

</div>
