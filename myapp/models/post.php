<?php
class Post extends AppModel {
	var $name = 'Post';
	var $displayField = 'text';
	var $actsAs = array('Containable');
	var $validate = array(
		'text' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wpisz tekst',
			),
			'maxlength' => array(
				'rule' => array('maxlength',100000),
				'message' => 'Post może mieć max. 100000 znaków',
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
		'topics_id' => array(
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
		'Owner' => array(
			'className' => 'Owner',
			'foreignKey' => 'owners_id',
			'conditions' => '',
			'fields' => array('id', 'name'),
			'order' => ''
		),
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'topics_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
