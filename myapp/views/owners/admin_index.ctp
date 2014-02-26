<div class="owners index">
	<h2><?php __('Owners');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('about');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($owners as $owner):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $owner['Owner']['created']; ?>&nbsp;</td>
		<td><?php echo $this->Html->link($owner['Owner']['name'], array('action' => 'profil', $owner['Owner']['id'], 'admin' => false)); ?></td>
		<td><?php echo $owner['Owner']['email']; ?>&nbsp;</td>
		<td><?php echo $owner['Owner']['about']; ?>&nbsp;</td>
		<td><?php echo $owner['Owner']['city']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edycja', true), array('action' => 'edit', $owner['Owner']['id'])); ?>
			<?php echo $this->Html->link(__('Usuń konto', true), array('action' => 'delete', $owner['Owner']['id']), null, sprintf(__('Na pewno usunąć konto użytkownika %s?', true), $owner['Owner']['name'])); ?>
			<?php echo $this->Html->link(__('Nadaj uprawnienia', true), array('action' => '', $owner['Owner']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Stroa %page% z %pages%.', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('Poprzednia', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('Nastepna', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3>Użytkownicy</h3>
	<ul>
		<li>Szukaj użytkownika</li>
	</ul>
</div>
