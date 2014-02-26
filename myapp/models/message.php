<?php
class Message extends AppModel {
	var $name = 'Message';
	var $displayField = 'title';

	var $actsAs = array('Containable');
	
	var $validate = array(
		'title' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 150),
				'message' => 'Max. liczba znaków to 150',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Podaj tytuł',
			),
		),
		'text' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 1000),
				'message' => 'Max. liczba znaków to 1000',
			),
			'minlength' => array(
				'rule' => array('minlength', 3),
				'message' => 'Min. ilość znaków to 3',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wpisz tekst',
			),
		),
		'sender_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
  	'recipient_id' => array(
  		'numeric' => array(
  			'rule' => array('numeric'),
  		),
  		'notempty' => array(
  			'rule' => array('notempty'),
  		),
  	),
		
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Sender' => array(
			'className' => 'Owner',
			'foreignKey' => 'sender_id',
			'fields' => array('id', 'name'),
			'order' => ''
		),
		'Recipient' => array(
			'className' => 'Owner',
			'foreignKey' => 'recipient_id',
			'fields' => array('id', 'name'),
		)
	);

}
