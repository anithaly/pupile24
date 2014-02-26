<?php
	if(isset($javascript)):
		echo $javascript->link('imgareaselect/scripts/jquery.imgareaselect.min.js');
	endif; 

?>

<?php 
        echo $form->create('PetsPhoto', array('action' => 'createimage_step3'));    
	echo $cropimage->createJavaScript($uploaded['imageWidth'],$uploaded['imageHeight'],100,100); 
        echo $form->hidden('name');
	echo $form->hidden('description');
	echo $form->hidden('pets_id');
	echo $cropimage->createForm($uploaded["imagePath"],100 , 100 ); 
        echo $form->submit('Gotowe', array("id"=>"save_thumb"));
echo $form->end();?> 
