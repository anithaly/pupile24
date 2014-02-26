<div class="breadcrumb">
  <?php echo $this->Html->link($race['Specie']['name'], array('controller' => 'species', 'action' => 'index', $race['Specie']['id'])); ?> »
  <?php echo $race['Race']['name']; ?>
</div>

<div class="races index single">
  <h2><?php echo $race['Specie']['name'] . " " . $race['Race']['name']; ?></h2>
  <?php if (!empty($pets)) : ?>
  <ul class="list pets grid">
  <?php foreach ($pets as $pet):?>
    <li>
      <div class="avatar">
        <?php echo $this->Pets->petsAvatar($pet['PetsAvatar'],$pet['Pet']);?>
      </div>
      <span class="name"><?php echo $this->Html->link($pet['Pet']['name'], array('controller' => 'pets', 'action' => 'pet', $pet['Pet']['id'])); ?></span>
      <span class="date">Dołączył: <?php echo $pet['Pet']['created']; ?></span>
      <span class="owner">Właściciel: <?php echo $this->Html->link($pet['Owner']['name'], array('controller' => 'owners','action' => 'profil', $pet['Owner']['id'])); ?></span>
    </li>
    <?php endforeach; ?>
  </ul>
  <?php echo $this->element('shared/paginator'); ?>
  <?php else:?>
    <p>Brak zwierzaków do wyświetlenia</p>
  <?php endif;?>
</div>
