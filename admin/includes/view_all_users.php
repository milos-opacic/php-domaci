<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Admin</th>
                                    <th>Subscriber</th>
                                    <th>Delete</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
<?php 

           $query = "SELECT * FROM users";
           $select_users = mysqli_query($connection, $query);
           while ($row = mysqli_fetch_assoc($select_users)) {

              $user_id = $row['user_id'];
              $username = $row['username'];  
              $user_password = $row['user_password'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_email = $row['user_email'];  
              $user_image = $row['user_image'];
              $user_role = $row['user_role'];

              echo "<tr>
                      <td>{$user_id}</td>
                      <td>{$username}</td>
                      <td>{$user_firstname}</td>";


              // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
              // $select_categories_id = mysqli_query($connection, $query); 
              // while ($row = mysqli_fetch_assoc($select_categories_id)) {
              //    $cat_title = $row['cat_title'];
              //    $cat_id = $row['cat_id'];
              //    echo "<td>{$cat_title}</td>";
              //  }
              
                 echo "<td>{$user_lastname}</td>
                      <td>{$user_email}</td>
                      <td>{$user_role}</td>
                      <td><img width='100' height='130' src= '../../img/{$user_image}' alt= 'image'</td>";

                // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                // $select_post_id_query = mysqli_query($connection, $query);
                // while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                //   $post_id = $row['post_id'];
                //   $post_title = $row['post_title'];
                //   echo "<td><a href='../../post.php?p_id=$post_id'>{$post_title}</a></td>";
                // }
                      


                 echo "
                      <td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>
                      <td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>
                      <td><a href='users.php?delete={$user_id}'>Delete</a></td>
                      <td><a href='users.php?source=edit_user&u_id={$user_id}'>Update</a></td>
                                </tr>";                       
                                    
    }   
 ?>
                            </tbody>
                        </table>

<?php 

if (isset($_GET['change_to_admin'])) {
  $the_user_id = $_GET['change_to_admin'];
  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
  $change_admin_query = mysqli_query($connection, $query);
  confirm($change_admin_query);
  header("Location: users.php");
}


if (isset($_GET['change_to_sub'])) {
  $the_user_id = $_GET['change_to_sub'];
  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
  $change_sub_query = mysqli_query($connection, $query);
  confirm($change_sub_query);
  header("Location: users.php");
}


if (isset($_GET['delete'])) {
  $the_user_id = $_GET['delete'];
  $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
  $delete_user_query = mysqli_query($connection, $query);
  confirm($delete_user_query);
  header("Location: users.php");
}

?>