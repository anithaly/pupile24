<div id="page">
<div class="articles">
  <h2><?php echo $article['Article']['title']; ?></h2>
  <div class="article-content">
    <?php echo nl2br(h($article['Article']['text'])); ?>
  </div>
  <span class="article-meta">
    Artykuł dodany przez: <?php if (!empty($article['Owner']['name'])): ?>
      <?php echo $this->Html->link($article['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $article['Article']['owners_id'])); ?>
    <?php else: ?>
      <em class="author-removed">konto usunięte</em>
    <?php endif; ?>
    dnia <?php echo $article['Article']['created']; ?>
    <?php if (strcmp($article['Article']['created'],$article['Article']['modified'])): ?>
      (Zmodyfikowano: <?php echo $article['Article']['modified']; ?>)
  <?php endif; ?>
  </span>
    
  <?php if ($article['Owner']['id'] != NULL && $article['Owner']['id'] === $this->Session->read('Auth.Owner.id')): ?> 
    <div class="manage">
      <?php echo $this->Html->link(__('Edytuj', true), array('controller' => 'articles', 'action' => 'edit', $article['Article']['id'])); ?> |
      <?php echo $this->Html->link(__('Usuń', true), array('controller' => 'articles', 'action' => 'delete', $article['Article']['id']), null, sprintf(__('Na pewno chcesz usunąć artykuł p.t. "%s?"', true), $article['Article']['title'])); ?> 
    </div>
  <?php endif; ?>

  <?php if ($this->Session->read('Auth.Owner')): ?> 
    <div class="articlesComments form">
    <?php echo $this->Form->create('ArticleComment', array('controller' => 'aritcleComments', 'action' => 'add'));?>
    <fieldset>
      <legend>Dodaj komentarz</legend>
      <?php echo $this->Form->input('text'); ?>
      <?php echo $this->Form->hidden( 'articles_id', array( 'value' => $article['Article']['id'] ) ); ?>
    </fieldset>
    <?php echo $this->Form->end(__('Wyślij', true));?>
    </div>
  <?php endif ;?>

  <div class="comments">
    <h3>Komentarze</h3>
    <?php if (!empty($article['ArticleComment'])):?>
      <ul clas="comments">      
      <?php foreach ($article['ArticleComment'] as $comment): ?>
        <li>
          <span class="meta">Dodał 
          <?php if (!empty($comment['Owner']['name'])): ?>
            <strong><?php echo $comment['Owner']['name'];?></strong>
          <?php else: ?>
            <em>Konto usunięte</em>
          <?php endif ;?>
           o <?php echo $comment['created'];?></span>
          <p><?php echo nl2br(h($comment['text']));?></p>
          <?php if ($this->Session->read('Auth.Owner')): ?> 
            <?php if ($article['Article']['owners_id']==$this->Session->read('Auth.Owner.id')): ?> 
              <span><?php echo $this->Html->link(__('Usuń', true), array('controller' => 'articleComments', 'action' => 'delete', $comment['id']), null, sprintf(__('Na pewno chcesz usunąć komentarz użytkownika %s?', true), $comment['Owner']['name'])); ?> </span>
            <?php endif; ?>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <?php else:?>
      <p>Brak komentarzy do tego artykułu</p>
    <?php endif; ?>
  </div>
</div>
</div>
