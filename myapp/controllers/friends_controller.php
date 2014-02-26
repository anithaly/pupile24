<?php
class FriendsController extends AppController {

	var $name = 'Friends';
	var $uses = array('Owner');
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('Acl', 'Security');

        /*var $paginate = array(
            'Friends' => array(
                'limit' => 1,
                'contain' => array('Owner','OwnersAvatar'),
            )
        );*/


	function beforeFilter() {
		parent::beforeFilter();
		if ( !($this->Auth->User('id')) || (($this->Auth->User('admin')!= 1)) ) {
			$this->Auth->deny('admin_index','admin_view', 'admin_edit', 'admin_delete');
		}
	}


	/** 
	 * Listing your friends
	 */
	function index(){
   
    $friends = $this->Owner->get_friends($this->Auth->User('id'));      
    $this->set('friends',$friends); 

	}

	/** 
	 * Listing pending friends request
	 */
	function pending(){
	  
	    $friends = $this->Owner->get_pending_friends($this->Auth->User('id'));      
      $this->set('friends',$friends);
		
	}

	/**
	 * Listing friends request sent by me
	 */
	function sent(){
    $friends = $this->Owner->get_invited_friends($this->Auth->User('id'));      
    $this->set('friends',$friends);
	}

	function add($id_friend = null) {		
            if (!empty($id_friend)){
                if($id_friend == $this->Auth->User('id')){
                    $this->Session->setFlash("Nie próbuj sztuczek!");
                    $this->cakeError('error404');
                } else{
                    // wyszukujemy czy zaproszony user jest już na liście naszych przyjaciół
                    $params = array(
                        'conditions' => array(
                            'OR' => array(
                                array(
                                    'Friendship.owners_id' => $id_friend,
                                    'Friendship.friends_id' => $this->Auth->User('id')
                                ),
                                array(
                                    'Friendship.owners_id' => $this->Auth->User('id'),
                                    'Friendship.friends_id' => $id_friend,
                                ),
                           ),
                        ),
                        'contain' => array(),
                    );
                    $friendship = $this->Owner->Friendship->find('first', $params);

                    // jeśli istnieje informacja o przyjaźni
                    if($friendship){                       
                        if($friendship['Friendship']['accepted']){
                            $this->Session->setFlash("Jesteście już przyjaciółmi");
                        } elseif($friendship['Friendship']['owners_id'] == $this->Auth->User('id')){
                            // jeśli to ty zapraszałeś
                            if($friendship['Friendship']['rejected']){
                                $this->Session->setFlash("Zapraszana osoba nie przyjęła Twojego zaproszenia.");
                            } else{
                                $this->Session->setFlash("Już wysłałeś zaproszenie. Zaczekaj na odpowiedź.");
                            }
                        } elseif($friendship['Friendship']['friends_id'] == $this->Auth->User('id')){
                            // jeśli ty byłeś zapraszaną osobą
                            // TODO: zaakceptuj tutaj
                        }
                    } else{
                        // tworzmy model przyjaźni
                        $this->data['Friendship']['owners_id'] = $this->Auth->User('id');
                        $this->data['Friendship']['friends_id'] = $id_friend;

                        // zapisujemy
                        if($this->Owner->Friendship->save($this->data)){
                            $this->Session->setFlash("Zaproszenie zostało wysłane");
                        } else{
                            $this->Session->setFlash('Nie udało się wysłać zaproszenia');
                        }

                    }


                    // przekierowujemy z powrotem na profil
                    $this->redirect(array('controller' => 'owners', 'action' => 'profil', $id_friend));

                }
            } else {
                $this->Session->setFlash(__('Niepoprawny adres', true));
		$this->cakeError('error404');
            }
            
	}

  /**
   * Akceptacja przjaźni
   */
  function accept($id_friend = null){
    if (!empty($id_friend) && $id_friend != $this->Auth->User('id')){


        // wyszukujemy czy zaproszony user jest już na liście naszych przyjaciół
        $params = array(
          'conditions' => array(
            'Friendship.owners_id' => $id_friend,
            'Friendship.friends_id' => $this->Auth->User('id'),
          ),
        );

        $friendship = $this->Owner->Friendship->find('first', $params);
        // jeśli istnieje informacja o przyjaźni
        if($friendship && ($friendship['Friendship']['accepted'] == false)){
          $this->data['Friendship']['id'] = $friendship['Friendship']['id'];
          $this->data['Friendship']['owners_id'] = $id_friend;
          $this->data['Friendship']['friends_id'] = $this->Auth->User('id');
          $this->data['Friendship']['accepted'] = 1;
          // zapisujemy
          if($this->Owner->Friendship->save($this->data)){
            $this->Session->setFlash("Zaproszenie zostało zaakceptowane");
          } else{
            $this->Session->setFlash('Nie udało się zaakceptować zaproszenia');
          }

        } else{
          $this->Session->setFlash('Nie ma takiej przyjaźni...');
        }
            
    } else{
      $this->Session->setFlash('Niepoprawne parametry');
    }
    
    // przekierowujemy z powrotem na profil
    $this->redirect(array('controller' => 'friends', 'action' => 'index'));
    
    
  }

