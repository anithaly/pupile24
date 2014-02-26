<?php
class Fan extends AppModel {
	var $name = 'Fan';
	var $actsAs = array('Containable');
	var $validate = array(
		'owners_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'pets_id' => array(
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
			'fields' => '',
			'order' => ''
		),
		'Pet' => array(
			'className' => 'Pet',
			'foreignKey' => 'pets_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
