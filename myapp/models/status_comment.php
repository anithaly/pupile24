<?php
class StatusComment extends AppModel {
	var $name = 'StatusComment';
	var $displayField = 'text';
	var $validate = array(
		'text' => array(
			'maxlength' => array(
				'rule' => array('maxlength',2000),
				'message' => 'Max. liczba znaków to 2000',
			),
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'status_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'status_id',
			'conditions' => '',
			'fields' => array('id', 'name'),
			'order' => ''
		),
		'Owner' => array(
			'className' => 'Owner',
			'foreignKey' => 'owners_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
