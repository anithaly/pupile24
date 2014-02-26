<?php
class FansController extends AppController {

	var $name = 'Fans';
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('Acl', 'Security');

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
	}

/** not now
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fan', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fan', $this->Fan->read(null, $id));
	}
*/

	/**
	 * Become a fan
	 */
	function add($id_pet =null) {
		if (!empty($id_pet)){
			$pet = $this->Fan->Pet->find('first', array('conditions' => array('Pet.id' => $id_pet)));
			if (!empty($pet)) {
					if (!($this->if_fan($id_pet))){
						$this->data['Fan']['owners_id'] = $this->Auth->User('id');
						$this->data['Fan']['pets_id'] = $id_pet;
						$this->Fan->create();
						if ($this->Fan->save($this->data)) {
							$this->Session->setFlash(__('Zostałeś fanem', true));
							$this->redirect(array('controller' => 'pets', 'action' => 'pet', $id_pet));
						} else {
							$this->Session->setFlash(__('Nie udało Ci się zostać fanem.  Spróbuj jeszcze raz.', true));
							$this->redirect(array('controller' => 'pet', 'action' => 'index', $id_pet));
						}
				$this->set('pet', 'pet');
				}
			}
			else {
				$this->Session->setFlash(__('Nie ma takiego pupila', true));
				$this->cakeError('error404');
			}
		}
		else {
			$this->Session->setFlash(__('Niepoprawny adres', true));
			$this->cakeError('error404');
		}
	}

	/** 
	 * Remove pet from favourites
	 */
	function rm($id_pet = null) {
		if (!empty($id_pet)){
			if ($this->if_fan($id_pet)){
				if ($this->Fan->deleteAll(array('Fan.pets_id' => $id_pet, 'Fan.owners_id' => $this->Auth->User('id') ))) {
					$this->Session->setFlash(__('Nie jesteś już fanem tego pupila', true));
					$this->redirect(array('controller' => 'pets','action' => 'pet', $id_pet));
				}
				else {
					$this->Session->setFlash(__('Nie można usunąć Cię z fanów. Spróbuj jeszcze raz.', true));
					$this->redirect(array('controller' => 'pets','action' => 'pet', $id_pet));
				}
			}
			else {
				$this->Session->setFlash(__('Nie jesteś fanem tego zwierzaka', true));
				$this->redirect(array('controller' => 'pets','action' => 'pet', $id_pet));
			}
		}
		else {
			$this->Session->setFlash(__('Niepoprawny adres', true));
			$this->cakeError('error404');
		}
	}

/** ADMIN **/
	function admin_index() {
		$this->Fan->recursive = 0;
		$this->set('fans', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fan', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('fan', $this->Fan->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Fan->create();
			if ($this->Fan->save($this->data)) {
				$this->Session->setFlash(__('The fan has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fan could not be saved. Please, try again.', true));
			}
		}
		$owners = $this->Fan->Owner->find('list');
		$pets = $this->Fan->Pet->find('list');
		$this->set(compact('owners', 'pets'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fan', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Fan->save($this->data)) {
				$this->Session->setFlash(__('The fan has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fan could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Fan->read(null, $id);
		}
		$owners = $this->Fan->Owner->find('list');
		$pets = $this->Fan->Pet->find('list');
		$this->set(compact('owners', 'pets'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fan', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Fan->delete($id)) {
			$this->Session->setFlash(__('Fan deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fan was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * checking if $id_pet is in yours favourities
	 */
	private function if_fan($id_pet) {
		$favourites = $this->Fan->find('all', 
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
