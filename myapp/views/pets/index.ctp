<div class="pets index">
  <h2>Katalog zwierzaków</h2>
  <ul class="list pets grid">
  <?php foreach ($pets as $pet):?>
    <li>
      <div class="avatar">
        <?php echo $this->Pets->petsAvatar($pet['PetsAvatar'],$pet['Pet']);?>
      </div>
      <span class="name"><?php echo $this->Html->link($pet['Pet']['name'], array('action' => 'pet', $pet['Pet']['id'])); ?></span>
      <span class="date">Dołączył: <?php echo $pet['Pet']['created']; ?></span>
      <span class="owner">Właściciel: <?php echo $this->Html->link($pet['Owner']['name'], array('controller' => 'owners','action' => 'profil', $pet['Owner']['id'])); ?></span>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php //echo $this->element('shared/paginator'); ?>
  <div class="paginator">
    <span class="info"><?php echo $this->Paginator->counter(array('format' => __('Strona %page% z %pages% | Pupilów %current% z %count%', true)));?></span>
    <span class="paging">
      <?php echo $this->Paginator->prev('« poprzednia', array(), null, array('class'=>'disabled'));?> |
      <?php echo $this->Paginator->numbers();?> |
      <?php echo $this->Paginator->next('następna »', array(), null, array('class' => 'disabled'));?>
    </span>
  </div>
</div>

<div class="actions">
  <h3>Lista gatunków</h3>
  <ul class="species">
  <?php foreach ($species as $specie): ?>
    <li class="specie"><?php echo $this->Html->link($specie['Specie']['name'].' ('.$specie['Specie']['pets_count'].')', array('controller' => 'species', 'action' => 'index', $specie['Specie']['id']));?>
    <?php if(count($specie['Race']) > 0):?>
    <ul class="races">
      <?php foreach ($specie['Race'] as $race): ?>
        <li class="race"><?php echo $this->Html->link($race['name'].' ('.$race['pets_count'].')', array('controller' => 'races', 'action' => 'index', $race['id']));?></li>
      <?php endforeach; ?>
    </ul>
    <?php endif;?>
    </li>
  <?php endforeach; ?>
  </ul>
</div>
