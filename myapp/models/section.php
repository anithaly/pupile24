<?php
class Section extends AppModel {
	var $name = 'Section';
	var $displayField = 'name';
	var $actsAs = array('Containable');
	var $validate = array(
		'name' => array(
			'maxlength' => array(
				'rule' => array('maxlength',255),
				'message' => 'Nazwa może mieć max. 255 znaków',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Nazwa nie może być pusta',
			),
		),
		'description' => array(
			'maxlength' => array(
				'rule' => array('maxlength',255),
				'message' => 'Opis nie może być pusty',
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'sections_id',
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
