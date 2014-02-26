<?php
class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('Acl', 'Security');
	var $paginate = array(
		'Post' => array (
			'limit' => 20, 
			'order' => array('Post.created' => 'asc'),
			'contain' => array('Owner.name', 'Owner.id'),
		)
	);

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
		//$this->Auth->allow('view');
	}

/** not now
	/**
	 * Podgląd TODO
	 
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Nie ma takiego tematu', true));
			$this->redirect(array('controller'=> 'section','action' => 'index')); // forum
		}
		$posts = $this->paginate('Post', array('Post.Posts_id' => $id));
		$this->set('posts', $posts);
		$post = $this->Post->find('first', array('condition' => array ('post.id' => $id)));
		$this->set('post', $post);
	}
*/

	/**
	 * Add post for topic
	 */
	function add() {
		if (!empty($this->data)) {
				$this->Post->create();
				$id_topic = $this->data['Post']['topics_id'];
				$this->data['Post']['owners_id'] = $this->Auth->User('id');
				if ($this->Post->save($this->data)) {
					$this->Session->setFlash(__('Pomyślnie dodano Twój post', true));
					$this->redirect(array('controller' => 'topics', 'action' => 'view', $id_topic));
				} else {
					$this->Session->setFlash(__('Nie udało się zapisać Twojej odpowiedzi. Spróbuj jeszcze raz', true));
					$posts = $this->paginate('Post', array('Post.topics_id' => $id_topic));
					$this->set('posts', $posts);					
					//$topic = $this->Post->Topic->find('first', array('condition' => array ('Topic.id' => $id_topic)));
					//$this->set('post',$this->data['Post']);
					//$this->set('topic', $topic);
					$topic = $this->Post->Topic->find('first', array('contain' => array('Category.Section'),'conditions' => array ('Topic.id' => $id_topic)));
					$this->set('topic', $topic);
					$this->render('/topics/view');
				}
		}
		else {
			$this->redirect(array('controller' => 'sections', 'action' => 'index'));
		}
	}

/** not now
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid post', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->post->save($this->data)) {
				$this->Session->setFlash(__('The post has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->post->read(null, $id);
		}
		$categories = $this->post->Category->find('list');
		$owners = $this->post->Owner->find('list');
		$this->set(compact('categories', 'owners'));
	}
*/

	/**
	 * Delete post if it is yours
	 */
	function delete($id = null) {
		if (empty($id)) {
			$this->Session->setFlash(__('Błąd usuwania posta', true));
			$this->redirect(array('controller'=> 'section','action' => 'index')); // forum
		}
		else {
			$post = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
			$id_topic = $post['Topic']['id'];
			if ($post['Post']['owners_id'] == $this->Auth->User('id')) {
				
				if ($this->Post->delete($id)) {
					$this->Session->setFlash(__('Twój post został usunięty', true));
				}
				else {
					$this->Session->setFlash(__('Nie udało się usunąć posta', true));
				}
			}
			else {
				$this->Session->setFlash(__('Próbujesz usunąć nie swojego posta', true));
			}
			$posts = $this->paginate('Post', array('Post.topics_id' => $id_topic));
			$this->set('posts', $posts);
			$topic = $this->Post->Topic->find('first', array('condition' => array ('Topic.id' => $id_topic)));
			$this->set('topic', $topic);
			$this->redirect(array('controller'=> 'topics', 'action' => 'view', $id_topic));
		}
	}


/*** ADMIN **/
	function admin_index() {
		$this->post->recursive = 0;
		$this->set('Posts', $this->paginate());
	}

	/**
	 * Add post for topic
	 */
	function admin_add() {
		if (!empty($this->data)) {
				$this->Post->create();
				$id_topic = $this->data['Post']['topics_id'];
				$this->data['Post']['owners_id'] = $this->Auth->User('id');
				if ($this->Post->save($this->data)) {
					$this->Session->setFlash(__('Pomyślnie dodano Twój post', true));
					$this->redirect(array('controller' => 'topics', 'action' => 'view', $id_topic));
				} else {
					$this->Session->setFlash(__('Nie udało się zapisać Twojej odpowiedzi. Spróbuj jeszcze raz', true));
					$posts = $this->paginate('Post', array('Post.topics_id' => $id_topic));
					$this->set('posts', $posts);					
					$topic = $this->Post->Topic->find('first', array('condition' => array ('Topic.id' => $id_topic)));
					$this->set('post',$this->data['Post']);
					$this->set('topic', $topic);
					$topic = $this->Post->Topic->find('first', array('contain' => array('Category.Section'),'conditions' => array ('Topic.id' => $id_topic)));
					$this->set('topic', $topic);
					$this->render('/topics/view');
				}
		}
		else {
			$this->redirect(array('controller' => 'sections', 'action' => 'index'));
		}
	}

	/** 
	 * $id - id post
	 * Change user's post
	 */
	function admin_edit($id = null) {
		$this->set('title_for_layout', 'Edycja posta - Admin - Serwis społecznościowy dla właścicieli zwierząt');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Nie ma takiego posta', true));
			$this->redirect(array('controller' => 'sections' ,'action' => 'index'));
		}
		$post = $this->Post->find('first', array('conditions' => array ('Post.id' => $id), 'contain' => array('Owner', 'Topic.Category.Section')));//var_dump($post);exit;
		$this->set(compact('post', 'post'));
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('Post został zmodyfikowany', true));
				$this->redirect(array('controller' => 'topics', 'action' => 'view', $post['Post']['topics_id']));
			} else {
				$this->Session->setFlash(__('Nie mozna zapisać zmian.', true));
			}
		}
		else {
			$this->data = $this->Post->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->post->delete($id)) {
			$this->Session->setFlash(__('post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('post was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
