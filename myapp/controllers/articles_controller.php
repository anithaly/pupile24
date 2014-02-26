<?php
class ArticlesController extends AppController {

	var $name = 'Articles';
	var $helpers = array('Ajax', 'Javascript', 'Text');
	var $components = array('Acl', 'Security');
	var $paginate = array(
		'limit' => 10, 
		'order' => array('Article.created' => 'desc'),
		'contain' => 'Owner.name'
	);

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
		$this->Auth->allow('view', 'index'); // for guests
	}

	/** 
	 * All articles in hole serwis
	 * pagination
	 */
	function index() {
		$this->set('title_for_layout', 'Artykuły - Serwis społecznościowy dla właścicieli zwierząt');
		$this->Article->recursive = 0;
		$articles = $this->paginate();
		$this->set('articles', $articles);
	}

	/** 
	 * One article, 
	 * the logged can comment, 
	 * the owner can edit article and delete comment
	 */
	function view($id = null) {
		$this->set('title_for_layout', 'Artykuł - Serwis społecznościowy dla właścicieli zwierząt');
		if (!$id) {
			$this->Session->setFlash(__('Nie ma takiego artykułu', true));
			$this->cakeError('error404');
		}
		else {
			$article = $this->Article->find('first', array('conditions' => array('Article.id' => $id),'contain' => array("Owner", "ArticleComment" => "Owner.name")));
			if ($article) {
				$this->set('article', $article);
			}
			else {
				$this->Session->setFlash(__('Nie ma takiego artykułu', true));				
				$this->cakeError('error404');
			}
		}
	}

	/** 
	 * All owner's articles
	 */
	function myarticles() {
		$this->set('title_for_layout', 'Moje artykuły - Serwis społecznościowy dla właścicieli zwierząt');
		$my_articles = $this->paginate('Article', array('owners_id' => $this->Auth->User('id')));
		$this->set('my_articles', $my_articles); 
	}

	/** 
	 * Add article
	 */
	function add() {
		$this->set('title_for_layout', 'Dodawanie artykułu - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($this->data)) {
			$this->data['Article']['owners_id'] = $this->Auth->User('id');
			$this->Article->create();
			if ($this->Article->save($this->data)) {
				$this->Session->setFlash(__('Artykuł został pomyślnie dodany', true));
				$this->redirect(array('action' => 'myarticles'));
			} else {
				$this->Session->setFlash(__('Artykuł nie mógł zostać dodany', true));
			}
		}
	}

	/** 
	 * Edit acrticle
	 */
	function edit($id = null) {
		$this->set("Edycja artykułu","Serwis społecznościowy dla właścicieli zwierząt");
		if (!$id) {
			$this->Session->setFlash(__('Błąd edycji artykułu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Article->save($this->data)) {
				$this->Session->setFlash(__('Artykuł został pomyślnie zmieniony', true));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('Nie udało się zapisać zmian w artykule', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Article->read(null, $id);
		}
	}

	/**
	 * Delete acrticle
	 */
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Błąd usuwania artykułu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Article->delete($id)) {
			$this->Session->setFlash(__('Artykuł został usunięty', true));
			$this->redirect(array('action'=>'index'));
		}
		else {
			$this->Session->setFlash(__('Nie ma takiego artykułu', true));
			$this->redirect(array('action' => 'index'));
		}
	}

/**** ADMIN ***/

	/** 
	 * All acrticles all owners to edit for admin
	 */
	function admin_index() {
		$this->Article->recursive = 0;
		$this->set('articles', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid article', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('article', $this->Article->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Article->create();
			if ($this->Article->save($this->data)) {
				$this->Session->setFlash(__('The article has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.', true));
			}
		}
		$owners = $this->Article->Owner->find('list');
		$this->set(compact('owners'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid article', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Article->save($this->data)) {
				$this->Session->setFlash(__('The article has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Article->read(null, $id);
		}
		$owners = $this->Article->Owner->find('list');
		$this->set(compact('owners'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for article', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Article->delete($id)) {
			$this->Session->setFlash(__('Article deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Article was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
