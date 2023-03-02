<?php
   if(isset($_FILES['file'])){
      $errors= array();
      $fileMain = $_FILES['file'];
      $file_name = $fileMain['name'];
      $file_size =$fileMain['size'];
      $file_tmp =$fileMain['tmp_name'];
      $file_type=$fileMain['type'];
      $storageUrl = "../../uploads/".$_POST['store_url'];
      $file_ext=strtolower(end(explode('.',$fileMain['name'])));
      
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,$storageUrl.$file_name);
         echo $storageUrl.$file_name;
      }else{
         print_r($errors);
      }
   }
?>