<div id="dashboard">
  <?php if($this->Session->read('Auth.Owner')):?>
  <div class="logged-info">
    Zalogowany: <strong><?php echo $this->Session->read('Auth.Owner.name'); ?> </strong> 
    <?php if ($this->Session->read('Auth.Owner.admin') == 1 ): ?>
      <span class="role admin">Administrator</span>
    <?php endif; ?>
  </div>
  <?php else:?>
    <div class="logged-info">Witaj nieznajomy!</div>
  <?php endif;?>
  <ul class="dashoard-nav">
  <?php if (!$this->Session->read('Auth.Owner')): ?>
    <li><?php echo $this->Html->link('Zaloguj się »', array ('controller' => 'owners', 'action' => 'login')); ?></li>
    <li><?php echo $this->Html->link('Zarejestruj się »', array ('controller' => 'owners', 'action' => 'add')); ?></li>
  <?php else:?>
    <li><?php echo $this->Html->link('Wiadomości', array ('controller' => 'messages', 'action' => 'index', 'admin' => false)); ?></li>
    <li><?php echo $this->Html->link('Aktualności', array ('controller' => 'owners', 'action' => 'home', 'admin' => false)); ?></li> 
    <li><?php echo $this->Html->link('Profil', array ('controller' => 'owners', 'action' => 'profil', 'admin' => false)); ?></li>
    <li><?php echo $this->Html->link('Moi pupile', array ('controller' => 'pets', 'action' => 'mypets', 'admin' => false)); ?></li>
    <li><?php echo $this->Html->link('Moje artykuły', array ('controller' => 'articles', 'action' => 'myarticles', 'admin' => false)); ?></li>
    <li><?php echo $this->Html->link('Znajomi', array ('controller' => 'friends', 'action' => 'index', 'admin' => false)); ?></li>
    <li><?php echo $this->Html->link('Ustawienia', array ('controller' => 'owners', 'action' => 'settings', 'admin' => false)); ?></li>
    <li><?php echo $this->Html->link('Wyloguj się »', array ('controller' => 'owners', 'action' => 'logout', 'admin' => false)); ?></li>
  <?php endif; ?>    
  </ul>
</div>