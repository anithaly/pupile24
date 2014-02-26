<?php
class Owner extends AppModel {
	var $name = 'Owner';
	var $displayField = 'name';
	var $actsAs = array('Containable');
	var $validate = array(
		'name' => array(
			'maxlength' => array(
				'rule' => array('maxlength',255),
				'message' => 'Max. liczba znaków to 255',
			),
			'minlength' => array(
				'rule' => array('minlength',3),
				'message' => 'Min. liczba znaków to 3',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wpisz nazwę użytkoanika.',
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Wprowadzony email jest nieprawidłowy.',
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wpisz email.',
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => "Ten adres email jest już zarejestwany w systemie",
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wpisz hasło.',
			),
		),
		'password_verification' => array(
			'rule' => array('verifies', 'password'),
			'message' => 'Hasła do siebie nie pasują.'
		),
		'new_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Wpisz hasło.',
			),
		),
		'repeat_password' =>  array(
			'rule' => array('verifies', 'new_password', false),
			'message' => 'Hasła do siebie nie pasują.'
		),
		'city' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 255),
				'message' => 'Max. liczba znaków to 255',
				'allowEmpty' => true,
				'required' => false,
			),
		),
		'about' => array(
			'maxlength' => array(
				'rule' => array('maxlength', 3000),
				'message' => 'Max. liczba znaków to 3000',
				'allowEmpty' => true,
				'required' => false,
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasOne = array(
		'OwnersAvatar' => array(
			'className' => 'OwnersAvatar',
			'foreignKey' => 'owners_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Pet' => array(
			'className' => 'Pet',
			'foreignKey' => 'owners_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'owners_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'owners_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ArticleComment' => array(
			'className' => 'ArticleComment',
			'foreignKey' => 'owners_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'StatusComment' => array(
			'className' => 'StatusComment',
			'foreignKey' => 'owners_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Fan' => array(
			'className' => 'Fan',
			'foreignKey' => 'owners_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	    var $hasAndBelongsToMany = array(
		'Friend' => array (
		    'className' => 'Owner',
		    'joinTable' => 'friendships',
		    'with' => "Friendship",
		    'foreignKey' => 'owners_id',
		    'associationForeignKey' => 'friends_id'
		)
	    );

    function can_be_friends($friend_id,$owners_id){
      $finder = array(
          'conditions' => array(
            'OR' => array(
                array(
                  "Friendship.owners_id" => $owners_id,
                  "Friendship.friends_id" => $friend_id,                  
                ),
                array(
                  "Friendship.friends_id" => $owners_id,
                  "Friendship.owners_id" => $friend_id,                   
                ),
            )
          )
      );
      
      
      $friends = $this->get_owner_models($finder,$owners_id);
      if(empty($friends)){
        return true;
      } else{
        return false;
      }
      
    }
    
    function get_friends_ids($owners_id){
      $finder = array(
          'conditions' => array(
            'OR' => array(
                array(
                  "Friendship.owners_id" => $owners_id,
                ),
                array(
                  "Friendship.friends_id" => $owners_id,
                ),
            ),
            'Friendship.accepted' => 1
          )
      );
      
      $friendships = $this->Friendship->find('all', $finder);

      $friend_ids = array();

      foreach($friendships as $friendship){
          if($friendship['Friendship']['owners_id'] == $owners_id){
              $friend_ids[]= $friendship['Friendship']['friends_id'];
          } else{
              $friend_ids[]=  $friendship["Friendship"]['owners_id'];
          }
      }
      

      return $friend_ids;
      
    }


    function get_friends($owners_id){
      $finder = array(
          'conditions' => array(
            'OR' => array(
                array(
                  "Friendship.owners_id" => $owners_id,
                ),
                array(
                  "Friendship.friends_id" => $owners_id,
                ),
            ),
            'Friendship.accepted' => 1
          )
      );
      
      $friends = $this->get_owner_models($finder,$owners_id);
      return $friends;
    }
    
    
    function get_pending_friends($owners_id){
      
      $finder = array(
        'conditions' => array(
            "Friendship.friends_id" => $owners_id,
            'Friendship.accepted' => 0
        ),
      );
      
      $friends = $this->get_owner_models($finder,$owners_id);
      return $friends;

    }  
    
    function get_invited_friends($owners_id){
      
      $finder = array(
        'conditions' => array(
            "Friendship.owners_id" => $owners_id,
            'Friendship.accepted' => 0
        ),
      );
      
      $friends = $this->get_owner_models($finder,$owners_id);
      return $friends;
    }      
    
    
    private function get_owner_models($finder,$owners_id){
      $friendships = $this->Friendship->find('all', $finder);

      $friend_ids = array();

      foreach($friendships as $friendship){
          if($friendship['Friendship']['owners_id'] == $owners_id){
              $friend_ids[]= $friendship['Friendship']['friends_id'];
          } else{
              $friend_ids[]=  $friendship["Friendship"]['owners_id'];
          }
      }
      
      
      
      $params = array(
        'conditions' => array(
          'Owner.id' => $friend_ids
         ),
        'fields' => array('Owner.id', 'Owner.name'),
        'contain' => array("OwnersAvatar.name")
      );      

      $friends = $this->find('all', $params); 
      
      return $friends;
          
    }
    
    
    function get_fan_pets($owners_id){
      $finder = array(
          'conditions' => array(
            'Fan.owners_id' => $owners_id
          ),
          'recursive' => 0,
          'contain' => ''
      );
      
      $fans = $this->Fan->find('all', $finder);
      $fan_pets_ids = array();
      foreach($fans as $fan){
        $fan_pets_ids[] = $fan["Fan"]['pets_id'];
      }
      
      return $fan_pets_ids;
    }

	/**
	*  if equal then return true
	*/
	 function verifies($data, $field, $hashed = true) {
		$value = Set::extract($data, "{s}");
		if ($hashed == true) {
			return ($this->data[$this->name][$field] === AuthComponent::password($value[0]));
		}
		else {
			return (AuthComponent::password($this->data[$this->name][$field]) === AuthComponent::password($value[0]));
		}
	}

	function beforeSave() {
		//$this->data[$this->name]['password'] = $this->data[$this->name]['hashed_password'];
		if(isset($this->data[$this->name]['new_password'])){
			$this->data[$this->name]['password'] = AuthComponent::password($this->data[$this->name]['new_password']);
		}
		return true;
	}
}
