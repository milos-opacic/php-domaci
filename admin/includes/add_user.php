<?php 

if (isset($_POST['create_user'])) {

	$user_firstname = $_POST['user_firstname'];
	$user_lastname = $_POST['user_lastname'];
	$user_role = $_POST['user_role'];
	$username = $_POST['username'];
	$user_email = $_POST['user_email'];
	$user_password = $_POST['user_password'];
	// $post_date = date('d-m-y');
	$user_image = $_FILES['user_image']['name'];
	$user_image_temp = $_FILES['user_image']['tmp_name'];
// 	// $post_comment_count = 4;

	move_uploaded_file($user_image_temp, "../../img/$user_image");	

	$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

	// $query = "SELECT randSalt FROM users";
	// $select_randsalt_query = mysqli_query($connection, $query);
	// confirm($select_randsalt_query);
	// $row = mysqli_fetch_assoc($select_randsalt_query);
	// $salt = $row['randSalt'];
	// $hashed_password = crypt($user_password, $salt);
  

	$query = "INSERT INTO users(username ,user_firstname ,user_password ,user_lastname ,user_email ,user_image , user_role)";
	$query .= "VALUES('{$username}', '{$user_firstname}', '{$user_password}', '{$user_lastname}', '{$user_email}', '{$user_image}', '{$user_role}')";
	$create_user_query = mysqli_query($connection, $query);
	confirm($create_user_query);
	echo "<p class='bg-success'>User created! " . "<a href='users.php'>View users</a></p>";

 }

?>



<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
		<label for="post_author">Firstname</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>
	<div class="form-group">
		<label for="post_status">Lastname</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>
	<div class="form-group">
		<label for="user_role">User role</label><br>
		<select name="user_role" id="">
			<option value="subscriber">Select Options</option>
			<option value="admin">admin</option>
			<option value="subscriber">subscriber</option>
		</select>
	</div>
	<div class="form-group">
		<label for="user_image">User image</label>
		<input type="file" name="user_image">
	</div>
	<div class="form-group">
		<label for="post_tags">Username</label>
		<input type="text" class="form-control" name="username">
	</div>
	<div class="form-group">
		<label for="post_content">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>
	<div class="form-group">
		<label for="post_content">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>

	<div class="form-group"> 
		<input class="btn btn-primary" type="submit" name="create_user" value="Add User">
	</div>
</form>	