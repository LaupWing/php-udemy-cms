<?php
   if(isset($_POST["checkBoxArray"])){
      foreach($_POST["checkBoxArray"] as $checkBoxValue){
         echo $checkBoxValue;
         $bulk_options = $_POST["bulk_options"];
      }
   }
?>

<form action="" method="post">
   <table class="table table-bordered table-hover">
      <div class="col-xs-4" id="bulkOptionsContainer">
         <select name="bulk_options" class="form=control" id="">
            <option value="">Select Options</option>
            <option value="">Publish</option>
            <option value="">Draft</option>
            <option value="">Delete</option>
         </select>
      </div>
      <div class="col-xs-4">
         <input type="submit" name="submit" class="btn btn-success" value="Apply">
         <a href="add_post.php" class="bt btn-primary">Add new</a>
      </div>
      <thead>
         <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            $query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_posts)){
               $post_id = $row["post_id"];
               $post_title = $row["post_title"];
               $post_author = $row["post_author"];
               $post_category_id = $row["post_category_id"];
               $post_status = $row["post_status"];
               $post_image = $row["post_image"];
               $post_tags = $row["post_tags"];
               $post_comment_count = $row["post_comment_count"];
               $post_date = $row["post_date"];
   
               echo "<tr>";
               echo "<td> <input class='checkboxes' type='checkbox' name='checkBoxArray[]' value='{$post_id}'></td>";
               echo "<td>{$post_id}</td>";
               echo "<td>{$post_title}</td>";
               echo "<td>{$post_author}</td>";
               $query = "SELECT * FROM categories WHERE category_id = $post_category_id";
               $select_categories_id = mysqli_query($connection, $query);
               while($row = mysqli_fetch_assoc($select_categories_id)){
                  $category_title = $row["category_title"];
                  echo "<td>{$category_title}</td>";
               }
               echo "<td>{$post_status}</td>";
               echo "<td><img width='100' src='../images/{$post_image}'/></td>";
               echo "<td>{$post_tags}</td>";
               echo "<td>{$post_comment_count}</td>";
               echo "<td>{$post_date}</td>";
               echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
               echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
               echo "</tr>";
            }
         ?>
         <?php 
            if(isset($_GET["delete"])){
               $post_id = $_GET["delete"];
               $query = "DELETE FROM posts where post_id = {$post_id}";
               $delete_query = mysqli_query($connection, $query);
               header("Location: post.php");
            }
         ?>
         
      </tbody>
   </table>
</form>