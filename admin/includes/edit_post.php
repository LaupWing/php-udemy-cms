<?php
   if(isset($_GET["p_id"])){
      $post_id = $_GET["p_id"];
   }

   $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
   $select_posts_by_id = mysqli_query($connection, $query);
   while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
      $post_id = $row["post_id"];
      $post_title = $row["post_title"];
      $post_user = $row["post_user"];
      $post_category_id = $row["post_category_id"];
      $post_status = $row["post_status"];
      $post_image = $row["post_image"];
      $post_content = $row["post_content"];
      $post_tags = $row["post_tags"];
      $post_comment_count = $row["post_comment_count"];
      $post_date = $row["post_date"];
   }

   if(isset($_POST["update_post"])){
      $post_user = mysqli_real_escape_string($connection, $_POST["author"]);
      $post_title = mysqli_real_escape_string($connection, $_POST["title"]);
      $post_category_id = mysqli_real_escape_string($connection, $_POST["post_category"]);
      $post_status = mysqli_real_escape_string($connection, $_POST["post_status"]);
      $post_image = $_FILES["image"]["name"];
      $post_image_temp = $_FILES["image"]["tmp_name"];
      $post_content = mysqli_real_escape_string($connection, $_POST["post_content"]);
      $post_tags = mysqli_real_escape_string($connection, $_POST["post_tags"]);

      move_uploaded_file($post_image_temp, "../images/$post_image");

      if(empty($post_image)){
         $query = "SELECT * FROM posts WHERE post_id = $post_id";
         $select_image = mysqli_query($connection, $query);
         while($row = mysqli_fetch_array($select_image)){
            $post_image = $row["post_image"];
         }
      }
      
      $query = "UPDATE posts SET ";
      $query .= "post_title = '{$post_title}', ";
      $query .= "post_category_id = '{$post_category_id}', ";
      $query .= "post_date = now(), ";
      $query .= "post_user = '{$post_user}', ";
      $query .= "post_status = '{$post_status}', ";
      $query .= "post_tags = '{$post_tags}', ";
      $query .= "post_content = '{$post_content}', ";
      $query .= "post_image = '{$post_image}' ";
      $query .= "WHERE post_id = {$post_id} ";
      $update_post = mysqli_query($connection, $query);
      confirm($update_post);

      echo "<p class='bg-success'>Post updated. <a href='../post.php?p_id={$post_id}'>View Post</a> Or <a href='posts.php'>Eidt more post</a></p>";
   }
?>



<form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
      <label for="title">Post Title</label>
      <input type="text" name="title" value="<?php echo $post_title; ?>" class="form-control">
   </div>
   <div class="form-group">
      <select name="post_category" id="">
         <?php 
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirm($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)){
               $category_id = $row["category_id"];
               $category_title = $row["category_title"];
               echo "<option value='{$category_id}'>{$category_title}</option>";
            }
         ?>
         
      </select>
   </div>
   <div class="form-group">
      <label for="post_category">Post Category Id</label>
      <input type="text" name="post_category_id" value="<?php echo $post_category_id; ?>" class="form-control">
   </div>
   <!-- <div class="form-group">
      <label for="author">Post Author</label>
      <input type="text" value="<?php echo $post_user; ?>" name="author" class="form-control">
   </div> -->
   <div class="form-group">
      <label for="users">Users</label>
      <select name="post_user" id="">
         <?php 
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
   
            confirm($select_users);
   
            while($row = mysqli_fetch_assoc($select_users)){
               $user_id = $row["user_id"];
               $username = $row["username"];
               echo "<option value='{$username}'>{$username}</option>";
            }
         ?>
         
      </select>
   </div>
   <div class="form-group">
      <select name="post_status" id="">
         <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
         <?php 
            if($post_status == "published") {
               echo "<option value='draft'>Draft</option>";
            }else {
               echo "<option value='published'>Published</option>";
            }
         ?>
      </select>
   </div>
   <div class="form-group">
      <label for="post_image">Post Image</label>
      <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
      <input type="file" name="image">
   </div>
   <div class="form-group">
      <label for="post_tags">Post Tags</label>
      <input type="text" name="post_tags" value="<?php echo $post_tags; ?>" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_content">Post Content</label>
      <textarea name="post_content" id="summernote" class="form-control" cols="30" rows="10"><?php echo $post_content; ?></textarea>
   </div>

   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="update_post" value="Publish Post">
   </div>
</form>