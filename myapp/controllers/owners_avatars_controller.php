<?php
class OwnersAvatarsController extends AppController {

	var $name = 'OwnersAvatars';
	var $helpers = array('Ajax', 'Javascript', 'Cropimage');
	var $components = array('JqImgcrop');

	function beforeFilter(){
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
		if(isset($this->Security) && $this->action == 'createimage_step3' ){
			$this->Security->enabled = false;
		}
	}
	
	
	function add() {
	$this->set('title_for_layout', 'Zmiana avatara - Serwis społecznościowy dla właścicieli zwierząt');
	  $owner = $this->OwnersAvatar->Owner->find('first', array('conditions' => array('Owner.id' => $this->Auth->User('id')),'contain' => array('OwnersAvatar.name')));
	  $this->set('owner',$owner);
	}

	/**
	 * Upload, first save, ready to crop
	 */
	function createimage_step2(){
	$this->set('title_for_layout', 'Zmiana avatara - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($this->data)) {
		    if($this->data['OwnersAvatar']['name']['size'] > 5120000){
			$this->Session->setFlash('Zbyt duży rozmiar pliku');
			$this->redirect(array('action' => 'add', $this->data['OwnersAvatar']['pets_id']));
		    }
		    $uploaded = $this->JqImgcrop->uploadImage($this->data['OwnersAvatar']['name'], '', '');
		    $this->set('uploaded',$uploaded);
			$this->set('OwnersAvatar',$this->data["OwnersAvatar"]);
		} 
	}

	/**
	 * Cropping and saving
	 */
	function createimage_step3(){
	$this->set('title_for_layout', 'Zmiana avatara - Serwis społecznościowy dla właścicieli zwierząt');
		$thumbnail = $this->JqImgcrop->cropImage(
			151, 
			$this->data['OwnersAvatar']['x1'], 
			$this->data['OwnersAvatar']['y1'], 
			$this->data['OwnersAvatar']['x2'], 
			$this->data['OwnersAvatar']['y2'], 
			$this->data['OwnersAvatar']['w'], 
			$this->data['OwnersAvatar']['h'], 
			(WWW_ROOT . 'uploads' . DS . "av_" . $this->data['OwnersAvatar']['imagePath']),
			(WWW_ROOT. 'uploads' . DS . "av_" . $this->data['OwnersAvatar']['imagePath'])
			);

		//nazwa
		$path_array = explode('/',$thumbnail);
		$filename1 = array_pop($path_array);

		// rozsz
		$filename_array = explode('.',$filename1);
		$ext = array_pop($filename_array);
		$filename2 = implode($filename_array);
		$this->data['OwnersAvatar']['name'] = $filename2.'.'.$ext;		
		$old_avatar = $this->OwnersAvatar->find('first', array('conditions' => array('OwnersAvatar.owners_id' => $this->Auth->User('id'))));
		if ($old_avatar) {
		  // znaleziono stary avatar
      $this->OwnersAvatar->read('name',$old_avatar['OwnersAvatar']['id']);
			$this->OwnersAvatar->set('name', $this->data['OwnersAvatar']['name']);
			if ($this->OwnersAvatar->save($this->data)) {
				@unlink( DS . "tmp" . DS . "uploads" . DS .  $old_avatar['OwnersAvatar']['name']);
			}
		}
		else {
			$this->OwnersAvatar->create();
			$this->data['OwnersAvatar']['owners_id'] = $this->Auth->User('id');
			$this->OwnersAvatar->set($this->data['OwnersAvatar']);
			$this->OwnersAvatar->save();
		}
		$this->Session->setFlash("Twój avatar został zapisany");
		$this->redirect(array('controller' => 'owners', 'action' => 'profil'));
	}

	function edit($id = null) {
	$this->set('title_for_layout', 'Zmiana avatara - Serwis społecznościowy dla właścicieli zwierząt');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid owners avatar', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OwnersAvatar->save($this->data)) {
				$this->Session->setFlash(__('The owners avatar has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The owners avatar could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OwnersAvatar->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for owners avatar', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OwnersAvatar->delete($id)) {
			$this->Session->setFlash(__('owners avatar deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('owners avatar was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->OwnersAvatar->recursive = 0;
		$this->set('OwnersAvatars', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid owners avatar', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('OwnersAvatar', $this->OwnersAvatar->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->OwnersAvatar->create();
			if ($this->OwnersAvatar->save($this->data)) {
				$this->Session->setFlash(__('The owners avatar has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The owners avatar could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid owners avatar', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OwnersAvatar->save($this->data)) {
				$this->Session->setFlash(__('The owners avatar has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The owners avatar could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OwnersAvatar->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for owners avatar', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OwnersAvatar->delete($id)) {
			$this->Session->setFlash(__('owners avatar deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('owners avatar was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
