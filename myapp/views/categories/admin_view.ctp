<div class="breadcrumb">
<?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?>  »   
<?php echo $this->Html->link($category['Section']['name'], array('controller' => 'sections', 'action' => 'view', $category['Section']['id'])) ;?>  »  
<?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])) ;?>
</div>


<div class="view">
  <h2><?php echo $category['Category']['name'];?></h2>
  <?php if(isset($category['Category']['description']) && $category['Category']['description'] != ''):?>
    <p><?php echo $category['Category']['name'];?></p>
  <?php endif;?>

  <?php if (!empty($category['Topic'])): ?>
    <ul class="list topics">
    <?php foreach($category['Topic'] as $topic): ?>
      <li>
        <h3>Temat: <?php echo $this->Html->link($topic['name'], array('controller' => 'topics', 'action' => 'view', $topic['id']));?></h3>
        <?php if(isset($topic['description']) && $topic['description'] != ''):?>
          <p><?php echo $topic['description']; ?></p>
        <?php endif;?>
		<?php echo $this->Html->link('Edytuj', array('controller' => 'topics', 'action' => 'edit', $topic['id']));?>
		<?php echo $this->Html->link('Usuń', array('controller' => 'topics', 'action' => 'delete', $topic['id']));?>
        <span class="meta">Utworzony przez <?php echo $topic['Owner']['name'];?> w dniu <?php echo $topic['created'];?></span>
      </li>
    <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>


<div class="actions">
 <h3>Tematy</h3>
	<ul>
	    	<li><?php echo $this->Html->link(__('Nowy temat', true), array('controller' => 'topics', 'action' => 'add', $category['Category']['id'])); ?></li>
		<li><?php echo $this->Html->link(__('Edycja tej kategorii', true), array('controller' => 'categories', 'action' => 'edit', $category['Category']['id'])); ?></li>
	</ul>
</div>
