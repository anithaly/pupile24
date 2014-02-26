<div class="breadcrumb">
  <?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?> »
  <?php echo $this->Html->link($topic['Category']['Section']['name'], array('controller' => 'sections', 'action' => 'view', $topic['Category']['Section']['id']));?> »
  <?php echo $this->Html->link($topic['Category']['name'], array('controller' => 'categories', 'action' => 'view', $topic['Category']['id']));?> »
  <?php echo $topic['Topic']['name']; ?>
</div>
<div class="topics view single">
  <h2><?php echo $topic['Topic']['name'];?></h2>
  <?php if (!empty($posts)): ?>
    <ul class="list posts">
      <?php foreach($posts as $post):?>
        <li class="post">
          <div class="avatar">
            <?php if (!empty($post['Owner']['OwnersAvatar'])): ?>
              <?php echo $this->Html->image('/uploads/'.$post['Owner']['OwnersAvatar']['name']); ?>
            <?php else: ?>
              <?php echo $this->Html->image('av_owner.gif'); ?> 
            <?php endif; ?>
          </div>
          <div class="post-content">
            <span class="post-meta">Dnia <?php echo $post['Post']['created'] ?> <?php echo $post['Owner']['name'] ?> napisał(a):</span>
            <p><?php echo nl2br(h($post['Post']['text'])); ?></p>
          </div>
          <?php if($this->Session->read('Auth.Owner.id') === $post['Owner']['id']): ?>
            <?php echo $this->Html->link('Usuń', array('controller' => 'posts', 'action' => 'delete', $post['Post']['id'])); ?>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
  <?php if ($this->Session->read('Auth.Owner.id')):?>
  <div class="reply">
    <div class="topics">
    <?php echo $this->Form->create('Post', array('controller' => 'posts', 'action' => 'add'));?>
    <fieldset>
      <legend>Odpowiedz na ten temat</legend>
      <?php
        echo $this->Form->input('text', array('label' => 'Treść'));
        echo $this->Form->hidden('topics_id', array('value' => $topic['Topic']['id']));
      ?>
    </fieldset>
    <?php echo $this->Form->end(__('Wyślij', true));?>
    </div>
  </div>
  <?php endif; ?>
</div>