<div id="pet">
	<div id="col1">
		<h2>Strona pupila</h2>
			<?php if ($pet['PetsAvatar']['name']): ?>
				<td><?php echo str_replace('/pets','',$html->image('/uploads/'.$pet['PetsAvatar']['name'], array('alt' => 'avatar'))); ?></td>
			<?php else: ?>
				<td><?php echo $html->image('av_padfoot.gif', array('alt' => 'avatar')); ?></td>
			<?php endif; ?>
			<h3><?php echo $this->Html->link($pet['Pet']['name'], array('controller' => 'pets', 'action' => 'pet', $pet['Pet']['id'])); ?></h3>
			<?php if ($this->Session->read('Auth.Owner.id') == $pet['Pet']['owners_id']): ?> 
				<div><?php echo $this->Html->link('Edytuj', array('action' => 'edit', $pet['Pet']['id'])); ?></div>
			<?php endif; ?>
			<div><?php echo $this->Html->link('Zostań fanem', array('controller' => 'fans', 'action' => 'fan', $pet['Pet']['id'])); ?></div>
			<h4>Wiek</h4>
			<div><?php echo (date('Y')-$pet['Pet']['age']); ?></div>
			<h4>Gatunek</h4>
			<div>
			<?php echo $this->Html->link($pet['Specie']['name'], array('controller' => 'species', 'action' => 'index')); ?>
			</div>
			<h4>Rasa</h4>
			<?php echo $this->Html->link($pet['Race']['name'], array('controller' => 'races', 'action' => 'index')); ?>
			<h4>Dołączył</h4>
			<div><?php echo $pet['Pet']['created']; ?></div>
			<h4>Właściciel</h4>
			<div><?php echo $this->Html->link($pet['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $pet['Owner']['id'])); ?></div>
			<?php if ($pet['Pet']['activities']): ?>
			<h4>Aktywność</h4>
				<div><?php echo $pet['Pet']['activities']; ?></div>
			<?php endif; ?>
			<?php if ($pet['Pet']['food']): ?>
				<h4>Karma</h4>
				<div><?php echo $pet['Pet']['food']; ?></div>
			<?php endif; ?>
			<?php if ($pet['Pet']['description']): ?>
				<h4>Opis</h4>
				<div><?php echo $pet['Pet']['description']; ?></div>
			<?php endif; ?>	
	</div><!-- col1 -->

	<div id="col2">
		<div class="statuses">
			<?php echo $this->Form->create('Status', array('controller' => 'statuses', 'action' => 'add'));?>
				<?php   
					echo $this->Form->input('text');
					echo $this->Form->hidden( 'pets_id', array( 'value' => $pet['Pet']['id'] ) ); 
				?>
			<?php echo $this->Form->end('Uaktualnij status');?>
		<?php if (!empty($statuses)): ?>
			<?php foreach ($statuses as $status): ?>
				<div><?php echo '<strong>'.$pet['Pet']['name'].'</strong> '.h(nl2br($status['Status']['text'])); ?></div>

					<?php foreach ($status['StatusComment'] as $statusComment):?>
						<div><?php echo $statusComment['owners_id'].': '.h(nl2br($statusComment['text'])); ?></div>
						<div><?php echo $statusComment['created']; ?></div>
					<?php endforeach; ?>

						<div class="statComments">
						<?php echo $this->Form->create('StatusComment', array('controller' => 'statusComment', 'action' => 'add'));?>
							<?php
								echo $this->Form->input('text', array('error' => false));
								echo $this->Form->hidden('statuses_id', array( 'value' => $status['Status']['id'] ) ); 
								echo $this->Form->hidden('pets_id', array( 'value' => $pet['Pet']['id'] ) ); 
							?>
						<?php echo $this->Form->end(__('Dodaj komentarz', true));?>
						</div>

				<span><?php echo $status['Status']['created']; ?></span>
			<?php endforeach; ?>
		<?php endif; ?>
		</div>

		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('Poprzednie', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
	 |
			<?php echo $this->Paginator->next(__('Nastepne', true) . ' >>', array(), null, array('class' => 'disabled'));?>
		</div>
	</div><!-- col2 -->

	<div id="col3">
		<div>Link do zdjęć</div>
		Lista fanów, Ostatnie Zdjęcia
		Lub naspisy brak fanów, brak zdjęć.
		
	</div><!-- col3 -->	
</div>
