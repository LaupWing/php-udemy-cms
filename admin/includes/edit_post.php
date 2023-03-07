<form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
      <label for="title">Post Title</label>
      <input type="text" name="title" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_category">Post Category Id</label>
      <input type="text" name="post_category_id" class="form-control">
   </div>
   <div class="form-group">
      <label for="title">Post Author</label>
      <input type="text" name="author" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_status">Post Status</label>
      <input type="text" name="post_status" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_image">Post Image</label>
      <input type="file" name="image">
   </div>
   <div class="form-group">
      <label for="post_tags">Post Tags</label>
      <input type="text" name="post_tags" class="form-control">
   </div>
   <div class="form-group">
      <label for="post_content">Post Content</label>
      <textarea name="post_content" class="form-control" cols="30" rows="10"></textarea>
   </div>

   <div class="form-group">
      <input type="submit" class="btn btn-primary" name="create_post"  value="Publish Post">
   </div>
</form>