<?php
class Pet extends AppModel {
	var $name = 'Pet';
	var $displayField = 'name';
	var $actsAs = array('Containable');
	var $validate = array(
		'name' => array(
			'maxlength' => array(
				'rule' => array('maxlength',255),
				'message' => 'Max. liczba znaków to 255',
			),
			'minlength' => array(
				'rule' => array('minlength',2),
				'message' => 'Min. ilość znaków to 2',
			),
			'notempty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Podaj imię pupila',
			),
		),
		'age' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Wymagana liczba całkowita',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Podaj rok urodzenia',
			),
		),
		'description' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 1000),
				'message' => 'Max. liczba znaktów to 1000',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'activities' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 1000),
				'message' => 'Max. liczba znaktów to 1000',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'food' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 1000),
				'message' => 'Max. liczba znaktów to 1000',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'species_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wybierz gatunek z listy',
			),
		),
		'races_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wybierz rasę z listy',
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

	var $hasOne = array(
		'PetsAvatar' => array(
			'className' => 'PetsAvatar',
			'foreignKey' => 'pets_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $belongsTo = array(
		'Specie' => array(
			'className' => 'Specie',
			'foreignKey' => 'species_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
      'counterCache' => 'pets_count'
		),
		'Race' => array(
			'className' => 'Race',
			'foreignKey' => 'races_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
      'counterCache' => 'pets_count'
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
		'Fan' => array(
			'className' => 'Fan',
			'foreignKey' => 'pets_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PetsPhoto' => array(
			'className' => 'PetsPhoto',
			'foreignKey' => 'pets_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Status' => array(
			'className' => 'Status',
			'foreignKey' => 'pets_id',
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
