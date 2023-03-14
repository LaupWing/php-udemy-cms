<?php 
   if(isset($_POST["create_post"])){
      $post_title = $_POST["title"];
      $post_author = $_POST["author"];
      $post_category_id = $_POST["post_category"];
      $post_status = $_POST["post_status"];
      $post_image = $_FILES["image"]["name"];
      $post_image_temp = $_FILES["image"]["tmp_name"];

      $post_tags = $_POST["post_tags"];
      $post_content = $_POST["post_content"];
      $post_date = date("d-m-y");

      move_uploaded_file($post_image_temp, "../images/{$post_image}");

      $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";
      $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(), '{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

      $create_post_query = mysqli_query($connection, $query);

      confirm($create_post_query);
   }
?>

<form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
      <label for="title">Post Title</label>
      <input type="text" name="title" class="form-control">
   </div>
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
   <div class="form-group">
      <label for="title">Post Author</label>
      <input type="text" name="author" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_status">Post Status</label>
      <input type="text" name="post_status" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_image">Post Image</label>
      <input type="file" name="image">
   </div>
   <div class="form-group">
      <label for="post_tags">Post Tags</label>
      <input type="text" name="post_tags" class="form-control">
   </div>
   <div class="form-group">
      <label for="summernote">Post Content</label>
      <textarea name="post_content" id="summernote" class="form-control" cols="30" rows="10"></textarea>
   </div>

   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="create_post"  value="Publish Post">
   </div>
</form>