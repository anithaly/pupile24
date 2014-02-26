<?php
class Category extends AppModel {
	var $name = 'Category';
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
				'message' => 'Opis może mieć max. 255 znaków',
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'categories_id',
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

	var $belongsTo = array(
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'sections_id',
			'conditions' => '',
			'fields' => array('id', 'name'),
			'order' => ''
		),
	);

}
