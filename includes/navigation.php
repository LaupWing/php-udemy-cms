<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="index">CMS</a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
            <?php 
               $query = "SELECT * FROM categories";
               $select_all_categories_query = mysqli_query($connection, $query);
               while($row = mysqli_fetch_assoc($select_all_categories_query)){
                  $category_title = $row["category_title"];
                  $category_id = $row["category_id"];
                  $category_class = "";

                  $registration_class = "";

                  $pageName = basename($_SERVER["PHP_SELF"]);
                  $registration = 'registration.php';

                  if(isset($_GET["category"]) && $_GET["category"] == $category_id){
                     $category_class = "active";
                  } else if($pageName == $registration) {
                     $registration_class = "active";
                  }
                  echo "<li class='{$category_class}'> <a href='#'> {$category_title} </a> </li>";
               }
            ?>

            <li>
               <a href="/cms/admin">Admin</a>
            </li>
            <li class="<?php echo $registration_class; ?>">
               <a href="/cms/registration.php">Registration</a>
            </li>
            <li>
               <a href="/cms/contact.php">Contact</a>
            </li>
            <?php
               session_start();
               if(isset($_SESSION["username"])){
                  if(isset($_GET["p_id"])) {
                     $post_id = $_GET["p_id"];
                     echo "<li><a href='/cms/admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
                  }
               }
            ?>
            
         </ul>
      </div>
   </div>
</nav>