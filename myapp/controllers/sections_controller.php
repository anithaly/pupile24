<?php
class SectionsController extends AppController {

	var $name = 'Sections';
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('Acl', 'Security');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view', 'index'); // for guests

		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
	}

	/** 
	 * Forum
	 */
	function index() {
		$this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
		$sections = $this->Section->find('all');
		$this->set('sections', $sections);
	}

	function view($id = null) {
		$this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
		if (!$id) {
			$this->Session->setFlash(__('Nie ma takiej kategorii', true));
			$this->redirect(array('action' => 'index'));
		}
		$sections = $this->Section->find('first', array('conditions' => array('Section.id' => $id)));
		$this->set('sections', $sections);
	}


/*** ADMIN ***/

	/**
	 * Forum: sections and categories
	 */
	function admin_index() {
		$this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
		$sections = $this->Section->find('all');
		$this->set('sections', $sections);
	}
	
	/**
	 * All categories for one section
	 */
	function admin_view($id = null) {
		$this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
		if (!$id) {
			$this->Session->setFlash(__('Nie ma takiej kategorii', true));
			$this->redirect(array('action' => 'index'));
		}
		$sections = $this->Section->find('first', array('conditions' => array('Section.id' => $id)));
		$this->set('sections', $sections);
	}

	/**
	 * It works
	 */
	function admin_add() {
		if (!empty($this->data)) {
			$this->Section->create();
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('Dodano nowy działu', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Nie udało się dodać nowego działu.', true));
			}
		}
	}

	/**
	 * It works
	 */
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Nie ma takiego działu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Section->save($this->data)) {
				$this->Session->setFlash(__('Zmiany zostaly zapisane', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Nie udało się zapisać zmian', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Section->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Section->delete($id)) {
			$this->Session->setFlash(__('Section deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Section was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
