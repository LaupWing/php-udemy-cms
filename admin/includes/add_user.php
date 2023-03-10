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
      <label for="title">Firstname</label>
      <input type="text" name="user_firstname" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_status">Lastname</label>
      <input type="text" name="user_lastname" class="form-control">
   </div>
   <select name="user_role" id="">
      <?php 
         $query = "SELECT * FROM users";
         $select_users = mysqli_query($connection, $query);

         confirm($select_users);

         while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row["user_id"];
            $user_role = $row["user_role"];
            echo "<option value='{$user_id}'>{$user_role}</option>";
         }
      ?>
      
   </select>
   
   <!-- <div class="form-group">
      <label for="post_image">User Image</label>
      <input type="file" name="image">
   </div> -->
   <div class="form-group">
      <label for="post_tags">Username</label>
      <input type="text" name="username" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_content">Email</label>
      <input name="user_email" class="form-control" type="email" />
   </div>
   <div class="form-group">
      <label for="post_content">Password</label>
      <input name="user_password" class="form-control" type="password" />
   </div>

   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="create_user"  value="Publish Post">
   </div>
</form>