<div class="breadcrumb">
  <?php echo $this->Html->link("Artykuły", array('action' => 'index')); ?> »
  Moje artykuły
</div>
<div class="myarticles index">
  <h2>Moje artykuły</h2>
  <p>Spis artykułów/porad/dzielenia się doświadczeniem z innymi użytkownikami. Artykuł może być komentowany przez zalogowanych użytkowników. Komentarze są widoczne dla wszystkich odwiedzających serwis.</p>  
	<?php if ($my_articles): ?>
    <ul class="articles list">
    <?php foreach ($my_articles as $article):?>
      <li>
        <h3><?php echo $this->Html->link(__($this->Text->truncate($article['Article']['title'],50, array('ending' => '...', 'exact' => false)), true), array('action' => 'view', $article['Article']['id'])); ?></h3>
        <p><?php echo $this->Text->truncate($article['Article']['text'], 250, array('ending' => '...', 'exact' => false)); ?>
          <?php echo $this->Html->link("czytaj dalej »", array('action' => 'view', $article['Article']['id'])); ?>
          </p>
        <span class="meta">
          Dodany dnia <?php echo $article['Article']['created']; ?> |
          <?php if (strcmp($article['Article']['created'],$article['Article']['modified'])): ?>
              (Zmodyfikowano: <?php echo $article['Article']['modified']; ?>)
          <?php endif; ?>          
          <?php echo $this->Html->link(__('Edytuj', true), array('action' => 'edit', $article['Article']['id'])); ?> |
          <?php echo $this->Html->link(__('Usuń', true), array('action' => 'delete', $article['Article']['id']), null, sprintf(__('Na pewno chcesz usunąć artykuł <strong>%s</strong>?', true), $article['Article']['title'])); ?>          
        </span>
      </li>
    <?php endforeach; ?>
    </ul>	  
<div class="paginator">
  <span class="info"><?php echo $this->Paginator->counter(array('format' => __('Strona %page% z %pages% | Artykułó %current% z %count%', true)));?></span>
  <span class="paging">
    <?php echo $this->Paginator->prev('« poprzednia', array(), null, array('class'=>'disabled'));?> |
    <?php echo $this->Paginator->numbers();?> |
    <?php echo $this->Paginator->next('następna »', array(), null, array('class' => 'disabled'));?>
  </span>
</div>
  <?php else: ?>
    <div>Brak artykułów.</div>
  <?php endif; ?>
</div>

<?php echo $this->element('articles/menu');?>
