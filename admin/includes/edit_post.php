<?php 

			if (isset($_GET['p_id'])) {
				$the_post_id = $_GET['p_id'];
			}

		   $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
           $select_post_by_id = mysqli_query($connection, $query);
           while ($row = mysqli_fetch_assoc($select_post_by_id)) {
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];  
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_category_id = $row['post_category_id']; 
              $post_tags = $row['post_tags'];
              $post_status = $row['post_status'];
              $post_comment_count = $row['post_comment_count'];
              $post_content = $row['post_content'];
			}

			$for_preview = $post_category_id;

			if (isset($_POST['update_post'])) {

				$post_title = $_POST['title'];
				$post_author = $_POST['post_author'];
				$post_category_id = $_POST['post_category'];
				$post_status = $_POST['post_status'];
				$post_tags = $_POST['post_tags'];
				$post_content = $_POST['post_content'];
				$post_date = date('d-m-y');
				$post_image = $_FILES['image']['name'];
				$post_image_temp = $_FILES['image']['tmp_name'];

				move_uploaded_file($post_image_temp, "../../img/$post_image");

				if (empty($post_image)) {
					$query = "SELECT * FROM posts WHERE post_id = $the_post_id";
					$select_image = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_array($select_image)) {
						$post_image = $row['post_image'];
					}
				}

				$query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_date = now(), post_author = '{$post_author}', ";
				$query .= "post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' ";
				$query .= "WHERE post_id = {$the_post_id}";

				$update_post = mysqli_query($connection, $query);
				confirm($update_post);
				echo "<p class='bg-success'>Post Updated <a href = '../../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Update More Posts</a></p>";

			}

?>


<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
	</div>
	<div class="form-group">
		<label for="post_category">Post Category</label><br>
		<select name="post_category" id="">
			<?php 

			$query = "SELECT * FROM categories";
			$select_categories = mysqli_query($connection, $query);
			confirm($select_categories);
				while ($row = mysqli_fetch_assoc($select_categories)) {
				$cat_title = $row['cat_title'];
				$cat_id = $row['cat_id'];
				if ($cat_id == $for_preview) {
					echo "<option value='$cat_id' selected>{$cat_title}</option>";
					continue;
				}
				echo "<option value='$cat_id'>{$cat_title}</option>";
			}

			 ?>
		</select>
	</div>
	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
	</div>
	<div class="form-group">
		<select name="post_status" id="">
			<option value="<?php echo $post_status; ?>"><?php echo ucfirst($post_status); ?></option>
			<?php 

			if ($post_status == "published") {
				echo "<option value='draft'>Draft</option>";
			} else {
				echo "<option value='published'>Publish</option>";
			}

			 ?>
		</select>
	</div>
	<div class="form-group">
		<label for="post_image">Post Image</label><br>
		<img src="../../img/<?php echo $post_image; ?>" width="200"><br><br>
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
	</div>

	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
	</div>
</form>	