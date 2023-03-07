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

?>