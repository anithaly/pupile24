<?php
class ArticleComment extends AppModel {
	var $name = 'ArticleComment';
	var $displayField = 'text';

	var $validate = array(
		'text' => array(
			'maxlength' => array(
				'rule' => array('maxlength',1000),
				'message' => 'Max. liczba znaków to 1000',
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
		'articles_id' => array(
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
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'articles_id',
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
		),
	);
}
