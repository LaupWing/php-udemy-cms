<?php include "includes/admin_header.php";?>
   <?php include "includes/admin_navigation.php"; ?>
      <div id="page-wrapper">

         <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
               <div class="col-lg-12">
                  <h1 class="page-header">
                     Welcom to admin
                     <small>Author</small>
                  </h1>
                  <div class="col-xs-6">
                     <?php 
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
                     ?>
                     <form action="" method="post">
                        <div class="form-group">
                           <label for="category-title">Add Category</label>
                           <input class="form-control" type="text" name="category_title">
                        </div>
                        <div class="form-group">
                           <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                     </form>
                  </div>
                  <div class="col-xs-6">
                     <?php 
                       
                     ?>
                     <table class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>Id</th>
                              <th>Category Title</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              $query = "SELECT * FROM categories";
                              $select_categories = mysqli_query($connection, $query);
                              while($row = mysqli_fetch_assoc($select_categories)){
                                 $category_id = $row["category_id"];
                                 $category_title = $row["category_title"];
                                 echo "<tr>";
                                 echo "<td>{$category_id}</td>";
                                 echo "<td>{$category_title}</td>";
                                 echo "<td><a href='categories.php?delete={$category_id}'>Delete</a></td>";
                                 echo "</tr>";
                              }
                           ?>
                           <?php 
                              if(isset($_GET["delete"])){
                                 $delete_category_id = $_GET["delete"];
                                 $query = "DELETE FROM categories WHERE category_id = {$delete_category_id}";
                                 $delete_query = mysqli_query($connection, $query);
                                 header("Location: categories.php");
                              }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <!-- /.row -->

         </div>
         <!-- /.container-fluid -->

      </div>
      <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>