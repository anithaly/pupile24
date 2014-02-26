<?php
  if(isset($javascript)):
  echo str_replace('/pets','',$javascript->link('imgareaselect/scripts/jquery.imgareaselect.min.js'));
  endif; 
?>

<h3>Przytnij zdjęcie</h3>

<?php 
  echo $form->create('OwnersAvatar', array('action' => 'createimage_step3'));    
	echo $cropimage->createJavaScript($uploaded['imageWidth'],$uploaded['imageHeight'],100,100); 
  echo $form->hidden('name');
	echo $cropimage->createForm($uploaded["imagePath"],100 , 100 ); 
  echo $form->submit('Gotowe', array("id"=>"save_thumb"));
  echo $form->end();
?> 