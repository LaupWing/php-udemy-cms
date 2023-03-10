<table class="table table-bordered table-hover">
   <thead>
      <tr>
         <th>Id</th>
         <th>Author</th>
         <th>Comment</th>
         <th>Email</th>
         <th>Status</th>
         <th>In Response to</th>
         <th>Date</th>
         <th>Approve</th>
         <th>Unapprove</th>
         <th>Delete</th>
      </tr>
   </thead>
   <tbody>
      <?php 
         $query = "SELECT * FROM comments";
         $select_comments = mysqli_query($connection, $query);
         while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row["comment_id"];
            $comment_post_id = $row["comment_post_id"];
            $comment_author = $row["comment_author"];
            $comment_email = $row["comment_email"];
            $comment_content = $row["comment_content"];
            $comment_status = $row["comment_status"];
            $comment_date = $row["comment_date"];

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            
            // $query = "SELECT * FROM categories WHERE category_id = $post_category_id";
            // $select_categories_id = mysqli_query($connection, $query);
            // while($row = mysqli_fetch_assoc($select_categories_id)){
            //    $category_title = $row["category_title"];
            //    echo "<td>{$category_title}</td>";
            // }
            // echo "<td>{$post_status}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";
            echo "<td>Some title</td>";
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$comment_id}'>Approve</a></td>";
            echo "<td><a href='posts.php?delete={$comment_id}'>Unapprove</a></td>";
            echo "<td><a href='posts.php?delete={$comment_id}'>Delete</a></td>";
            echo "</tr>";
         }
      ?>
      <?php 
         if(isset($_GET["delete"])){
            $post_id = $_GET["delete"];
            $query = "DELETE FROM posts where post_id = {$post_id}";
            $delete_query = mysqli_query($connection, $query);
         }
      ?>
      
   </tbody>
</table>