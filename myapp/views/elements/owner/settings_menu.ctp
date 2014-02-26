<div class="actions">
  <h3>Ustawienia</h3>
  <ul>
    <li><?php echo $this->Html->link('Zmień hasło', array ('controller' => 'owners', 'action' => 'password')); ?></li>
    <li><?php echo $this->Html->link('Edytuj profil', array ('controller' => 'owners', 'action' => 'edit')); ?></li>
    <li><?php echo $this->Html->link('Zmień avatar', array ('controller' => 'owners_avatars', 'action' => 'add')); ?></li>
  </ul>
</div>
