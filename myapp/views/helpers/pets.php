<?php 
  class PetsHelper extends Helper {
    var $helpers = array('Html');
    function petsAvatar($avatar, $pet){
          if (!empty($avatar['name'])){
            return $this->Html->image(FULL_BASE_URL . '/uploads/'.$avatar['name'], array('alt' => $pet['name']));
          } else{
            return $this->Html->image('av_padfoot.gif', array('alt' => $pet['name']));
          }
    }
    
    function avatar($avatar, $model){
          if (isset($avatar['name'])){
            return $this->Html->image(FULL_BASE_URL . '/uploads/'.$avatar['name'], array('alt' => $model['name']));
          } else{
            return $this->Html->image('av_owner.gif', array('alt' => $model['name']));
          }
    }    
  
  
    function canBeFriends($pottential_friend_id, $owner_id){
      if($pottential_friend_id == $owner_id){
        return false;
      }
      $this->Owner = &ClassRegistry::init('Owner');
      return $this->Owner->can_be_friends($pottential_friend_id,$owner_id);
    }
  
  }
    
