<h2>
<?php echo $this->Html->link('Forum', array('controller' => 'sections', 'action' => 'index'));?> > 
<?php echo $this->Html->link($post['Topic']['Category']['Section']['name'], array('controller' => 'sections', 'action' => 'view', $post['Topic']['Category']['Section']['id']));?> > 
<?php echo $this->Html->link($post['Topic']['Category']['name'], array('controller' => 'categories', 'action' => 'view', $post['Topic']['Category']['id']));?> > 
<?php echo $this->Html->link($post['Topic']['name'], array('controller' => 'topics', 'action' => 'view', $post['Topic']['id'])); ?>
</h2>

<div class="post form">
<?php echo $this->Form->create('Post');?>
	<fieldset>
 		<legend>Edycja posta</legend>
	<div>Post nalezy do: <?php echo $post['Owner']['name'];?>, utworzony <?php echo $post['Post']['created'];?></div>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('text',array('label' => 'Tekst'));
		echo $this->Form->hidden('owners_id',array('value' => $post['Post']['owners_id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Zmień', true));?>
</div>
<div class="actions">
		<h3>Działy forum</h3>
	<ul>
		<li><?php echo $this->Html->link(__('Powrót do tematu', true), array('controller' => 'topics', 'action' => 'view', $post['Post']['topics_id'])); ?> </li>
	</ul>
</div>
