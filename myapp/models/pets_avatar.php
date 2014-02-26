<?php
class PetsAvatar extends AppModel {
	var $name = 'PetsAvatar';
	var $displayField = 'name';
	var $validate = array(
		'name' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 255),
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'pets_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
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
}
