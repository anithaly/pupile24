<?php
class Topic extends AppModel {
	var $name = 'Topic';
	var $displayField = 'name';
	var $actsAs = array('Containable');
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Nazwa nie może być pusta',
			),
			'maxlength' => array(
				'rule' => array('maxlength',255),
				'message' => 'Nazwa może mieć max. 255 znaków',
			),
		),
		'description' => array(
			'maxlength' => array(
				'rule' => array('maxlength',255),
				'message' => 'Opis może mieć max. 255 znaków',
			),
		),
		'categories_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'owners_id' => array(
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
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'categories_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Owner' => array(
			'className' => 'Owner',
			'foreignKey' => 'owners_id',
			'conditions' => '',
			'fields' => array('id', 'name'),
			'order' => ''
		)
	);

	var $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'topics_id',
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
