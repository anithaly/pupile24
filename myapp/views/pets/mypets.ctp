<div class="actions">
  <h3>Pupile</h3>
  <ul>
    <li><?php echo $this->Html->link('Dodaj pupila', array ('controller' => 'pets', 'action' => 'add')); ?></li>
  </ul>
</div>

<div class="messages index">
	<h2>Moi pupile</h2>
	<?php if (!empty($my_pets)): ?>
	
		<table>

			<?php foreach ($my_pets as $pet): ?>
			<tr>	
				<?php if ($pet['PetsAvatar']['name']): ?>
					<td><?php echo $html->image('/uploads/'.$pet['PetsAvatar']['name'], array('alt' => 'avatar')); ?></td>
				<?php else: ?>
					<td><?php echo $html->image('av_padfoot.gif', array('alt' => 'avatar')); ?></td>
				<?php endif; ?>
				<td><h3><?php echo $this->Html->link(__($pet['Pet']['name'], true), array('action' => 'pet', $pet['Pet']['id'])); ?></h3></td>
				<td><?php echo $this->Html->link(__('Zmień avatar', true), array('controller' => 'petsAvatars', 'action' => 'add', $pet['Pet']['id'])); ?></td>
				<td><?php echo $this->Html->link(__('Zarządzaj zdjęciami', true), array('controller' => 'petsPhotos', 'action' => 'index', $pet['Pet']['id'])); ?></td>
				<td>Dodany:<br /><?php echo $pet['Pet']['created']; ?></td>
				<td><?php echo $this->Html->link(__('Edytuj', true), array('action' => 'edit', $pet['Pet']['id'])); ?></td>
				<td><?php echo $this->Html->link(__('Usuń', true), array('action' => 'delete', $pet['Pet']['id']), null, sprintf(__('Na pewno usunąć pupila %s?', true), $pet['Pet']['name'])); ?></td>	
			</tr>
			<?php endforeach; ?>

		</table>
	<?php else:?>
		<p>Nie masz jeszcze żadnych pupilów. </p>
	<?php endif; ?>
</div>
