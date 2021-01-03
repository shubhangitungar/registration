<!DOCTYPE HTML>  
<html>
<head>
<div>
<style>
.error {color: #FF0000;}
</style>
<?php
include 'database.php'?>
<link rel="stylesheet" type="text/css" href="register.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" type="text/css">
</head>
<body>  
<?php

// define variables and set to empty values
	$nameErr = $emailErr = $mobileErr = $photo=$addressErr ="";
	$name = $email = $mobile =$photoErr= $address = "";
	$is_err=false;



	if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
			if (empty($_POST["name"])) {
    $nameErr = "Name is required";
	$is_err=true;
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
	  $is_err=true;
    }
  }
 
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
	$is_err=true;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
	  $is_err=true;
    }
  }
  
  
  if(empty($_POST["mobile"])){
	$mobileErr="Mobile No is Required:";
	$is_err=true;
  }
  else{
	$mobile=test_input($_POST["mobile"]);
	if(!preg_match("/^[0-9]{10}+$/", $mobile)){
		$mobileErr="Enter Valid 10 digit Mobile No";
		$is_err=true;
	}
  }

  $address=$_POST['address'];
  
  $photo=get_image();
  
  //echo $photo;
  
  if($is_err==false){
	save_record($name,$email,$mobile,$photo,$address);
	//get_records();
    header("Location: show.php");
   //echo"$name";
   //echo "Success";
  }
  else{
  echo"Error In Input Data..Please Enter Valid Data";
  
  }
}   
function get_image(){
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_name = $_FILES['photo']['name'];
    $new_file = "images/".$file_name;

   if(isset($_FILES['photo'])){
         move_uploaded_file($file_tmp, $new_file);
         echo "Success";
         return $new_file;
    }else{
         print_r("Error in photo upload");
    }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>


<h2>PHP Form Validation Example</h2>
<div class="container">

<div class="row">
<div class="col-md-6">
<!--<p><span class="error">* required field</span></p>-->
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
   
	<div class="form-group">
  <label> Name</label>
  <input type="text" name="name" class="form-control" >
  <span class="error">* <?php echo $nameErr;?></span>
  </div>
    <div class="form-group">
 <label> E-mail</label> <input type="text" name="email" class="form-control" required>
  <span class="error">* <?php echo $emailErr;?></span>
  </div>
  
  <div class="form-group">
<label>Mobile</label>
<input type="tel"  name="mobile" class="form-control" required> <!--placeholder="0123456789" pattern="[0-9]{10}" --> 
<span class="error">* <?php echo $mobileErr;?></span>
</div>

<div class="form-group">
<label>Photo</label>
<input type="file" name="photo">  
<!--<button name="browse" class="button1" require>Browse</button>-->
</div>

<div class="form-group">
<label>Address</label>
<textarea name="address" rows="5" cols="40" class="form-control" required></textarea>
</div>
 
 <center><button type="submit" name="submit" value="submit" class="button1">Submit</button></center>
  
</form>

</div></div></div>


</body>
</html>


