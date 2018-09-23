<?php 


if (isset($_POST['checkboxArray'])) {
  foreach ($_POST['checkboxArray'] as $checkboxValue) {
    $bulk_options = $_POST['bulk_options'];
    switch ($bulk_options) {
      case 'published':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkboxValue}";
        $update_to_publish_status = mysqli_query($connection, $query);
        confirm($update_to_publish_status);
        break;
      case 'draft':
        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkboxValue}";
        $update_to_draft_status = mysqli_query($connection, $query);
        confirm($update_to_draft_status);
        break;
      case 'delete':
        $query = "DELETE FROM posts WHERE post_id = {$checkboxValue}";
        $delete_post = mysqli_query($connection, $query);
        confirm($delete_post);
        break;
      case 'clone':
        $query = "SELECT * FROM posts WHERE post_id = {$checkboxValue}";
        $select_posts_query = mysqli_query($connection, $query);
        confirm($select_posts_query);
        while ($row = mysqli_fetch_assoc($select_posts_query)) {
          $post_title = $row['post_title'];
          $post_author = $row['post_author'];  
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          $post_category_id = $row['post_category_id']; 
          $post_tags = $row['post_tags'];
          $post_status = $row['post_status'];
          $post_content = $row['post_content'];
        }
        $query = "INSERT INTO posts(post_category_id ,post_title ,post_author ,post_date ,post_image ,post_content ,post_tags , post_status)";
        $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
        $copy_query = mysqli_query($connection, $query);
        confirm($copy_query);
        break;
      case 'reset':
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$checkboxValue}";
        $reset_query = mysqli_query($connection, $query);
        confirm($reset_query);
        break;
      default:
        # code...
        break;
    }
  }
}

 ?>
<form action="" method="post">
<table class="table table-bordered table-hover">
  <div id="bulkOptionContainer" class="col-xs-4" style="padding-left: 0px;">
    <select name="bulk_options" id="" class="form-control">
      <option value="">Select Options</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
      <option value="clone">Clone</option>
      <option value="reset">Reset Reviews</option>
    </select>
  </div>
  <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
  </div>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th>Post Reviews</th>
                                    <th>Reset Reviews</th>
                                    <th>View Post</th>
                                    <th>Delete</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
<?php 

           $query = "SELECT * FROM posts ORDER BY post_id DESC";
           $select_posts = mysqli_query($connection, $query);
           while ($row = mysqli_fetch_assoc($select_posts)) {

              $post_title = $row['post_title'];
              $post_author = $row['post_author'];  
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_category_id = $row['post_category_id'];
              $post_id = $row['post_id'];  
              $post_tags = $row['post_tags'];
              $post_status = $row['post_status'];
              $post_comment_count = $row['post_comment_count'];
              $post_views_count = $row['post_views_count'];
              ?>

              <tr>

              <td><input type="checkbox" name="checkboxArray[]" class="checkBoxes" value="<?php echo $post_id; ?>"></td>

              <?php

              echo "<td>{$post_id}</td>
                    <td>{$post_author}</td>
                    <td>{$post_title}</td>";        


              $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
              $select_categories_id = mysqli_query($connection, $query); 
              $cat_title = mysqli_fetch_assoc($select_categories_id)['cat_title'];

              echo "<td>{$cat_title}</td>";
          
          
              echo "<td>{$post_status}</td>
                    <td><img width='100' src= '../../img/{$post_image}' alt= 'image'</td>
                    <td>{$post_tags}</td>";

              $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id} AND comment_status = 'approved'";
              $send_query = mysqli_query($connection, $query);
              $count_comments = mysqli_num_rows($send_query);

              echo "<td>{$count_comments}</td>";     


              echo "<td>{$post_date}</td>
                    <td>{$post_views_count}</td>
                    <td><a href='posts.php?resetViews={$post_id}'>Reset</a></td>
                    <td><a href='../../post.php?p_id={$post_id}'>View Post</a></td>";
                ?>
                    <td><button class="btn btn-danger delete" id="del_<?php echo $post_id; ?>">Delete</button></td>
                <?php
              echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Update</a></td>
              </tr>";                                 
    }   
 ?>
                            </tbody>
                        </table>
 </form>
 <script type="text/javascript">
    $(document).ready(function(){
        // Delete 
        $('.delete').click(function(){
          event.preventDefault();
            var el = this;
            var id = this.id;
            var splitid = id.split("_");

            // Delete id
            var deleteid = splitid[1];

            // AJAX Request
            $.ajax({
                url: '../includes/delete_data.php',
                type: 'POST',
                data: { id:deleteid },
                success: function(response){
                    // Removing row from HTML Table
                    $(el).closest('tr').css('background','tomato');
                    $(el).closest('tr').fadeOut(800, function(){ 
                        $(this).remove();
                    });
                }
            });

        });
    });
</script>

<?php 

if (isset($_GET['resetViews'])) {
  $the_post_id = $_GET['resetViews'];
  $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $the_post_id) . "";
  $reset_query = mysqli_query($connection, $query);
  confirm($reset_query);
  header("Location: posts.php");
}

?>