  /**
   * Odrzucenie przyjaźni
   */
 
  function reject($id_friend = null){
    if (!empty($id_friend) && $id_friend != $this->Auth->User('id')){


        // wyszukujemy czy zaproszony user jest już na liście naszych przyjaciół
        $params = array(
          'conditions' => array(
            'Friendship.owners_id' => $id_friend,
            'Friendship.friends_id' => $this->Auth->User('id'),
          ),
        );

        $friendship = $this->Owner->Friendship->find('first', $params);
        // jeśli istnieje informacja o przyjaźni
        if($friendship){
          // usuwamy
          if($this->Owner->Friendship->delete($friendship['Friendship']['id'])){
            $this->Session->setFlash("Zaproszenie zostało odrzucone");
          } else{
            $this->Session->setFlash('Nie udało się odrzucić zaproszenia');
          }

        } else{
          $this->Session->setFlash('Nie ma takiej przyjaźni...');
        }
            
    } else{
      $this->Session->setFlash('Niepoprawne parametry');
    }
    
    // przekierowujemy z powrotem na profil
    $this->redirect(array('controller' => 'friends', 'action' => 'index'));    
  }


  /**
   * Zakończenie przyjaźni
   */
   
  function break_friendship($id_friend = null){
      if (!empty($id_friend) && $id_friend != $this->Auth->User('id')){


          // wyszukujemy czy zaproszony user jest już na liście naszych przyjaciół
          $params = array(
            'conditions' => array(
              'OR' => array(
                array(
                  'Friendship.owners_id' => $id_friend,
                  'Friendship.friends_id' => $this->Auth->User('id'),
                ),
                array(
                  'Friendship.friends_id' => $id_friend,
                  'Friendship.owners_id' => $this->Auth->User('id'),
                ),
              ),
            ),
          );

          $friendship = $this->Owner->Friendship->find('first', $params);
          // jeśli istnieje informacja o przyjaźni
          if($friendship){
            // usuwamy
            if($this->Owner->Friendship->delete($friendship['Friendship']['id'])){
              $this->Session->setFlash("Zakończono znajomość");
            } else{
              $this->Session->setFlash('Nie udało się zakończyć znajomości');
            }

          } else{
            $this->Session->setFlash('Nie ma takiej przyjaźni...');
          }

      } else{
        $this->Session->setFlash('Niepoprawne parametry');
      }

      // przekierowujemy z powrotem na profil
      $this->redirect(array('controller' => 'friends', 'action' => 'index'));    
    }


/** ADMIN **/
	function admin_index() {
		$this->Friend->recursive = 0;
		$this->set('Friends', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Friend', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('Friend', $this->Friend->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Friend->create();
			if ($this->Friend->save($this->data)) {
				$this->Session->setFlash(__('The Friend has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Friend could not be saved. Please, try again.', true));
			}
		}
		$owners = $this->Friend->Owner->find('list');
		$friends = $this->Friend->friend->find('list');
		$this->set(compact('owners', 'friends'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Friend', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Friend->save($this->data)) {
				$this->Session->setFlash(__('The Friend has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Friend could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Friend->read(null, $id);
		}
		$owners = $this->Friend->Owner->find('list');
		$friends = $this->Friend->friend->find('list');
		$this->set(compact('owners', 'friends'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Friend', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Friend->delete($id)) {
			$this->Session->setFlash(__('Friend deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Friend was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * checking if $id_friend is in yours favourities
	 */
	private function if_friend($id_friend) {
		$favourites = $this->Owner->Friend->find('all', array('contain' => "Friend",'conditions' => array('Friend.owners_id' => $this->Auth->User('id'))));
		foreach ($favourites as $fav) {
			if (in_array($id_friend, $fav['friend']))
				return true;
			}
		return false;
	}
}
