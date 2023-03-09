<?php
   if(isset($_GET["p_id"])){
      $post_id = $_GET["p_id"];
   }

   $query = "SELECT * FROM posts";
   $select_posts_by_id = mysqli_query($connection, $query);
   while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
      $post_id = $row["post_id"];
      $post_title = $row["post_title"];
      $post_author = $row["post_author"];
      $post_category_id = $row["post_category_id"];
      $post_status = $row["post_status"];
      $post_image = $row["post_image"];
      $post_content = $row["post_content"];
      $post_tags = $row["post_tags"];
      $post_comment_count = $row["post_comment_count"];
      $post_date = $row["post_date"];
   }
?>



<form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
      <label for="title">Post Title</label>
      <input type="text" name="title" value="<?php echo $post_title; ?>" class="form-control">
   </div>
   <div class="form-group">
      <select name="" id="">
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
   <div class="form-group">
      <label for="title">Post Author</label>
      <input type="text" value="<?php echo $post_author; ?>" name="author" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_status">Post Status</label>
      <input type="text" value="<?php echo $post_status; ?>" name="post_status" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_image">Post Image</label>
      <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
   </div>
   <div class="form-group">
      <label for="post_tags">Post Tags</label>
      <input type="text" name="post_tags" value="<?php echo $post_tags; ?>" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_content">Post Content</label>
      <textarea name="post_content" class="form-control" cols="30" rows="10"><?php echo $post_content; ?></textarea>
   </div>

   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
   </div>
</form>