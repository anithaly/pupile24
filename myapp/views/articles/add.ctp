<div class="breadcrumb">
  <?php echo $this->Html->link("Artykuły", array('action' => 'index')); ?> »
  <?php echo $this->Html->link("Moje artykuły", array('action' => 'myarticles')); ?> »
  Dodaj nowy artykuł
</div>
<div class="articles form">
<?php echo $this->Form->create('Article');?>
	<fieldset>
 		<legend>Dodaj nowy artykuł</legend>
	<?php
		echo $this->Form->input('title',array("label"  => "Tytuł artykułu"));
		echo $this->Form->input('text', array("label" => "Treść artykułu"));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Dodaj', true));?>
</div>


<?php echo $this->element('articles/menu');?>