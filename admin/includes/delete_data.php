<?php 
include "../../includes/db.php";

if (isset($_POST['id'])) {
  $the_post_id = $_POST['id'];
  $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
  mysqli_query($connection, $query);
}

 ?>