<?php 

function insert_categories() {
	global $connection;
	if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty!";
        } else {
            $query = "INSERT INTO categories(cat_title)";
            $query .= "VALUE('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);
            if(!$create_category_query) die('QUERY FAILED' . mysqli_error($connection));
        }
    }

}

function findAllCategories() {
	global $connection;
	$query = "SELECT * FROM categories";
	$select_categories = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($select_categories)) {
	$cat_title = $row['cat_title'];
	$cat_id = $row['cat_id'];
	echo " <tr>
	         <td>{$cat_id}</td>
	         <td>{$cat_title}</td>
	         <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
	         <td><a href='categories.php?update={$cat_id}'>Update</a></td>
	      </tr>";
	}
}

function deleteCategories() {
	global $connection;
	if (isset($_GET['delete'])) {
    	$the_cat_id = $_GET['delete'];
		$query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
	    $delete_query = mysqli_query($connection,$query);
	    header("Location: categories.php");
	}
}

function confirm($result){
	global $connection;
	if(!$result){
		die("QUERY FAILED . " . mysqli_error($connection));
	}
}
 function getUsername(){
	global $connection;
	$query = "SELECT username FROM users WHERE user_id = {$_SESSION['user_id']}";
	$select_username_query = mysqli_query($connection, $query);
	confirm($select_username_query);
	$username = mysqli_fetch_assoc($select_username_query)['username'];
	return $username;
                 
 }

 function usersOnline(){
 	
 	global $connection;
 	$session = session_id();
	$time = time();
	$time_out_in_seconds = 30;
	$time_out = $time - $time_out_in_seconds;
	$query = "SELECT * FROM users_online WHERE session = '{$session}'";
	$send_query = mysqli_query($connection, $query);
	confirm($send_query);
	$count = mysqli_num_rows($send_query);

	if ($count == NULL) {
	    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session' , $time)");
	} else {
	    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '{$session}'");
	}

	$users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > {$time_out}");
	confirm($users_online);
	return $count_user = mysqli_num_rows($users_online);
 }

 ?>