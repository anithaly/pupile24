<div class="paginator">
  <span class="info"><?php echo $this->Paginator->counter(array('format' => __('Strona %page% z %pages% | Wyświetlanie %current% z %count%', true)));?></span>
  <span class="paging">
    <?php echo $this->Paginator->prev('« poprzednia', array(), null, array('class'=>'disabled'));?> |
    <?php echo $this->Paginator->numbers();?> |
    <?php echo $this->Paginator->next('następna »', array(), null, array('class' => 'disabled'));?>
  </span>
</div>