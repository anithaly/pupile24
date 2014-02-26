<?php
class SpeciesController extends AppController {

	var $name = 'Species';
	var $components = array('Auth', 'Security');
	var $uses = array('Race','Specie');
	var $paginate = array(
		'Race' => array(
			'limit' => 30, 
			'order' => array('Race.id' => 'asc'), 
			//'contain' => array('Species'),
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
	 * All races fo one pet's specie
	 */
	function index($id_specie = null) {
		$this->set('title_for_layout', 'Katalog zwierząt - Serwis społecznościowy dla właścicieli zwierząt');
		if (empty($id_specie)) {
			$this->Session->setFlash(__('Nie ma takiego kryterium wyszukiwania', true));
			$this->cakeError('error404');
			$this->redirect(array('controller' => 'pets', 'action' => 'index'));
		}
		else {	
			$specie = $this->Specie->find('first', array( 'conditions' => array('Specie.id' => $id_specie)));	
			$this->set('specie', $specie);
			if (!empty($specie)) {
				$races = $this->paginate('Race', array('Race.species_id' => $id_specie));
				//$races = $this->paginate();
				if (!empty($races)) {
					$this->set('races', $races);
				}
			}
			else {
				$this->Session->setFlash(__('Nie ma takiego kryterium wyszukiwania', true));
				$this->cakeError('error404');
				$this->redirect(array('controller' => 'pets', 'action' => 'index'));
			}
		}
	}

/* not now
	function add() {
		if (!empty($this->data)) {
			$this->Species->create();
			if ($this->Species->save($this->data)) {
				$this->Session->setFlash(__('The species has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The species could not be saved. Please, try again.', true));
			}
		}
	}
*/


/** ADMIN **/

	function admin_index() {
		$this->Species->recursive = 0;
		$this->set('species', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid species', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('species', $this->Species->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Species->create();
			if ($this->Species->save($this->data)) {
				$this->Session->setFlash(__('The species has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The species could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid species', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Species->save($this->data)) {
				$this->Session->setFlash(__('The species has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The species could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Species->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for species', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Species->delete($id)) {
			$this->Session->setFlash(__('Species deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Species was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
