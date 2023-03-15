<?php 
   if(isset($_GET["edit_user"])){
      $user_id = $_GET["edit_user"];
      $query = "SELECT * FROM users WHERE user_id = $user_id";
      $select_user = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($select_user)){
         $user_id = $row["user_id"];
         $username = $row["username"];
         $user_password = $row["user_password"];
         $user_firstname = $row["user_firstname"];
         $user_lastname = $row["user_lastname"];
         $user_email = $row["user_email"];
         $user_image = $row["user_image"];
         $user_role = $row["user_role"];
      }
   }

   if(isset($_POST["edit_user"])){
      $user_firstname = $_POST["user_firstname"];
      $user_lastname = $_POST["user_lastname"];
      $user_email = $_POST["user_email"];
      $user_role = $_POST["user_role"];
      // $post_image = $_FILES["image"]["name"];
      // $post_image_temp = $_FILES["image"]["tmp_name"];

      $username = $_POST["username"];
      $user_password = $_POST["user_password"];
      // $post_date = date("d-m-y");

      // move_uploaded_file($post_image_temp, "../images/{$post_image}");

      $query = "UPDATE users SET ";
      $query .= "user_firstname = '{$user_firstname}', ";
      $query .= "user_lastname = '{$user_lastname}', ";
      $query .= "user_role = '{$user_role}', ";
      $query .= "user_email = '{$user_email}', ";
      $query .= "user_password = '{$user_password}', ";
      $query .= "username = '{$username}', ";
      $query .= "WHERE user_id = {$user_id} ";
      $update_user = mysqli_query($connection, $query);
      confirm($update_user);
   }
?>

<form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
      <label for="title">Firstname</label>
      <input type="text" name="user_firstname" value="<?php echo $user_firstname ?>" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_status">Lastname</label>
      <input type="text" name="user_lastname" value="<?php echo $user_lastname ?>" class="form-control">
   </div>
   <select name="user_role" id="">
      <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
      <?php 
         if($user_role == "admin"){
            echo "<option value='subscriber'>subscriber</option>";
         }else {
            echo "<option value='admin'>admin</option>";
         }
      ?>
   </select>
   
   <!-- <div class="form-group">
      <label for="post_image">User Image</label>
      <input type="file" name="image">
   </div> -->
   <div class="form-group">
      <label for="post_tags">Username</label>
      <input type="text" value="<?php echo $username ?>" name="username" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_content">Email</label>
      <input name="user_email" value="<?php echo $user_email ?>" class="form-control" type="email" />
   </div>
   <div class="form-group">
      <label for="post_content">Password</label>
      <input name="user_password" value="<?php echo $user_password ?>" class="form-control" type="password" />
   </div>

   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="edit_user"  value="Update User">
   </div>
</form>