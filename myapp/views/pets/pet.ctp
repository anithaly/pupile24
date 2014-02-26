<div id="pet">
  <h2>Strona pupila: <?php echo $pet['Pet']['name'];?></h2>  
  <div id="col1">
    <div class="avatar">
      <?php echo $this->Pets->petsAvatar($pet['PetsAvatar'],$pet['Pet']);?>
    </div>
    <div class="pet-actions">
    <?php if($this->Session->read('Auth.Owner.id')): ?>
      <?php if ($this->Session->read('Auth.Owner.id') == $pet['Pet']['owners_id']): ?> 
        <?php echo $this->Html->link(__('Zmień avatar', true), array('controller' => 'petsAvatars', 'action' => 'add', $pet['Pet']['id'])); ?> |
        <?php echo $this->Html->link('Edytuj informacje', array('action' => 'edit', $pet['Pet']['id'])); ?>
      <?php endif; ?>
      <?php if ((!$fan) &&(!($this->Session->read('Auth.Owner.id') == $pet['Pet']['owners_id']))): ?> 
        <?php echo $this->Html->link('Zostań fanem', array('controller' => 'fans', 'action' => 'add', $pet['Pet']['id'])); ?>
      <?php elseif((!($this->Session->read('Auth.Owner.id') == $pet['Pet']['owners_id'])) && ($fan)): ?>
        <?php echo $this->Html->link('Przestań być fanem', array('controller' => 'fans', 'action' => 'rm', $pet['Pet']['id'])); ?>
      <?php endif; ?>      
    <?php endif; ?>
    </div>
    
    <div class="pet-details">
      <h3>Informacje</h3>
      <p>Wiek: <?php echo (date('Y')-$pet['Pet']['age']); ?></p>
      <p>Rasa: <?php echo $this->Html->link($pet['Specie']['name'], array('controller' => 'species', 'action' => 'index', $pet['Specie']['id'])); ?></p>
      <p>Gatunek / Rodzaj: <?php echo $this->Html->link($pet['Race']['name'], array('controller' => 'races', 'action' => 'index', $pet['Race']['id'])); ?></p>
      <p>Dołączył: <?php echo $pet['Pet']['created']; ?></p>
      <p>Właściciel: <?php echo $this->Html->link($pet['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $pet['Owner']['id'])); ?></p>
      <?php if ($pet['Pet']['activities']): ?>
        <div>Aktywność:<br/>
          <p><?php echo $pet['Pet']['activities']; ?></p>
        </div>
      <?php endif; ?>    
      <?php if ($pet['Pet']['food']): ?>
        <div>Karma:
          <p><?php echo $pet['Pet']['food']; ?></p>
        </div>
      <?php endif; ?>
      <?php if ($pet['Pet']['description']): ?>
        <div>Opis:
          <p><?php echo $pet['Pet']['description']; ?></p>
        </div>
      <?php endif; ?>  
    </div>

    <div class="pet-fans">
      <h3>Fani</h3>
      <?php if(!empty($pet['Fan'])):?>
        <ul>
          <?php foreach($pet['Fan'] as $fan) :?>
            <li><?php echo $this->Html->link($fan['Owner']['name'], array('controller' => 'owners', 'action' => 'profil', $fan['Owner']['id']));?></li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
      <span>Brak fanów</span>
    <?php endif; ?>
    </div>
  </div><!-- col1 -->

  <div id="col2">
    <div class="pet-statuses">
      <h3>Wpisy</h3>
      <?php if ($this->Session->read('Auth.Owner.id') == $pet['Pet']['owners_id']): ?> 
        <?php echo $this->Form->create('Status', array('controller' => 'statuses', 'action' => 'add'));?>
          <?php   
            echo $this->Form->input('text');
            echo $this->Form->hidden( 'pets_id', array( 'value' => $pet['Pet']['id'] ) ); 
            ?>
          <?php echo $this->Form->end('Uaktualnij status');?>
        <?php endif; ?>


      <?php if (!empty($statuses)): ?>
      <?php foreach ($statuses as $status): ?>
	<div class="status">
        <p class="status"><?php echo '<strong>'.$pet['Pet']['name'].':</strong> '.nl2br(h($status['Status']['text'])); ?>
          <br/><small><?php echo $status['Status']['created']; ?></small>
        </p>
		<div class="statComment">
		<?php if (!empty($status['StatusComment'])): ?>
			  <?php foreach ($status['StatusComment'] as $statusComment):?>
				<div><strong><?php echo $statusComment['Owner']['name']; ?></strong>: <?php echo nl2br(h($statusComment['text'])); ?></div>
			    <small><?php echo $statusComment['created']; ?></small>
			  <?php endforeach; ?>
		<?php endif; ?>

		  <?php if ($this->Session->read('Auth.Owner.id')): ?> 
		    <div class="formStatComments">
		    <?php echo $this->Form->create('StatusComment', array('controller' => 'statusComment', 'action' => 'add'));?>
		      <?php
		        echo $this->Form->input('text', array('label' => 'Wpisz tekst komentarza'));
		        echo $this->Form->hidden('statuses_id', array( 'value' => $status['Status']['id'] ) ); 
		        echo $this->Form->hidden('pets_id', array( 'value' => $pet['Pet']['id'] ) ); 
		      ?>
		        <?php echo $this->Form->end(__('Dodaj komentarz', true));?>
		    </div>
		<?php endif; ?>
	        </div>
	</div>
      <?php endforeach; ?>
    <?php else: ?>
      <span>Brak wpisów</span>
    <?php endif; ?>
    </div>

<div class="paginator">
  <span class="info"><?php echo $this->Paginator->counter(array('format' => __('Strona %page% z %pages% | Statusy %current% z %count%', true)));?></span>
  <span class="paging">
    <?php echo $this->Paginator->prev('« poprzednia', array(), null, array('class'=>'disabled'));?> |
    <?php echo $this->Paginator->numbers();?> |
    <?php echo $this->Paginator->next('następna »', array(), null, array('class' => 'disabled'));?>
  </span>
</div>
  </div><!-- col2 -->

  <div id="col3">
    <h3>Zdjęcia</h3>
    <div>
    <?php if(!empty($pet['PetsPhoto'])):?>
      <?php foreach($pet['PetsPhoto'] as $photo) :?>
        <?php $thumb = '<img src="'. UPLOADS_PATH . 'small_' . $photo['name'] . '" alt="' . $photo['title'].'" />'; ?>
        <?php echo $this->Html->link($thumb, array('action' => 'view', 'controller' => 'pets_photos', $photo['id']),array('escape' => false))?>
      <?php endforeach; ?>
    <?php else: ?>
      <span>Brak zdjęć</span>
    <?php endif; ?>
    </div>
    
  </div><!-- col3 -->  
</div>
