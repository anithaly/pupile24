<?php
class StatusCommentsController extends AppController {

	var $name = 'StatusComments';
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('Acl', 'Security');
	var $paginate = array(
		'Status' => array(
			'limit' => 10, 
			'order' => array('Status.created' => 'desc'), 
			'contain' => array('Status','Status.StatusComment'),
		),
	);

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
	}


	/**
	 * Add comment to status
	 */
	function add() {
		if (!empty($this->data)) {
			$this->data['StatusComment']['owners_id'] = $this->Auth->User('id'); // autor komentarza
			$id_stat =$this->data['StatusComment']['statuses_id'];
			$id_pet = $this->data['StatusComment']['pets_id'];
			$status = $this->StatusComment->Status->findById($id_stat);
			if (!empty($status)) {
				$this->StatusComment->create();
				if ($this->StatusComment->save($this->data)) {
					$this->Session->setFlash(__('Dodano komentarz do statusu', true));
					$this->redirect(array('controller' => 'pets', 'action' => 'pet', $id_pet));
				} else {
					$this->Session->setFlash(__('Nie udało się dodać komentarza', true));
					$pet = $this->StatusComment->Status->Pet->find('first', array('conditions' => array('Pet.id' => $id_pet), 'contain' => array('Owner', 'Specie', 'PetsAvatar', 'Race')));
					$statuses = $this->paginate('Status', array('Status.pets_id' => $id_pet)); 
					if ($pet) {
						$this->set('pet', $pet);
						if ($statuses) {			
							$this->set('statuses', $statuses);
						}
					//$pet = $this->StatusComment->Status->Pet->find('first', array('conditions' => array('Pet.id' => $id_pet),'contain' => array('Status', 'Owner', 'Specie', 'PetsAvatar', 'Race')));
						$this->set('pet', $pet);
						$this->render('/pets/pet/');
					}
				}
			}
			else {
				$this->Session->setFlash(__('Status, który chcesz skomentować, nie istnieje', true));
				$this->render('/pages/404'); // $this->cakeError('error404');
			}
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Nie ma już takiego komentarza', true));
			$this->redirect(array('controllers'=>'pets','action'=>'pet'));
		}
		if ($this->StatusComment->delete($id)) {
			$this->Session->setFlash(__('Status comment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Status comment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}


/*** ADMIN */

	function admin_add() {
		if (!empty($this->data)) {
			$this->StatusComment->create();
			if ($this->StatusComment->save($this->data)) {
				$this->Session->setFlash(__('The status comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status comment could not be saved. Please, try again.', true));
			}
		}
		$statuses = $this->StatusComment->Status->find('list');
		$owners = $this->StatusComment->Owner->find('list');
		$this->set(compact('statuses', 'owners'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for status comment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->StatusComment->delete($id)) {
			$this->Session->setFlash(__('Status comment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Status comment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
