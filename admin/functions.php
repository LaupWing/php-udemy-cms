<?php 
function insert_categories(){
   global $connection;
   if(isset($_POST["submit"])){
      $category_title = $_POST["category_title"];

      if($category_title == "" || empty($category_title)){
         echo "This field should not be empty";
      } else {
         $query = "INSERT INTO categories(category_title)";
         $query .= "VALUES('{$category_title}')";

         $create_category_query = mysqli_query($connection, $query);

         if(!$create_category_query){
            die("QUERY FAILED". mysqli_error($connection));
         }
      }
   }
}

function ifItIsMethod($method = null){
   if($_SERVER["REQUEST_METHOD"] == strtoupper($method)){
      return true;
   }else{
      return false;
   }
}

function isLoggedIn(){
   if(isset($_SESSION["user_role"])){
      return true;
   }else{
      return false;
   }
}

function query($query){
   global $connection;
   return mysqli_query($connection, $query);
}

function loggedInUserId(){
   if(isLoggedIn()){
      $result = query("SELECT * FROM users WHERE username={$_SESSION['username']}");
      confirm($result);
      $user = mysqli_fetch_array($result);
      if(mysqli_num_rows($result) >= 1){
         return $user["user_id"];
      }
   }
   return false;
}

function userLikedPost($post_id = ""){
   $result = query("SELECT * FROM likes WHERE user_id=". loggedInUserId(). "AND post_id={$post_id}");
   return mysqli_num_rows($result) >= 1 ? true : false;
}

function getPostLikes($post_id) {
   $result = query("SELECT * FROM likes WHERE post_id={$post_id}");
   confirm($result);
   echo mysqli_num_rows($result);
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation){
   if(isLoggedIn()){
      redirect($redirectLocation);
   }
}

function escape($string){
   global $connection;
   mysqli_real_escape_string($connection, trim($string));
}

function users_online(){
   
   if(isset($_GET["onlineusers"])){
      global $connection;

      if(!$connection){
         session_start();
         include("../includes/db.php");
         $session = session_id();
         $time = time();
         $time_out_in_seconds = 60;
         $time_out = $time - $time_out_in_seconds; 
      
         $query = "SELECT * FROM users_online WHERE session = '$session'";
         $send_query = mysqli_query($connection, $query);
         $count = mysqli_num_rows($send_query);
      
         if($count === NULL){
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('{$session}', '{$time}')");
         }else{
            mysqli_query($connection, "UPDATE users_online SET time '{$time}' WHERE session ='{$session}'");
         }
         $users_online_query = mysqli_query(
            $connection, 
            "SELECT * FROM users_online WHERE time > '{$time_out}'");
         $count_user = mysqli_num_rows($users_online_query);
         echo $count_user;
      }
   }

}
users_online();

function findAllCategories() {
   global $connection;
   $query = "SELECT * FROM categories";
   $select_categories = mysqli_query($connection, $query);
   while($row = mysqli_fetch_assoc($select_categories)){
      $category_id = $row["category_id"];
      $category_title = $row["category_title"];
      echo "<tr>";
      echo "<td>{$category_id}</td>";
      echo "<td>{$category_title}</td>";
      echo "<td><a href='categories.php?delete={$category_id}'>Delete</a></td>";
      echo "<td><a href='categories.php?edit={$category_id}'>Edit</a></td>";
      echo "</tr>";
   }
}

function deleteCategories(){
   global $connection;
   if(isset($_GET["delete"])){
      $delete_category_id = $_GET["delete"];
      $query = "DELETE FROM categories WHERE category_id = {$delete_category_id}";
      $delete_query = mysqli_query($connection, $query);
      header("Location: categories.php");
   }
}

function confirm($result){
   global $connection;
   if(!$result){
      die("QUERY FAILED". mysqli_error($connection));
   }
}

function recordCount($table){
   global $connection;
   $query = "SELECT * FROM $table";
   $select_all_post = mysqli_query($connection, $query);
   $result = mysqli_num_rows($select_all_post);
   confirm($result);
   return $result;
}

function checkStatus($table, $column, $status) {
   global $connection;
   $query = "SELECT * FROM $table WHERE $column = '$status'";
   $result = mysqli_query($connection, $query);
   return mysqli_num_rows($result);
}

function checkUserRole($table, $column, $role) {
   global $connection;
   $query = "SELECT * FROM $table WHERE $column = '$role'";
   $result = mysqli_query($connection, $query);
   return mysqli_num_rows($result);
}

function isAdmin($username = ""){
   global $connection;

   $query = "SELECT user_role FROM users WHERE username = '$username'"; 
   $result = mysqli_query($connection, $query);

   confirm($result);

   $row = mysqli_fetch_array($result);

   if($row["user_role"] == "admin"){
      return true;
   }else{
      return false;
   }
}

function usernameExists($username){
   global $connection;

   $query = "SELECT username FROM users WHERE username = '$username'"; 
   $result = mysqli_query($connection, $query);

   confirm($result);
   if(mysqli_num_rows($result) > 0){
      return true;
   }else{
      return false;
   }
}

function emailExists($email){
   global $connection;

   $query = "SELECT user_email FROM users WHERE user_email = '$email'"; 
   $result = mysqli_query($connection, $query);

   confirm($result);
   if(mysqli_num_rows($result) > 0){
      return true;
   }else{
      return false;
   }
}


function redirect($location){
   header("Location: ". $location);
   exit;
}

function imagePlaceholder($image = ""){
   if(!$image){
      return "image_4.jpg"; 
   }else {
      return $image;
   }
}

function registerUser($username, $email, $password){
   global $connection;

   $username = mysqli_real_escape_string($connection, $username);
   $email = mysqli_real_escape_string($connection, $email);
   $password = mysqli_real_escape_string($connection, $password);

   $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));

   $query = "INSERT INTO users (username, user_email, user_password, user_role)";
   $query .= "VALUES('{$username}','{$email}','{$password}', 'subscriber')";
   $register_user_query = mysqli_query($connection, $query);
   
   confirm($register_user_query);
   
}

function loginUser($username, $password){
   global $connection;
   $username = trim(mysqli_real_escape_string($connection, $username));
   $password = trim(mysqli_real_escape_string($connection, $password));

   $query = "SELECT * FROM users WHERE username = '{$username}'";
   $select_user_query = mysqli_query($connection, $query);

   if(!$select_user_query){
      die("QUERY FAILED". mysqli_error($connection));
   }

   while($row = mysqli_fetch_array($select_user_query)){
      $db_user_id = $row["user_id"];
      $db_username = $row["username"];
      $db_user_firstname = $row["user_firstname"];
      $db_user_password = $row["user_password"];
      $db_user_lastname = $row["user_lastname"];
      $db_user_role = $row["user_role"];
      $password = crypt($password, $db_user_password);
   
      if($username === $db_username && password_verify($password, $db_user_password)){
         $_SESSION["username"] = $db_username;
         $_SESSION["user_firstname"] = $db_user_firstname;
         $_SESSION["user_lastname"] = $db_user_lastname;
         $_SESSION["user_role"] = $db_user_role;
         
         redirect("/cms/admin");
      }else {
         return false;
      }
   }

}
?>