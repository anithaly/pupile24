<?php
class ArticleCommentsController extends AppController {

	var $name = 'ArticleComments';
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('Acl', 'Security');

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
	}

	/* not now
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid articles comment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ArticleComment', $this->ArticleComment->read(null, $id));
	}
	*/

	/**
	 * Add comment for owner's article
	 */
	function add() {
		if (!empty($this->data)) {
			$this->data['ArticleComment']['owners_id'] = $this->Auth->User('id');
			$id = $this->data['ArticleComment']['articles_id'];
			$this->ArticleComment->create();
			if ($this->ArticleComment->save($this->data)) {
				$this->Session->setFlash(__('Komentarz został dodany', true));
				$this->redirect(array('controller' => 'articles', 'action' => 'view', $id));
			} else {
				$article = $this->ArticleComment->Article->find('first', array('conditions' => array('Article.id' => $id),'contain' => array("Owner", "ArticleComment" => "Owner.name")));
				$this->set('article', $article);
				$this->Session->setFlash(__('Nie można dodać komentarza', true));
				$this->render('/articles/view');
			}
		}
		else {
			$this->redirect(array('controller' => 'owners', 'action' => 'home'));
		}
	}

	/** 
	 * Delete, if comment belogns to you 
	 */
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Błąd usuwania komentarza', true));
			$this->redirect(array('controller' => 'articles', 'action' => 'index'));
		}
		else {
			$article = $this->ArticleComment->findById($id); 
			$id_art = $article['Article']['id'];
			if ($this->ArticleComment->delete($id)) {
				$this->Session->setFlash(__('Komentarz został usunięty', true));
				$this->redirect(array('controller' => 'articles', 'action' => 'view', $id_art));
			}
			else {
				$this->Session->setFlash(__('Nie ma takiego komentarza', true));
				$this->redirect(array('controller' => 'articles', 'action' => 'view', $id_art));
			}
		}
	}


/*** ADMIN **/
	function admin_index() {
		$this->ArticleComment->recursive = 0;
		$this->set('ArticleComments', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid articles comment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ArticleComment', $this->ArticleComment->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ArticleComment->create();
			if ($this->ArticleComment->save($this->data)) {
				$this->Session->setFlash(__('The articles comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The articles comment could not be saved. Please, try again.', true));
			}
		}
		$owners = $this->ArticleComment->Owner->find('list');
		$articles = $this->ArticleComment->Article->find('list');
		$this->set(compact('owners', 'articles'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid articles comment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ArticleComment->save($this->data)) {
				$this->Session->setFlash(__('The articles comment has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The articles comment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ArticleComment->read(null, $id);
		}
		$owners = $this->ArticleComment->Owner->find('list');
		$articles = $this->ArticleComment->Article->find('list');
		$this->set(compact('owners', 'articles'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for articles comment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ArticleComment->delete($id)) {
			$this->Session->setFlash(__('Articles comment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Articles comment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
