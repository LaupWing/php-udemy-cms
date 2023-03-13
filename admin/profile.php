<?php include "includes/admin_header.php";?>
<?php 

   if(isset($_SESSION["username"])){
      
   }
?>
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
                        <input type="submit" class="btn btn-primary" name="edit_user"  value="Publish Post">
                     </div>
                  </form>
               </div>
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
      </div>
      <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>