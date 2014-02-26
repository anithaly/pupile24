<ul class="site-nav">
<?php if (!($this->Session->read('Auth.Owner.admin') == 1 )): ?>
  <li><?php echo $this->Html->link('Strona główna', array ('controller' => 'pages', 'action' => 'home')); ?></li>
  <li><?php echo $this->Html->link('Artykuły', array ('controller' => 'articles', 'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link('Forum', array ('controller' => 'sections', 'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link('Katalog zwierzaków', array ('controller' => 'pets', 'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link('Użytkownicy', array ('controller' => 'owners', 'action' => 'index')); ?></li>
  <li><?php echo $this->Html->link('Mapa serwisu', array ('controller' => 'pages', 'action' => 'map')); ?></li>
<?php else: ?>
  <li><?php echo $this->Html->link('Strona główna', array ('controller' => 'pages', 'action' => 'home', 'admin' => false)); ?></li>
  <li><?php echo $this->Html->link('Artykuły', array ('controller' => 'articles', 'action' => 'index', 'admin' => false)); ?></li>
  <li><?php echo $this->Html->link('Forum', array ('controller' => 'sections', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link('Katalog zwierzaków', array ('controller' => 'pets', 'action' => 'index', 'admin' => false)); ?></li>
  <li><?php echo $this->Html->link('Użytkownicy', array ('controller' => 'owners', 'action' => 'index', 'admin' => true)); ?></li>
  <li><?php echo $this->Html->link('Mapa serwisu', array ('controller' => 'pages', 'action' => 'map', 'admin' => false)); ?></li>
<?php endif; ?>
</ul>