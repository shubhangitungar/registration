
<?php
	require_once "database.php";
$row = '';
if (isset($_GET['edit'])) {
	$row = get_record_by_id($_GET['edit']);
}else{
	echo"No Record Found";

}
?>
<html>
<head>
<title>Update Employee Data</title
<link rel="stylesheet" type="text/css" href="register.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" type="text/css">

</head>
<body>

<div class="container">

<div class="row">
<div class="col-md-6">

<form name="frmUser" method="post" action="editAction.php"  enctype="multipart/form-data" >
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="show.php">USER DATA</a>
</div>
<div class="form-group">
Name: <br>
<input type="text" name="name" class="form-control"  value="<?php echo $row['name']; ?>">
</div>
<div class="form-group">
email :<br>
<input type="text" name="email" class="form-control" value="<?php echo $row['email']; ?>">
</div>
<div class="form-group">
mobile<br>
<input type="text" name="mobile" class="form-control"  value="<?php echo $row['mobile']; ?>">
</div>
<div class="form-group">
photo
<input type="file" name="photo2" class="form-control" value="<?php echo $row['photo']; ?>"  /><img src="<?php echo $row['photo']; ?>" width="100px" height="100px">

</div>
<div class="form-group">
address
<input type="text"  name="address" class="form-control" style="height:120px;width:300px;" value="<?php echo $row['address'];?>">
</div>
<input type="hidden" name="id" id="id" value="<?php echo  $_GET['edit'];?>" />
<center>
<input type="submit" name="submit" onclick="myFunction()" class="button1" value="UPDATE" class="button">
</center>
</form>
</div></div></div>
<script>
function myFunction() {
  alert("You want to update this data ?");
}
</script>
</body>
</html>