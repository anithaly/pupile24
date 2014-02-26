<?php
class CategoriesController extends AppController {

  var $name = 'Categories';
  var $helpers = array('Ajax', 'Javascript');
  var $components = array('Acl', 'Security');

  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('view'); // for guests

    if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
      $this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
    }
  }

  /**
   * Topics in one category
   */
  function view($id = null) {
    $this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
    if (!$id) {
      $this->Session->setFlash(__('Nie matakiej kategorii', true));
      $this->redirect(array('controller'=> 'section','action' => 'index')); // forum
    }
    $category = $this->Category->find('first', array(
      'conditions'=> array('Category.id' => $id), 
      'contain' => array(
        'Section', 
        'Topic' => array(
          'order' => array(
            'Topic.created' => 'desc')
          ),
          'Topic.Owner'
        ),
      'recursive' => 2
      )
    );
    $this->set('category', $category);
  }

/** not now
  function add() {
    if (!empty($this->data)) {
      $this->Category->create();
      if ($this->Category->save($this->data)) {
        $this->Session->setFlash(__('The category has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
      }
    }
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid category', true));
      $this->redirect(array('action' => 'index'));
    }
    if (!empty($this->data)) {
      if ($this->Category->save($this->data)) {
        $this->Session->setFlash(__('The category has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The category could not be saved. Please, try again.', true));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Category->read(null, $id);
    }
  }

  function delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for category', true));
      $this->redirect(array('action'=>'index'));
    }
    if ($this->Category->delete($id)) {
      $this->Session->setFlash(__('Category deleted', true));
      $this->redirect(array('action'=>'index'));
    }
    $this->Session->setFlash(__('Category was not deleted', true));
    $this->redirect(array('action' => 'index'));
  }

*/

/*** ADMIN ***/

  /**
   * All topics for one category
   */

  function admin_view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid category', true));
      $this->redirect(array('action' => 'index'));
    }
    $category = $this->Category->find('first', array(
      'conditions'=> array('Category.id' => $id), 
      'contain' => array(
        'Section', 
        'Topic' => array(
          'order' => array(
            'Topic.created' => 'desc')
          ),
          'Topic.Owner'
        ),
      'recursive' => 2
      )
    );
    $this->set('category', $category);
  }

  /**
   * It works!
   */
  function admin_add($id =null) {
    if (!empty($this->data)) {
      $this->Category->create();
      if ($this->Category->save($this->data)) {
        $this->Session->setFlash(__('Kategoria została dodana', true));
        $this->redirect(array('action' => 'view', $this->Category->id));
      } else {
        $this->Session->setFlash(__('Nie udało się dodać kategorii.', true));
      }
    }
    $section = $this->Category->Section->find('first', array('conditions' => array('Section.id' => $id)));
    $this->set('section', $section);
  }

  function admin_edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Nie ma takiej kategorii', true));
      $this->redirect(array('action' => 'view',$id));
    }
    if (!empty($this->data)) {
      if ($this->Category->save($this->data)) {
        $this->Session->setFlash(__('Zmiany zostaly zapisane', true));
        $this->redirect(array('action' => 'view',$id));
      } else {
        $this->Session->setFlash(__('Nie udało się zapisać zmian.', true));
      }
    }
    if (empty($this->data)) {
      $this->data = $this->Category->read(null, $id);
    }
    $category = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
    $this->set('category', $category);
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for category', true));
      $this->redirect(array('action'=>'index'));
    }
    if ($this->Category->delete($id)) {
      $this->Session->setFlash(__('Category deleted', true));
      $this->redirect(array('action'=>'index'));
    }
    $this->Session->setFlash(__('Category was not deleted', true));
    $this->redirect(array('action' => 'index'));
  }
}
