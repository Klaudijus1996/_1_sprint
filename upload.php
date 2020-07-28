<?php 
    if(isset($_FILES['image'])){
        $root = getcwd();
        $getPath = $_GET['path'];
        $errors= array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
        $extensions = array("jpeg","jpg","png","txt","php", "html", "css", "js");
        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        if($file_size > 2097152) {
            $errors[]='File size must be excately 2 MB';
        }
        if(empty($errors)==true) {
            move_uploaded_file($file_tmp, $root.$getPath.'/'.$file_name);
            
        }else{
            print_r($errors);
        }
    }
?>