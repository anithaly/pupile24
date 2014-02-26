<?php
class Article extends AppModel {
	var $name = 'Article';
	var $displayField = 'title';

	var $actsAs = array('Containable');
	
	var $validate = array(
		'title' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 150),
				'message' => 'Max. liczba znaków to 150',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Podaj tytuł',
			),
		),
		'text' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 500000),
				'message' => 'Max. liczba znaków to 500000',
			),
			'minlength' => array(
				'rule' => array('minlength', 1000),
				'message' => 'Min. ilość znaków to 1000',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wpisz tekst',
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
		'Owner' => array(
			'className' => 'Owner',
			'foreignKey' => 'owners_id',
			'conditions' => '',
			'fields' => array('id', 'name'),
			'order' => ''
		)
	);

	var $hasMany = array(
		'ArticleComment' => array(
			'className' => 'ArticleComment',
			'foreignKey' => 'articles_id',
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
