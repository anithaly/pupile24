<?php
  class UploaderComponent extends Object {
   
    function submit($data) {
        
        $org_name = $data['name']['name'];
        $tmp_name = $data['name']['tmp_name'];
        $tmp_size = $data['name']['size'];
        $tmp_type = $data['name']['type'];
        $pets_id = $data['pets_id'];
        
        //$real_file_path = dirname($tmp_name);
        
        $options = array('file' => "@$tmp_name", 'id' => $pets_id, 'type' => $tmp_type, 'name' => $org_name);
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $options);
        curl_setopt($ch, CURLOPT_URL, 'http://anithaly.com/pets/upload.php');
        $result = curl_exec($ch);
        print_r($result);        
        die();
        curl_close($ch);
        return $result;

    }
 
}