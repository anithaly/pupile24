<?php
class TopicsController extends AppController {

	var $name = 'Topics';
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('Acl', 'Security');
	var $paginate = array(
		'Post' => array (
			'limit' => 20, 
			'order' => array('Post.created' => 'asc'),
			'contain' => array('Owner.name', 'Owner.id','Owner.OwnersAvatar'),
		)
	);

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
		$this->Auth->allow('view');
	}

	/**
	 * All paginated posts in one topic
	 */
	function view($id = null) {
		$this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
		if (empty($id)) {
			$this->Session->setFlash(__('Nie ma takiego tematu', true));
			$this->redirect(array('controller'=> 'section','action' => 'index')); // forum
		}
		$posts = $this->paginate('Post', array('Post.topics_id' => $id));
		$this->set('posts', $posts);
		$topic = $this->Topic->find('first', array('conditions' => array('Topic.id' => $id), 'contain' => array('Category.Section'), ));
		$this->set('topic', $topic);
	}


	/**
	 * Form for adding a new topic
	 * only logged in
	 */
	function add($id_cat = null) {
		$this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($id_cat)) {
			$category = $this->Topic->Category->find('first', array ('conditions' => array('Category.id' => $id_cat)));
			$this->set('category', $category);
		}
		else {
			$this->redirect(array('controller' => 'sections', 'action' => 'index'));
		}
	}


	/**
	 * Create a new topic (and the same new post)
	 * only logged in
	 */
	function create() {
		if (!empty($this->data)) {
			$this->data['Topic']['owners_id'] = $this->Auth->User('id');
			$this->data['Post'][0]['owners_id'] =  $this->Auth->User('id');
			$id_cat = $this->data['Topic']['categories_id'];
			unset($this->Topic->Post->validate['topics_id']);

			if ( $this->Topic->saveAll( $this->data, array('validate'=>'first'))) {
				$this->Session->setFlash('Temat zostal zapisany');
				$this->redirect(array('controller' =>'topics', 'action' => 'view', $this->Topic->id));
			} else{
				$this->Session->setFlash(__('Nie można dodać nowego tematu. Spróbuj jeszcze raz', true));
				$category = $this->Topic->Category->find('first', array ('conditions' => array('Category.id' => $id_cat)));
				$this->set('category', $category);
				$this->render('/topics/add');
			}
		}
		else {
			$category = $this->Topic->Category->find('first', array ('conditions' => array('Category.id' => $id_cat)));
			$this->set('category', $category);
		}
	}

/** not now
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid topic', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The topic has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The topic could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Topic->read(null, $id);
		}
		$categories = $this->Topic->Category->find('list');
		$owners = $this->Topic->Owner->find('list');
		$this->set(compact('categories', 'owners'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for topic', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Topic->delete($id)) {
			$this->Session->setFlash(__('Topic deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Topic was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}


*/

/** ADMIN **/

	function admin_view($id = null) {
		$this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
		if (empty($id)) {
			$this->Session->setFlash(__('Nie ma takiego tematu', true));
			$this->redirect(array('controller'=> 'section','action' => 'index')); // forum
		}
		$posts = $this->paginate('Post', array('Post.topics_id' => $id));
		$this->set('posts', $posts);
		$topic = $this->Topic->find('first', array('contain' => array('Category.Section'),'conditions' => array ('Topic.id' => $id)));
		$this->set('topic', $topic);
	}

	/**
	 * Create a new topic (and the same new post)
	 * only logged in
	 */
	function admin_create() {
		if (!empty($this->data)) {
			$this->data['Topic']['owners_id'] = $this->Auth->User('id');
			$this->data['Post'][0]['owners_id'] =  $this->Auth->User('id');
			$id_cat = $this->data['Topic']['categories_id'];
			unset($this->Topic->Post->validate['topics_id']);

			if ( $this->Topic->saveAll( $this->data, array('validate'=>'first'))) {
				$this->Session->setFlash('Temat zostal zapisany');
				$this->redirect(array('controller' =>'topics', 'action' => 'view', $this->Topic->id));
			} else{
				$this->Session->setFlash(__('Nie można dodać nowego tematu. Spróbuj jeszcze raz', true));
				$category = $this->Topic->Category->find('first', array ('conditions' => array('Category.id' => $id_cat)));
				$this->set('category', $category);
				$this->render('/topics/add');
			}
		}
		else {
			$category = $this->Topic->Category->find('first', array ('conditions' => array('Category.id' => $id_cat)));
			$this->set('category', $category);
		}
	}

	function admin_add($id_cat = null) {
		$this->set('title_for_layout', 'Forum - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($id_cat)) {
			$category = $this->Topic->Category->find('first', array ('conditions' => array('Category.id' => $id_cat)));
			$this->set('category', $category);
		}
		else {
			$this->redirect(array('controller' => 'sections', 'action' => 'index'));
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Nie ma takiego tematu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('Zmiany zostały zapisane', true));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('Nie udało się zapisać zmian.', true));
				$this->redirect(array('action' => 'view', $id));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Topic->read(null, $id);
		}
		$topic = $this->Topic->find('first', array ('conditions' => array('Topic.id' => $id)));
		$this->set('topic', $topic);

	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for topic', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Topic->delete($id)) {
			$this->Session->setFlash(__('Topic deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Topic was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
