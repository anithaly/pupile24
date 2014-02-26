<div class="breadcrumb">
  <?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?> » <?php echo $sections['Section']['name'];?>
</div>
<?php if (!empty($sections)): ?>
<div class="sections index single">
  <h2><?php echo $sections['Section']['name'];?></h2>
  <?php if(isset($sections['Section']['description']) && $sections['Section']['description'] != ''):?>
    <p><?php echo $sections['Section']['name'];?></p>
  <?php endif;?>
  <hr/>
  <?php if (!empty($sections['Category'])): ?>
  <ul class="list subforum">
    <?php foreach ($sections['Category'] as $category):?>
      <li>
        <h4>Kategoria: <?php echo $this->Html->link($category['name'], array('controller' => 'categories', 'action' => 'view', $category['id'])); ?></h4>
        <p> <?php echo $category['description']; ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
</div>
<?php endif;?>