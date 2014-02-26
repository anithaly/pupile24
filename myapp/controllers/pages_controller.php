<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */

class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', 'Text', 'Ajax');

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	var $components = array('Auth','Security','Session');
	
	function beforeFilter() {
		$this->Auth->allow('display','home');
		parent::beforeFilter();
	}

	function display() {
		$path = func_get_args();

		if($subpage = 'home'){
			$this->home();
		}

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = 'Serwis społecznościowy dla właścicieli zwierząt';

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			if(!isset($title_for_layout))
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}

	/**
	 * Home page, for logged and unlogged users
	 * Last Pets
	 * Last Articles
	 * Last Photos
	 */
	function home() {
		//$this->set('title_for_layout', 'Strona główna - Serwis społecznościowy dla właścicieli zwierząt');
		App::import('Model', 'Pet');
		App::import('Model', 'Article');
		App::import('Model', 'PetsPhoto');

		$Pet = new Pet();
		$Article = new Article();
		$PetsPhoto = new PetsPhoto();

		$total_pets = $Pet->find('count');
		$this->set('total_pets', $total_pets);

		$total_photos = $PetsPhoto->find('count');
		$this->set('total_photos', $total_photos);

		$total_articles = $Article->find('count');
		$this->set('total_articles', $total_articles);

		$last_pets = $Pet->find('all',array('limit' => 8, 'order' => 'Pet.created DESC')); 
		$this->set(compact('last_pets'));

		$last_articles =  $Article->find('all',array('limit' => 6, 'order' => 'Article.created DESC')); 
		$this->set(compact('last_articles'));

		$last_photos =  $PetsPhoto->find('all',array('limit' => 6, 'order' => 'PetsPhoto.created DESC')); 
		$this->set(compact('last_photos'));

	}
}
