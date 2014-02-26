<?php
class OwnersAvatar extends AppModel {
	var $name = 'OwnersAvatar';
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
		'owners_id' => array(
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
		'Owner' => array(
			'className' => 'Owner',
			'foreignKey' => 'owners_id',
			'conditions' => '',
			'fields' => array('id', 'name'),
			'order' => ''
		)
	);
}
