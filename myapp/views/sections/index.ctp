<div class="sections index single">
  <h2>Forum</h2>	
  <p>Wszystkich fanów naszych zwierzaków zapraszamy do wzięcia udziału w dyskujach na naszym forum</p>
  <?php if (!empty($sections)): ?>
  <ul class="list forums">
  <?php foreach ($sections as $forum):?>
  <li class="section">
    <h3>Dział: <?php echo $this->Html->link($forum['Section']['name'], array('controller' => 'sections', 'action' => 'view', $forum['Section']['id'])); ?></h3>
    <p><?php echo $forum['Section']['description']; ?></p>
    <?php if (!empty($forum['Category'])): ?>
        <ul class="list subforum">
        <?php foreach ($forum['Category'] as $category):?>
          <li class="category">
            <h4>Kategoria: <?php echo $this->Html->link($category['name'], array('controller' => 'categories', 'action' => 'view', $category['id'])); ?></h4>
            <p> <?php echo $category['description']; ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
</div>
