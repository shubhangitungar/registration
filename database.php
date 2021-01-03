<?php
echo"<link rel=stylesheet type=text/css href=register.css>";
$name=$email=$mobile=$photo=$address="";

function create_connection() {
	
	$conn=mysqli_connect("localhost","root","","assignment", '3308');

	if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
	return $conn;
}

function close_connection() {
	mysqli_close($conn);
}

function save_record($name,$email,$mobile,$photo,$address){
	$conn = create_connection();
			
//		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql = "INSERT INTO user(name,email,mobile,photo,address) VALUES ('$name','$email','$mobile','$photo','$address')";
		if(mysqli_query($conn,$sql)){
			echo"Record Inserted Successfully";
		} else{
			echo"mysql_error";
		}
//	}
}

function update_record($id, $name,$email,$mobile,$photo,$address) {
	$conn = create_connection();
	mysqli_query($conn,"UPDATE user set name='$name', email='$email', mobile='$mobile', photo='$photo' , address='$address'  WHERE id='$id'");

}
function update_record2($id, $name,$email,$mobile,$address) {
	$conn = create_connection();
	mysqli_query($conn,"UPDATE user set name='$name', email='$email', mobile='$mobile', address='$address'  WHERE id='$id'");

}



function delete_record($id) {
	$sql="DELETE FROM user where id=$id";
	$conn = create_connection();

	if (mysqli_query($conn, $sql)) {
		mysqli_close($conn);
	} else {
		echo "Error while deleting record";
	}
}

function get_record_by_id($id) {

	$conn=create_connection();
	$result = mysqli_query($conn,"SELECT * FROM user WHERE id='" . $id . "'");
	$row= mysqli_fetch_array($result);
	return $row;
}


function get_records() {
	$conn = create_connection();
	$sql = "SELECT * FROM user";
	if($result = mysqli_query($conn, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table border=1>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Name</th>";
                echo "<th>Email</th>";
                echo "<th>Mobile</th>";
				echo "<th>photo</th>";
                echo "<th>address</th>";
				echo "<th colspan=2>Action</th>";
            echo "</tr>";
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['email'] . "</td>";
					echo "<td>" . $row['mobile'] . "</td>";
					$filepath = $row['photo']; 
					echo "<td> <img src='$filepath' height=50 width=50 /> </td> ";

					 echo "<td>" . $row['address'] . "</td>";
					 ?>
									

				
					
					<td>
				<a href="edit.php?edit=<?php echo $row['id']; ?>" onclick="myFunction1()" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="delete.php?del=<?php echo $row['id']; ?>" onclick="myFunction1()" class="del_btn">Delete</a>
			</td>
			
			
			<script>
				function myFunction() {
				alert("You want to Delete this record?");
				function myFunction1() {
				alert("You want to Edit this record?")
			}
			</script>
			
			<?php	
				echo "</tr>";
			}
			echo "</table>";
			// Free result set
			mysqli_free_result($result);
		} else{
			echo "No records matching your query were found.";
		}
	} else{
		echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
	}
	?>
