<div class="breadcrumb">
  <?php echo $this->Html->link("Katalog zwierzaków", array("controller" => 'pets', 'action' => 'index'));?> »
  <?php echo $specie['Specie']['name']; ?>
</div>

<div class="species index single">
<h2><?php echo $specie['Specie']['name']; ?></h2>

<?php if (isset($races)) : ?>
	<ul>
	<?php foreach ($races as $race): ?>
			<li><?php echo $this->Html->link(__($race['Race']['name'], true), array('controller' => 'races', 'action' => 'index', $race['Race']['id'])); ?></li>
	<?php endforeach; ?>
	</ul>
  <?php echo $this->element('shared/paginator'); ?>

<?php else: ?>
	<span>Nie mamy jeszcze żadncyh ras/gatunków/padgatunków itp. w serwisie.</span>
<?php endif; ?>
</div>