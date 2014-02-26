<?php
class PetsPhotosController extends AppController {

	var $name = 'PetsPhotos';
	var $helpers = array('Ajax', 'Javascript', 'Cropimage');
	var $components = array('JqImgcrop');
	var $paginate = array(
			'limit' => 10, 
			'order' => array('PetsPhoto.created' => 'desc'),
	);

	function beforeFilter(){
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
		if(isset($this->Security) && $this->action == 'createimage_step3' ){
			$this->Security->enabled = false;
		}
		
	}


  function create(){
    if (!empty($this->data)) {
      if($this->data['PetsPhoto']['name']['size'] > 5120000){
        $this->Session->setFlash('Zbyt duży rozmiar pliku');
        $this->redirect(array('action' => 'add', $this->data['PetsPhoto']['pets_id']));
      } else{
        $upload_dir = '';
        $uploaded_file = $this->JqImgcrop->uploadPhoto($this->data['PetsPhoto']['name'], $upload_dir);
        $this->data["PetsPhoto"]['name'] = $uploaded_file;
        $this->PetsPhoto->create();
        $this->PetsPhoto->set($this->data['PetsPhoto']);
        $this->PetsPhoto->save();
        $this->Session->setFlash('Uploadowano zdjęcie');
        $this->redirect(array('action' => 'index', $this->data['PetsPhoto']['pets_id']));
      }
    } else{
      $this->cakeError('error404');
    }
  }


	/**
	 * All photos for one pet
	 * Acces only for pet's owner!
	 */
	function index($id_pet = null) {
		$this->set('title_for_layout', 'Zdjęcia - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($id_pet)) {
			$pet = $this->PetsPhoto->Pet->find('first', array('conditions' => array('Pet.id' => $id_pet), 'fields' => array('id','name', 'owners_id'), 'contain' => null, 'recursive' => 0));
			if ($this->Auth->User('id') == $pet['Pet']['owners_id']) {
				$petsPhotos = $this->paginate(array('PetsPhoto.pets_id' => $id_pet));
				$this->set('petsPhotos', $petsPhotos);
				$this->set('pet', $pet);
			}
			else {
				$this->Session->setFlash(__('Brak dostępu', true));
				$this->cakeError('error404');
			}
		}
		else {
			$this->Session->setFlash(__('Niepoprawny adres', true));
			$this->cakeError('error404');
		}
	}

	function view($id = null) {
		$this->set('title_for_layout', 'Zdjęcia - Serwis społecznościowy dla właścicieli zwierząt');
		if (!$id) {
			$this->Session->setFlash(__('Invalid pets photo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('PetsPhoto', $this->PetsPhoto->find('first', array('conditions' => array('PetsPhoto.id' => $id))));
	}

	/**
 	 * Add photo fo pet
	 * Acces only for pet's owner!
	 */
	function add($id_pet =null ) {
		if (!empty($id_pet)) {
			$pet = $this->PetsPhoto->Pet->find('first', array('conditions' => array('Pet.id' => $id_pet), 'fields' => array('id','name', 'owners_id'), 'contain' => null, 'recursive' => 0));
			if ($this->Auth->User('id') == $pet['Pet']['owners_id']) {
				$this->set('pet', $pet);
			}
			else {
				$this->Session->setFlash(__('Brak dostępu', true));
				$this->cakeError('error404');
			}
		}
		else {
			$this->Session->setFlash(__('Niepoprawny adres', true));
			$this->cakeError('error404');
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Niepoprawne dane formularza', true));
			$this->redirect(array('controller'=> 'pets' ,'action'=>'mypets'));

		}
		if (!empty($this->data)) {
			if ($this->PetsPhoto->save($this->data)) {
				$this->Session->setFlash(__('Zmiany zostały zapisane', true));
				$this->redirect(array('controller'=> 'pets' ,'action'=>'mypets'));

			} else {
				$this->Session->setFlash(__('Nie można zapisać zmian.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PetsPhoto->read(null, $id);
		}
		$pets = $this->PetsPhoto->Pet->find('list');
		$this->set(compact('pets'));
	}

	/**
	 * if photos belongs to user
	 * TODO unlink photos
	 */
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Niepoprawne dane formularza', true));
			$this->redirect(array('controller'=> 'pets' ,'action'=>'mypets'));
		}
		if ($this->PetsPhoto->delete($id)) {
			$this->Session->setFlash(__('Zdjęcie zostało usunięte', true));
			$this->redirect(array('controller' => 'pets','action'=>'mypets'));
		}
		$this->Session->setFlash(__('Nie udało się usunąć zdjęcia', true));
		$this->redirect(array('controller' => 'pets','action'=>'mypets'));
	}


/** ADMIN **/

	function admin_index() {
		$this->PetsPhoto->recursive = 0;
		$this->set('petsPhotos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pets photo', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('petsPhoto', $this->PetsPhoto->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PetsPhoto->create();
			if ($this->PetsPhoto->save($this->data)) {
				$this->Session->setFlash(__('The pets photo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pets photo could not be saved. Please, try again.', true));
			}
		}
		$pets = $this->PetsPhoto->Pet->find('list');
		$this->set(compact('pets'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid pets photo', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PetsPhoto->save($this->data)) {
				$this->Session->setFlash(__('The pets photo has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pets photo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PetsPhoto->read(null, $id);
		}
		$pets = $this->PetsPhoto->Pet->find('list');
		$this->set(compact('pets'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pets photo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PetsPhoto->delete($id)) {
			$this->Session->setFlash(__('Pets photo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Pets photo was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
