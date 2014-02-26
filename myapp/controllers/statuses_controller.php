<?php
class StatusesController extends AppController {

	var $name = 'Statuses';
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('Acl', 'Security');

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
	}


/** not now
	/**
	 * Show me status with all comments
	 *
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('status', $this->Status->read(null, $id));
	}
*/

	/**
	 * Add status for pet
	 */
	function add() {
		if (!empty($this->data)) {
			$id = $this->data['Status']['pets_id'];
			$this->Status->create();
			if ($this->Status->save($this->data)) {
				$this->Session->setFlash(__('Status uaktualniono pomyślnie', true));
				$this->redirect(array('controller' => 'pets','action' => 'pet', $id));
			} else {
				$this->Session->setFlash(__('Status nie został zaktualizowany', true));
				//$article = $this->ArticleComment->Article->find('first', array('conditions' => array('Article.id' => $id),'contain' => array("Owner", "ArticleComment" => "Owner.name")));
				$pet = $this->Status->Pet->find('first', array('conditions' => array('Pet.id' => $id)));
				$this->set('pet', $pet);
				$this->Session->setFlash(__('Nie można dodać komentarza', true));
				$this->render('/pets/pet');
			}
		}
		$pets = $this->Status->Pet->find('list');
		$this->set(compact('pets'));
	}

	/**
	 * Delete status for pet
	 * if you are the owner TODO
	 */
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Status->delete($id)) {
			$this->Session->setFlash(__('Status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}


/*** ADMIN ***/

	function admin_index() {
		$this->Status->recursive = 0;
		$this->set('statuses', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('status', $this->Status->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Status->create();
			if ($this->Status->save($this->data)) {
				$this->Session->setFlash(__('The status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.', true));
			}
		}
		$pets = $this->Status->Pet->find('list');
		$this->set(compact('pets'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Status->save($this->data)) {
				$this->Session->setFlash(__('The status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Status->read(null, $id);
		}
		$pets = $this->Status->Pet->find('list');
		$this->set(compact('pets'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Status->delete($id)) {
			$this->Session->setFlash(__('Status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
