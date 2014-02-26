<div class="breadcrumb">
  <?php echo $this->Html->link("Ustawienia", array('controller' => "owners", "action" => "settings"))?> »
  <?php echo $this->Html->link("Edycja avatara", array('controller' => "owners_avatars", "action" => "add"))?> »
  Krok 2: Przytnij
</div>

<?php
  if(isset($javascript)):
  echo str_replace('/pets','',$javascript->link('imgareaselect/scripts/jquery.imgareaselect.min.js'));
  endif; 
?>

<div class="ownersAvatars form">
<?php  echo $form->create('OwnersAvatar', array('action' => 'createimage_step3'));?>
  <fieldset>
	  <legend>Przytnij avatar</legend>
	  <?php echo $cropimage->createJavaScript($uploaded['imageWidth'],$uploaded['imageHeight'],100,100); ?>
    <?php echo $form->hidden('name'); ?>
	  <?php echo $cropimage->createForm($uploaded["imagePath"],100 , 100 ); ?>
  </fieldset>
  <?php echo $form->submit('Gotowe', array("id"=>"save_thumb")); ?>
<?php echo $form->end(); ?>
</div>

<div class="side">
  <h3>Podgląd:</h3>
  <?php echo $cropimage->avatarPreview($uploaded["imagePath"],100 , 100 ); ?>
</div>