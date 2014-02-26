<div class="actions">
  <h3>Artykuły</h3>
  <ul>
    <li><?php echo $this->Html->link("Wszystkie artykuły", array('action' => 'index')); ?></li>
    <li><?php echo $this->Html->link("Moje artykuły", array('action' => 'myarticles')); ?></li>    
    <li><?php echo $this->Html->link(__('Dodaj artykuł', true), array('action' => 'add')); ?></li>
  </ul>
</div>
