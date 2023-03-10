<?php 
   if(isset($_POST["create_user"])){
      $user_firstname = $_POST["user_firstname"];
      $user_lastname = $_POST["user_lastname"];
      $user_email = $_POST["user_email"];
      $user_role = $_POST["user_role"];
      // $post_image = $_FILES["image"]["name"];
      // $post_image_temp = $_FILES["image"]["tmp_name"];

      $username = $_POST["username"];
      $user_password = $_POST["user_password"];
      // $post_date = date("d-m-y");

      move_uploaded_file($post_image_temp, "../images/{$post_image}");

      $query = "INSERT INTO users(user_id, user_firstname, user_lastname, user_role, username, user_email, user_password)";
      $query .= "VALUES({$user_id},'{$user_firstname}','{$user_lastname}', '{$user_role}','{$username}','{$user_email}','{$user_password}')";

      $create_user_query = mysqli_query($connection, $query);

      confirm($create_user_query);
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
      <option value="subscriber">Select options</option>      
      <option value="admin">Admin</option>      
      <option value="subscriber">Subscriber</option>      
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