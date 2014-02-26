<?php
class PetsController extends AppController {

	var $name = 'Pets';
	var $components = array('Auth', 'Security');
	var $paginate = array(
		'Pet' => array(
			'limit' => 6, 
			'order' => array('Pet.created' => 'desc'), 
			'contain' => array('Status','Status.StatusComment', 'Status.StatusComment.Owner', "Owner", "PetsAvatar" ),
		),
    'Status' => array(
  		'limit' => 5, 
  		'order' => array('Status.created' => 'desc'), 
  		'contain' => array('StatusComment', 'StatusComment.Owner.name'),
  		'recursive' => 2
  	),		
	);

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index','pet');
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}		
	}

	/**
	 * Show me all pets in whole service
	 */
	function index() {
		$this->set('title_for_layout', 'Katalog zwierząt - Serwis społecznościowy dla właścicieli zwierząt');
		$this->Pet->recursive = 0;
		$this->set('pets', $this->paginate());
		$species = $this->Pet->Specie->find('all');
		$this->set('species', $species);
	}

	/**
	 * Show me all my pets
	 */
	function mypets() {
		$this->set('title_for_layout', 'Moi pupile - Serwis społecznościowy dla właścicieli zwierząt');
		$my_pets = $this->Pet->find('all',array('conditions' => array('owners_id' => $this->Auth->User('id'))));
		$this->set('my_pets', $my_pets);
	}

	/**
	 * Show me the one pet's page
	 * its statuses, comments and photos
	 * $id - pet's id
	 */
	function pet($id = null) {
		$this->set('title_for_layout', 'Profil pupila - Serwis społecznościowy dla właścicieli zwierząt');
		if (empty($id)) {
			$this->Session->setFlash(__('Nie ma takiej strony', true));
			$this->cakeError('error404');
		}
		$pet = $this->Pet->find('first', array('conditions' => array('Pet.id' => $id), 'contain' => array('Owner', 'Specie', 'PetsAvatar', 'Fan.Owner', 'Fan.Owner.OwnersAvatar','Race', 'PetsPhoto')));
		if ($pet) {
			$this->set('pet', $pet);
			$statuses = $this->paginate('Status', array('Status.pets_id' => $id)); 
			$fan = $this->if_fan($id);
			$this->set('fan', $fan);
			if ($statuses) {			
				$this->set('statuses', $statuses);
			}
		} else {
			$this->Session->setFlash(__('Nie ma takiej strony', true));
			$this->cakeError('error404');
		}
	}

	/**
	 * Add pet
	 */
	function add() {
		$this->set('title_for_layout', 'Dodawanie pupila - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($this->data)) {
			$this->data['Pet']['owners_id'] = $this->Auth->User('id');
			$this->Pet->create();
			if ($this->Pet->save($this->data)) {
				$this->Session->setFlash(__('Pupil został dodany', true));
				$this->redirect(array('action' => 'mypets'));
			} else {
				$this->Session->setFlash(__('Pupil nie mógł zostać dodany', true));
			}
		}
		$species = $this->Pet->Specie->find('list');
		$races = $this->Pet->Race->find('list');
		$this->set(compact('species','races'));
	}

	/**
	 * Edit pet
	 */
	function edit($id = null) {
		$this->set('title_for_layout', 'Edycja pupila - Serwis społecznościowy dla właścicieli zwierząt');
		if (empty($this->data) && !$id) {
			$this->Session->setFlash(__('Nie ma takiego pupila', true));
			$this->redirect(array('action' => 'index'));
			//$this->cakeError('error404');
		}

		if (!empty($this->data)) {
			$id = $this->data['Pet']['id'];
			$pet = $this->Pet->findById($id); 
			if ($pet['Pet']['id'] != $this->Auth->User('id')) {
				$this->Session->setFlash(__('Nie jesteś właścicielem tego pupila', true));
				$this->redirect(array('action' => 'index'));
				//$this->cakeError('error404');	
			}
			else {	  
				if ($this->Pet->save($this->data)) {
					$this->Session->setFlash(__('Zmiany zostały pomyslnie zapisane', true));
					$this->redirect(array('action' => 'pet', $id));
				} else {
					$this->Session->setFlash(__('Nie można zapisać zmian. Spróbuj ponownie', true));
				}				
			}
		}
	 	elseif (empty($this->data)) {	 	  
			$this->data = $this->Pet->read(null, $id);
			$pet = $this->Pet->findById($id);
		}		
		$species = $this->Pet->Specie->find('list');
    $races = $this->Pet->Race->find('list', array('conditions' => array('species_id' => $this->data['Pet']['species_id'])));		
		$this->set(compact('species', 'races'));
	}

	/**
	 * Delete pet
	 * Removing his fans
	 */
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Błąd usuwania pupila', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pet->delete($id)) {
			$this->Session->setFlash(__('Pupil został usunięty', true));
			//TODO delete fans
			//$this->Pet->Fan->delete($id);
			// TODO delete all photos
			// TODO delete avatar
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Nie mozna usunąć pupila', true));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * by Ajax
	 * Get all races for one spiece
	 */
	function getRaces(){
		App::import('Model', 'Race');
		$Race = new Race();
		$id = $this->params['url']['species_id'];
		$races = $Race->find('all',array('conditions' => array('species_id' => $id))); 
		$this->set(compact('races'));
		$this->render('getRaces','ajax');
	}

/** ADMIN */

	function admin_index() {
		$this->Pet->recursive = 0;
		$this->set('pets', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pet', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pet', $this->Pet->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Pet->create();
			if ($this->Pet->save($this->data)) {
				$this->Session->setFlash(__('The pet has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pet could not be saved. Please, try again.', true));
			}
		}
		$species = $this->Pet->Specie->find('list');
		$owners = $this->Pet->Owner->find('list');
		$this->set(compact('species', 'owners'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid pet', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pet->save($this->data)) {
				$this->Session->setFlash(__('The pet has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pet could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pet->read(null, $id);
		}
		$species = $this->Pet->Specie->find('list');
		$owners = $this->Pet->Owner->find('list');
		$this->set(compact('species', 'owners'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pet', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pet->delete($id)) {
			$this->Session->setFlash(__('Pet deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Pet was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * checking if $id_pet is in yours favourities
	 */
	private function if_fan($id_pet) {
		$favourites = $this->Pet->Owner->Fan->find('all', 
		  array('contain' => array('Pet', 'Pet.PetsAvatar'),
	      'conditions' => array(
	        'Fan.owners_id' => $this->Auth->User('id'),
	        'Fan.pets_id' => $id_pet,
	      )
	    )
	  );
		foreach ($favourites as $fav) {
			if (in_array($id_pet, $fav['Pet']))
				return true;
			}
		return false;
	}
}
