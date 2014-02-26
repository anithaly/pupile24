<?php
class PetsAvatarsController extends AppController {

	var $name = 'PetsAvatars';
	var $helpers = array('Ajax', 'Javascript', 'Cropimage');
	var $components = array('JqImgcrop');

	function beforeFilter(){
		if(isset($this->Security) && $this->action == 'createimage_step3' ){
			$this->Security->enabled = false;
		}
		parent::beforeFilter();
	}

	/**
	 * Upload, first save, ready to crop
	 */
	function createimage_step2(){
		$this->set('title_for_layout', 'Zmiana avatara pupila - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($this->data)) {
	      if($this->data['PetsAvatar']['name']['size'] > 5120000){
	        $this->Session->setFlash('Zbyt duży rozmiar pliku');
	        $this->redirect(array('action' => 'add', $this->data['PetsAvatar']['pets_id']));
		  }
		  $uploaded = $this->JqImgcrop->uploadImage($this->data['PetsAvatar']['name'], '', '');
		  $this->set('uploaded',$uploaded);
			$this->set('PetsAvatar',$this->data["PetsAvatar"]);
		} else{
		  $this->cakeError('error404');
		} 
	}

	/**
	 * Cropping and saving
	 */
	function createimage_step3(){
		$this->set('title_for_layout', 'Zmiana avatara pupila - Serwis społecznościowy dla właścicieli zwierząt');
		$thumbnail = $this->JqImgcrop->cropImage(
			151, 
			$this->data['PetsAvatar']['x1'], 
			$this->data['PetsAvatar']['y1'], 
			$this->data['PetsAvatar']['x2'], 
			$this->data['PetsAvatar']['y2'], 
			$this->data['PetsAvatar']['w'], 
			$this->data['PetsAvatar']['h'], 
			(WWW_ROOT . 'uploads' . DS . "av_" . $this->data['PetsAvatar']['imagePath']),
			(WWW_ROOT. 'uploads' . DS . "av_" . $this->data['PetsAvatar']['imagePath'])
			);

		//nazwa
		$path_array = explode('/',$thumbnail);
		$filename1 = array_pop($path_array);

		// rozsz
		$filename_array = explode('.',$filename1);
		$ext = array_pop($filename_array);
		$filename2 = implode($filename_array);
		$this->data['PetsAvatar']['name'] = $filename2.'.'.$ext;		
		$old_avatar = $this->PetsAvatar->find('first', array('conditions' => array('PetsAvatar.pets_id' => $this->data['PetsAvatar']['pets_id'])));
		if ($old_avatar) {
		  // znaleziono stary avatar
      $this->PetsAvatar->read('name',$old_avatar['PetsAvatar']['id']);
			$this->PetsAvatar->set('name', $this->data['PetsAvatar']['name']);
			if ($this->PetsAvatar->save($this->data)) {
				@unlink( DS . "tmp" . DS . "uploads" . DS .  $old_avatar['PetsAvatar']['name']);
			}
		}
		else {
			$this->PetsAvatar->create();
			$this->PetsAvatar->set($this->data['PetsAvatar']);
			$this->PetsAvatar->save();
		}
		$this->Session->setFlash(__('Uploadowano zdjęcie', true));
		$this->redirect(array('controller' => 'pets', 'action' => 'pet', $this->data['PetsAvatar']['pets_id']));
	}

	/**
 	 * Add avatar for pet
	 * Acces only for pet's owner!
	 */
	function add($id_pet=null) {
		$this->set('title_for_layout', 'Zmiana avatara pupila - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($id_pet)) {
			$pet = $this->PetsAvatar->Pet->find('first', array('conditions' => array('Pet.id' => $id_pet),'contain' => array('PetsAvatar.name')));
			if ($this->Auth->User('id') == $pet['Pet']['owners_id']) {
				$this->set('pet',$pet);
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

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pets avatar', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PetsAvatar->delete($id)) {
			$this->Session->setFlash(__('Pets avatar deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Pets avatar was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}


/** ADMIN **/

	function admin_index() {
		$this->PetsAvatar->recursive = 0;
		$this->set('petsAvatars', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pets avatar', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('petsAvatar', $this->PetsAvatar->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PetsAvatar->create();
			if ($this->PetsAvatar->save($this->data)) {
				$this->Session->setFlash(__('The pets avatar has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pets avatar could not be saved. Please, try again.', true));
			}
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pets avatar', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('petsAvatar', $this->PetsAvatar->read(null, $id));
	}




	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid pets avatar', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PetsAvatar->save($this->data)) {
				$this->Session->setFlash(__('The pets avatar has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pets avatar could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PetsAvatar->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pets avatar', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PetsAvatar->delete($id)) {
			$this->Session->setFlash(__('Pets avatar deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Pets avatar was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
