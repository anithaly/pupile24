<?php
class RacesController extends AppController {

	var $name = 'Races';
	var $components = array('Auth', 'Security');
	var $paginate = array(
	'Pet' => array(
		'limit' => 5, 
		'order' => array('Pet.created' => 'desc'), 
		'contain' => array("Owner", "PetsAvatar" ),
	),
	);

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
		$this->Auth->allow('index');
	}

	/*
	 * All pets of one race
	 */
	function index($id_race = null) {
		$this->set('title_for_layout', 'Katalog zwierząt - Serwis społecznościowy dla właścicieli zwierząt');
		if (empty($id_race)) {
			$this->Session->setFlash(__('Nie ma takiego kryterium wyszukiwania', true));
			$this->cakeError('error404');
			$this->redirect(array('controller' => 'pets', 'action' => 'index'));
		}
		else {	
			$race = $this->Race->find('first', array( 'conditions' => array('Race.id' => $id_race)));	
			$this->set('race', $race);
			if (!empty($race)) {
				$pets = $this->paginate('Pet', array('Pet.races_id' => $id_race));
				$this->set('pets', $pets);
			}
			else {
				$this->Session->setFlash(__('Nie ma takiego kryterium wyszukiwania', true));
				$this->cakeError('error404');
				$this->redirect(array('controller' => 'pets', 'action' => 'index'));
			}
		}
	}

/** not now
	function add() {
		if (!empty($this->data)) {
			$this->Race->create();
			if ($this->Race->save($this->data)) {
				$this->Session->setFlash(__('The race has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The race could not be saved. Please, try again.', true));
			}
		}
		$species = $this->Race->Species->find('list');
		$this->set(compact('species'));
	}
*/
	


/** ADMIN **/
	function admin_index() {
		$this->Race->recursive = 0;
		$this->set('races', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid race', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('race', $this->Race->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Race->create();
			if ($this->Race->save($this->data)) {
				$this->Session->setFlash(__('The race has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The race could not be saved. Please, try again.', true));
			}
		}
		$species = $this->Race->Species->find('list');
		$this->set(compact('species'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid race', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Race->save($this->data)) {
				$this->Session->setFlash(__('The race has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The race could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Race->read(null, $id);
		}
		$species = $this->Race->Species->find('list');
		$this->set(compact('species'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for race', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Race->delete($id)) {
			$this->Session->setFlash(__('Race deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Race was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
