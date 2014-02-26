<div class="petsPhotos index">
	<h2>Zdjęcia <?php echo $this->Html->link($pet['Pet']['name'], array('controller' => 'pets', 'action' => 'pet', $pet['Pet']['id'])); ?></h2>

	<?php if (!empty($petsPhotos)):?>
		<table>
		<tr>
			<th></th>
			<th><?php echo $this->Paginator->sort('Dodano','created');?></th>
			<th><?php echo $this->Paginator->sort('Opis','description');?></th>
			<th><?php echo $this->Paginator->sort('Tytuł','title');?></th>
			<th></th>
		</tr>
		<?php foreach ($petsPhotos as $petsPhoto):?>
		  <?php $thumb = '<img src="'. UPLOADS_PATH . 'small_' . $petsPhoto['PetsPhoto']['name'] . '" alt="' . $petsPhoto['PetsPhoto']['title'].'" />'; ?>
		<tr>
			<td><?php echo $this->Html->link($thumb, array('action' => 'view', $petsPhoto['PetsPhoto']['id']),array('escape' => false))?>
			<td><?php echo $petsPhoto['PetsPhoto']['created']; ?>&nbsp;</td>
			<td><?php echo $petsPhoto['PetsPhoto']['description']; ?>&nbsp;</td>
			<td><?php echo $petsPhoto['PetsPhoto']['title']; ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Zobacz', true), array('action' => 'view', $petsPhoto['PetsPhoto']['id'])); ?>
				<?php echo $this->Html->link(__('Usuń', true), array('action' => 'delete', $petsPhoto['PetsPhoto']['id']), null, sprintf(__('Jesteś pewny, że chcesz usunąć zdjęcie p.t. %s?', true), $petsPhoto['PetsPhoto']['title'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</table>

	<?php else: ?>
		<p><?php echo $pet['Pet']['name']?> Nie ma jeszcze żadnych zdjęć</p>
	<?php endif; ?>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('Poprzednie', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('Następne', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">

	<ul>
		<li><?php echo $this->Html->link(__('Dodaj zdjęcia', true), array('action' => 'add', $pet['Pet']['id'])); ?></li>
	</ul>

</div>
