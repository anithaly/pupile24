<?php
class MessagesController extends AppController {

	var $name = 'Messages';
	var $components = array('Auth','Security','Session');
	var $recursive = 0;
	var $paginate = array(
			'limit' => 10, 
			'order' => array('Message.created' => 'desc'),
			'contain' => array("Sender.name", "Sender.id", "Recipient.name", "Recipient.id")
		);

	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
	}

	function index(){
	$this->set('title_for_layout', 'Wiadomości - Serwis społecznościowy dla właścicieli zwierząt');
		$this->redirect(array('action' => 'inbox'));
	}

	function inbox(){
	$this->set('title_for_layout', 'Skrzynka odbiorcza - Serwis społecznościowy dla właścicieli zwierząt');
		$conditions = array('Message.recipient_id' =>$this->Auth->User('id'),'Message.is_deleted_for_recipient' => false);
		$messages = $this->paginate($conditions);
		$this->set('messages', $messages);
	}

	function outbox(){
	$this->set('title_for_layout', 'Wiadomości wysłane - Serwis społecznościowy dla właścicieli zwierząt');
		$conditions = array(
		'Message.sender_id' =>$this->Auth->User('id'),
		'Message.is_deleted_for_sender' => false
		);    
		$messages = $this->paginate($conditions);
		$this->set('messages', $messages);    
	}

	function view($id = null) {
	$this->set('title_for_layout', 'Wiadomość - Serwis społecznościowy dla właścicieli zwierząt');
		if (!$id) {
		$this->Session->setFlash(__('Invalid message', true));
		$this->redirect(array('action' => 'index'));
	}

	$message = $this->getUserMessage($id);

	if($message){      
		// if recipient is viewing it and if its unread then we mark it as unread
		if($message['Recipient']['id'] == $this->Auth->User('id')){
			if($message['Message']['is_unread']){
				  $this->Message->read('is_unread',$message['Message']['id']);
				  $this->Message->set('is_unread', 0);
				  $this->Message->save();
		}
	}

	$this->set('message',$message);  
	} 
	else{
		$this->cakeError('error404');
	}

	}

	function add() {
	$this->set('title_for_layout', 'Nowa wiadomość - Serwis społecznościowy dla właścicieli zwierząt');
		if (!empty($this->data)) { 
			$this->data['Message']['sender_id'] = $this->Auth->User('id');           
			$this->Message->create();
			if ($this->Message->save($this->data)) {
				$this->Session->setFlash("Wiadomoć została wysłana");
				$this->redirect(array('action' => 'index'));
			} 
			else {
			$this->Session->setFlash("Nie udało się wysłać wiadomości");
		}
	}

	$recipients = $this->Message->Recipient->find('list', array('conditions' => array('Recipient.id !=' => $this->Auth->User('id'))));
	$this->set(compact('recipients'));

	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash("Nieprawidłowe ID");
			$this->redirect(array('action'=>'index'));
		}

		$message = $this->getUserMessage($id);

		if($message){      
			// if recipient is deleting
			if($message['Recipient']['id'] == $this->Auth->User('id')){
				$this->Message->read('is_deleted_for_recipient',$message['Message']['id']);
				$this->Message->set('is_deleted_for_recipient', 1);
				$this->Message->save();
				$this->Session->setFlash("Wiadomość usunięta");
				$this->redirect(array('action' => 'inbox'));        

			} 
			// if sender is deleting
			elseif($message['Sender']['id'] == $this->Auth->User('id')){
			$this->Message->read('is_deleted_for_sender',$message['Message']['id']);
			$this->Message->set('is_deleted_for_sender', 1);
			$this->Message->save();        
			$this->Session->setFlash("Wiadomość usunięta");
			$this->redirect(array('action' => 'outbox'));        

			} 
			// impossible!
			else{
				$this->Session->setFlash(__('Message was not deleted', true));
				$this->redirect(array('action' => 'index'));        
			}      
		} 
			// no message found
		else{
			$this->Session->setFlash(__('Message was not found', true));
			$this->redirect(array('action' => 'index'));      
		}
	}


	private function getUserMessage($id){
		$conditions_for_messages = array(
			'Message.id' => $id, 
			"OR" => array(
			"Message.recipient_id" => $this->Auth->User('id'),  
			"Message.sender_id" => $this->Auth->User('id'),        
			)                
			); 
		return $this->Message->find('first', array('conditions' => $conditions_for_messages));    
	}
}
