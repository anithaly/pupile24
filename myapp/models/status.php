<?php
class Status extends AppModel {
	var $name = 'Status';
	var $displayField = 'text';
	var $validate = array(
		'text' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wpisz tekst',
			),
			'maxlength' => array(
				'rule' => array('maxlength', 255),
				'message' => 'Max. liczba znaków to 255',
			),
		),
		'pets_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				
			),
			'notempty' => array(
				'rule' => array('notempty'),
			
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Pet' => array(
			'className' => 'Pet',
			'foreignKey' => 'pets_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'StatusComment' => array(
			'className' => 'StatusComment',
			'foreignKey' => 'statuses_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
