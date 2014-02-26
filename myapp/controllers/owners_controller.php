<?php
class OwnersController extends AppController {

	var $name = 'Owners';
	var $helpers = array('Ajax', 'Javascript', 'Text');
	var $components = array('Auth','Security','Session');

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
		$this->Auth->allow('add','login','logout','profil', 'index');
	}


	function add() {
		$this->set('title_for_layout', 'Rejestracja - Serwis społecznościowy dla właścicieli zwierząt');
		if ($this->Auth->User('id')) {
			$this->redirect(array('action' => 'home'));
		}
		else {
			// cheating Auth component, so he thinks we does not use password and he doesn't need to hash it ;-)    
			if (!empty($this->data)) {
				$this->Owner->create();
				$this->Owner->set($this->data);
				if($this->Owner->validates()){        
					if ($this->Owner->save()) {
						$this->Session->setFlash(__('Konto zostało utworzone. Zaloguj się.', true));
						$this->redirect(array('action' => 'login'));
					} else {
						$this->Session->setFlash(__('Konto nie mogło zostać utworzone.', true));
						$this->data['Owner']['password']='';
					}
				} else{
				// model invalid
					$this->Session->setFlash("Błędnie wypełniony formularz");
				}
			}
		}
	}

	function home(){
		$owner = $this->Owner->find('first', array(
			'contain' => array('OwnersAvatar','Pet.PetsAvatar'),
			'conditions' => array(
			'Owner.id' => $this->Auth->User('id')
			),
			)
		);

		$friend_ids = $this->Owner->get_friends_ids($this->Auth->User('id'));

		// getting articles
		$this->loadModel('Article');
		$articles = $this->Article->find('all', array('limit' => 5, 'conditions' => array("Article.owners_id" => $friend_ids), 'recursive' => 0));

		// getting fan pets ids

		$fan_pets_ids = $this->Owner->get_fan_pets($this->Auth->User('id'));

		// statusy

		$finder = array(
			'limit' => 5,
			'conditions' => array(
			"Status.pets_id" => $fan_pets_ids
		),
			'contain' => array(
			'Pet' => array(
			'fields' => array('id','name')          
		),
			'Pet.PetsAvatar'
		),
			'order' => array("Status.created" => 'desc'),
			'recursive' => 0
		);

		$statuses = $this->Owner->Fan->Pet->Status->find('all', $finder);

		// zdjęcia

		$finder = array(
			'limit' => 5,
			'conditions' => array(
			"PetsPhoto.pets_id" => $fan_pets_ids
		),
			'contain' => array(
			'Pet' => array(
			'fields' => array('id','name')          
		)
		),
			'order' => array("PetsPhoto.created" => 'desc'),
			'recursive' => 0
		);

		$photos = $this->Owner->Fan->Pet->PetsPhoto->find('all', $finder);

		$this->set(compact('owner','articles','statuses','photos'));
		$this->set('title_for_layout', 'Aktualności - Serwis społecznościowy dla właścicieli zwierząt');
	}

	function settings(){
		$this->set('title_for_layout', 'Zmiana ustawień konta - Serwis społecznościowy dla właścicieli zwierząt');
	}

	function profil($id=null){
		$this->set('title_for_layout', 'Profil - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($id)) {
			$id_owner = $id;  
		} else {  
			$id_owner = $this->Auth->User('id');
		}
		$owner = $this->Owner->find('first', array('contain' => array('OwnersAvatar','Pet.PetsAvatar'),'conditions' => array('Owner.id' => $id_owner)));
		if (!empty($owner)) {  
			$this->set('owner', $owner);
			$favourites = $this->Owner->Fan->find('all', array('contain' => array('Pet', 'Pet.PetsAvatar'),'conditions' => array('Fan.owners_id' => $id_owner)));
			if (!empty($favourites)) {
				$this->set('favourites', $favourites);
			}
			$friends = $this->Owner->get_friends($id_owner);
			if (!empty($friends)) {
				$this->set('friends', $friends);
			}
			$posts = $this->Owner->Post->find('all', array('order' => array('Post.created' => 'desc'), 'limit' => '10', 'contain' => array('Topic', 'Topic.Category'),'conditions' => array('Post.owners_id' => $id_owner)));
			if (!empty($posts)) {
				$this->set('posts', $posts);
			}
			$articles = $this->Owner->Article->find('all', array('order' => array('Article.created' => 'desc'), 'limit' => '10', 'conditions' => array('Article.owners_id' => $id_owner)));
			if (!empty($articles)) {
				$this->set('articles', $articles);
			}
		}
		else {
			$this->redirect(array('controller' => 'pages','action' => 'home'));
		}
	}

	function password(){
		$this->set('title_for_layout', 'Zmiana hasła - Serwis społecznościowy dla właścicieli zwierząt');
		$this->Owner->read(null, $this->Auth->User('id'));
		if (!empty($this->data)) {

		if ($this->Owner->save($this->data)) {
			$this->Session->setFlash(__('Zmiany zostały zapisane', true));
			$this->redirect(array('action' => 'home'));
		} else {
			$this->Session->setFlash(__('Zmiany nie zostały zapisane', true));
			$this->data['Owner']['password']='';
		}
		}
	}

	function login(){
		$this->set('title_for_layout', 'Logowanie - Serwis społecznościowy dla właścicieli zwierząt');
		if ($this->Auth->User('id')) {
			$this->redirect(array('action' => 'home'));
		}
		// moduł od Auth załatwia resztę
	}

	function logout(){
		$this->Session->setFlash("Wylogowanie poprawne");
		return $this->redirect($this->Auth->logout());
	}

	function index() {
		$this->set('title_for_layout', 'Użytkownicy - Serwis społecznościowy dla właścicieli zwierząt');
		$this->Owner->recursive = 0;
		$this->set('owners', $this->paginate());
	}

	function edit($id = null) {
		$this->set('title_for_layout', 'Zmiana ustawień konta - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($this->data)) {
		if ($this->Owner->save($this->data)) {
			$this->Session->setFlash(__('Zmiany zostaly zapisane', true));
			$this->redirect(array('action' => 'profil'));
		} else {
			$this->Session->setFlash(__('The owner could not be saved. Please, try again.', true));
		}
		}
		if (empty($this->data)) {
			$this->data = $this->Owner->read(null, $this->Auth->User('id'));
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for owner', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Owner->delete($id)) {
			$this->Session->setFlash(__('Owner deleted', true));
			$this->redirect(array('action'=>'index'));
		}
			$this->Session->setFlash(__('Owner was not deleted', true));
			$this->redirect(array('action' => 'index'));
	}


	/** ADMIN ****/

	function admin_index() {
		$this->Owner->recursive = 0;
		$this->set('owners', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid owner', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('owner', $this->Owner->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Owner->create();
			if ($this->Owner->save($this->data)) {
				$this->Session->setFlash(__('The owner has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Właściciel nie mógł zostać dodany.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid owner', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Owner->save($this->data)) {
				$this->Session->setFlash(__('The owner has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The owner could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Owner->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for owner', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Owner->delete($id)) {
			$this->Session->setFlash(__('Owner deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Owner was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
