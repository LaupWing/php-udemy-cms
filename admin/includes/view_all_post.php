<?php
   if(isset($_POST["checkBoxArray"])){
      foreach($_POST["checkBoxArray"] as $post_id){
         $bulk_options = $_POST["bulk_options"];

         switch($bulk_options){
            case "published":
               $query = "UPDATE posts SET post_status = 'published'  WHERE post_id = {$post_id}";
               $update_published_status = mysqli_query($connection, $query);
               confirm($update_published_status);
               break;
            case "draft":
               $query = "UPDATE posts SET post_status = 'draft'  WHERE post_id = {$post_id}";
               $update_draft_status = mysqli_query($connection, $query);
               confirm($update_draft_status);
               break;
            case "delete":
               $query = "DELETE FROM posts WHERE post_id = {$post_id}";
               $update_delete_status = mysqli_query($connection, $query);
               confirm($update_delete_status);
               break;
            case "clone":
               $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
               $select_post_query = mysqli_query($connection, $query);
               while($row = mysqli_fetch_array($select_post_query)){
                  $post_title = $row["post_title"];
                  $post_category_id = $row["post_category_id"];
                  $post_date = $row["post_date"];
                  $post_author = $row["post_author"];
                  $post_status = $row["post_status"];
                  $post_image = $row["post_image"];
                  $post_tags = $row["post_tags"];
                  $post_content = $row["post_content"];
               }
               $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";
               $quyer .= "VALUES({$post_category_id}, '{$post_title}','{$post_author}', now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

               $copy_query = mysqli_query($connection, $query);
               if(!$copy_query){
                  die("QUERY FAILED". mysqli_error($connection));
               }
               break;
         }
      }
   }
?>

<form action="" method="post">
   <table class="table table-bordered table-hover">
      <div class="col-xs-4" id="bulkOptionsContainer">
         <select name="bulk_options" class="form=control" id="">
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clonse">Clone</option>
         </select>
      </div>
      <div class="col-xs-4">
         <input type="submit" name="submit" class="btn btn-success" value="Apply">
         <a href="posts.php?source=add_post" class="bt btn-primary">Add new</a>
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
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Count</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
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
               $post_views_count = $row["post_views_count"];
   
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
               echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
               echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
               echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?')\" href='posts.php?delete={$post_id}'>Delete</a></td>";
               echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
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
            if(isset($_GET["rest"])){
               $post_id = $_GET["reset"];
               $query = "UPDATE posts SET post_views_count = 0 where post_id = {$post_id}";
               $reset_query = mysqli_query($connection, $query);
               header("Location: post.php");
            }
         ?>
         
      </tbody>
   </table>
</form>