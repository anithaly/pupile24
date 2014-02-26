<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
 
 //define("PETS_PHOTOS_PATH", 'http://anithaly.com/pets/img/');
 define("UPLOADS_PATH", FULL_BASE_URL . '/uploads/');
class AppController extends Controller {

	var $components = array('Auth','Security','Session');

	function beforeFilter(){
		$this->Auth->loginAction =  array('controller' => 'owners', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'owners', 'action' => 'home');
		$this->Auth->logoutRedirect = array('controller' => 'owners', "action" => "login");
		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
			);
		$this->Auth->authError = "Brak dostępu";
		$this->Auth->userModel = 'Owner';
		$this->Auth->authorize = 'controller';

		// add helpers
		$this->helpers[] = 'Javascript';
		$this->helpers[] = 'Ajax';
		$this->helpers[] = 'Pets';
	}


	function isAuthorized(){
		return true;
	}

}
