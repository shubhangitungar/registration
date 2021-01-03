<?php
include 'database.php';
$msg="";
if(count($_POST)>0) {
 if($_FILES['photo2']['name'] !=""){
	$photo=get_image();
	update_record($_POST['id'],$_POST['name'],$_POST['email'],$_POST['mobile'],$photo,$_POST['address']);
	}
else 
{	update_record2($_POST['id'],$_POST['name'],$_POST['email'],$_POST['mobile'],$_POST['address']);

}
	header("Location: show.php");
	
}

function get_image(){
    $file_tmp = $_FILES['photo2']['tmp_name'];
    $file_name = $_FILES['photo2']['name'];
    $new_file = "images/".$file_name;

   if(isset($_FILES['photo2'])){
         move_uploaded_file($file_tmp, $new_file);
         echo "Success";
         return $new_file;
    }else{
         print_r("Error in photo upload");
    }
}


 ?>