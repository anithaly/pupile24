<?php
  if(isset($javascript)) {
  	echo str_replace('/pets','',$javascript->link('imgareaselect/scripts/jquery.imgareaselect.min.js'));
  }
?>

<h3>Przytnij zdjęcie</h3>

<?php 
	echo $form->create('PetsAvatar', array('action' => 'createimage_step3'));    
	echo $cropimage->createJavaScript($uploaded['imageWidth'],$uploaded['imageHeight'],100,100); 
	echo $form->hidden('name');
	echo $form->hidden('pets_id');
	echo $cropimage->createForm($uploaded["imagePath"],100 , 100 ); // imagePath == imageName to nazwa
	echo $form->submit('Gotowe', array("id"=>"save_thumb"));
	echo $form->end();
?> 