<?php 
class JqImgcropComponent extends Object {

    function uploadImage($uploadedInfo, $uploadTo, $prefix){
        $webpath = $uploadTo;
        $upload_dir =  'uploads';
                  
        $upload_path = $upload_dir.DS;
        $max_width = 800;

        $userfile_name = $uploadedInfo['name'];
        $userfile_tmp =  $uploadedInfo["tmp_name"]; // puste
        $userfile_size = $uploadedInfo["size"];
        $filename = $prefix.basename($uploadedInfo["name"]);
        $file_ext = substr($filename, strrpos($filename, ".") + 1);

    		// modified by natalia stanko start
    		if (($dl = strlen($filename)) > 10) {
    			$index = $dl - 10;
    			$filename2 = substr($filename, 0, $index);
    		} else{
    		  $filename2 = $filename;
    		}
    		$filename3 = sha1($filename2.time());
    		$filename = $prefix.$filename3.'.'.$file_ext;
    		// modifing end

        $uploadTarget = $upload_path. 'av_' .$filename;
        if(empty($uploadedInfo)) {
                  return false;
                }  

        if (isset($uploadedInfo['name'])){  
            move_uploaded_file($userfile_tmp, str_replace('//','/',$uploadTarget) );
            chmod ($uploadTarget , 0777);
            $width = $this->getWidth($uploadTarget);
            $height = $this->getHeight($uploadTarget);// tu
            // Scale the image if it is greater than the width set above
            if ($width > $max_width){
                $scale = $max_width/$width;
                $uploaded = $this->resizeImage($uploadTarget,$width,$height,$scale);
            }else{
                $scale = 1;
                $uploaded = $this->resizeImage($uploadTarget,$width,$height,$scale);
            }
        }
        return array('imagePath' => $webpath.$filename, 'imageName' => $filename, 'imageWidth' => $this->getWidth($uploadTarget), 'imageHeight' => $this->getHeight($uploadTarget));
    }

    function uploadPhoto($uploadedInfo, $uploadTo){
      // uploadedInfo => Array ( [name] => 1.png [type] => image/png [tmp_name] => /private/var/tmp/phpUlHqmu [error] => 0 [size] => 494104 ) 

      $webpath = $uploadTo;
      $upload_dir = 'uploads';
                  
      $upload_path = $upload_dir.DS;
      $max_width = 800;      
      
      $userfile_name = $uploadedInfo['name'];
      $userfile_tmp =  $uploadedInfo["tmp_name"];
      $userfile_size = $uploadedInfo["size"];
      $filename = basename($uploadedInfo["name"]);
      $file_ext = substr($filename, strrpos($filename, ".") + 1);

      // modified by natalia stanko start
      if (($dl = strlen($filename)) > 10) {
        $index = $dl - 10;
        $filename2 = substr($filename, 0, $index);
      } else{
        $filename2 = $filename;
      }
      $filename3 = sha1($filename2.time());
      $filename = $filename3.'.'.$file_ext;
      // modifing end

      $uploadTarget = $upload_path.'org_'.$filename;
      $uploadTarget = str_replace('//','/',$uploadTarget);
      if(empty($uploadedInfo)) {
          return false;
      }  

      if (isset($uploadedInfo['name'])){  
        move_uploaded_file($userfile_tmp, $uploadTarget);
        chmod ($uploadTarget , 0777);
        $this->create_photo_thumbnails($uploadTarget);
      }

      return $filename;
    }


    function getHeight($image) {
        $sizes = getimagesize($image);
        $height = $sizes[1];
        return $height;
    }
    function getWidth($image) {
        $sizes = getimagesize($image);
        $width = $sizes[0];
        return $width;
    }

    function resizeImage($image,$width,$height,$scale) {
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $ext = strtolower(substr(basename($image), strrpos(basename($image), ".") + 1));
        $source = "";
        if($ext == "png"){
            $source = imagecreatefrompng($image);
        }elseif($ext == "jpg" || $ext == "jpeg"){
            $source = imagecreatefromjpeg($image);
        }elseif($ext == "gif"){
            $source = imagecreatefromgif($image);
        }
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
        if($ext == "png" || $ext == "PNG"){
            imagepng($newImage,$image,0);
        }elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG"){
            imagejpeg($newImage,$image,90);
        }elseif($ext == "gif" || $ext == "GIF"){
            imagegif($newImage,$image);
        }
        chmod($image, 0777);
        return $image;
    }

    function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $ext = strtolower(substr(basename($image), strrpos(basename($image), ".") + 1));
        $source = "";
        if($ext == "png"){
            $source = imagecreatefrompng($image);
        }elseif($ext == "jpg" || $ext == "jpeg"){
            $source = imagecreatefromjpeg($image);
        }elseif($ext == "gif"){
            $source = imagecreatefromgif($image);
        }
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);

        if($ext == "png" || $ext == "PNG"){
            imagepng($newImage,$thumb_image_name,0);
        }elseif($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG"){
            imagejpeg($newImage,$thumb_image_name,90);
        }elseif($ext == "gif" || $ext == "GIF"){
            imagegif($newImage,$thumb_image_name);
        }

        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    function cropImage($thumb_width, $x1, $y1, $x2, $y2, $w, $h, $thumbLocation, $imageLocation){
        $scale = $thumb_width/$w;
        $cropped = $this->resizeThumbnailImage($thumbLocation,$imageLocation,$w,$h,$x1,$y1,$scale); // 1st parameter
        return $cropped;
    }
    
    function create_photo_thumbnails($orgFile){
      $smallFile = str_replace('org_','small_',$orgFile);
      $bigFile = str_replace('org_','big_',$orgFile);
      
      $width = $this->getWidth($orgFile);
      $height = $this->getHeight($orgFile);      
      
      // prepare small file
      copy($orgFile, $smallFile);
      $scale = 100/$width;
      $this->resizeImage($smallFile,$width,$height,$scale);
      
      // prepare big file
      if($width > 640){
        copy($orgFile, $bigFile);
        $scale = 640/$width;
        $this->resizeImage($bigFile,$width,$height,$scale);        
      } else{
        copy($orgFile, $bigFile);
      }
    }    
}
