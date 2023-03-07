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
                     <?php insert_categories();?>
                     <form action="" method="post">
                        <div class="form-group">
                           <label for="category-title">Add Category</label>
                           <input class="form-control" type="text" name="category_title">
                        </div>
                        <div class="form-group">
                           <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                        </div>
                     </form>
                     <?php 
                        if(isset($_GET["edit"])){
                           $category_id = $_GET["edit"];
                           include "includes/update_categories.php";
                        }
                     ?>
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
                           <?php findAllCategories();?>
                           <?php deleteCategories();?>
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