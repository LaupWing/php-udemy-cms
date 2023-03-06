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
                     <form action="">
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
                        $query = "SELECT * FROM categories";
                        $select_categories = mysqli_query($connection, $query);
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
                              while($row = mysqli_fetch_assoc($select_categories)){
                                 $category_id = $row["category_id"];
                                 $category_title = $row["category_title"];
                                 echo "<tr>";
                                 echo "<td>{$category_id}</td>";
                                 echo "<td>{$category_title}</td>";
                                 echo "</tr>";
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