<?php include("includes/header.php"); ?>
<?php if(!$session->is_logged_in()) redirect('login.php'); ?>

<?php if(isset($_GET['delete']) && !is_empty($_GET['delete'])) { // DELETE PHOTO
    $photo_id = $db->escape($_GET['delete']);
    $photo    = Photo::find_by_id($photo_id, 'photo_id');
    if($photo)
        $message = $photo->delete_photo() ? 'Deleted photo.' : 'Cannot delete this photo.';
    else
        $message = 'Photo is not existed.';
    
    $session->message($message);
    redirect('photos.php');
}
?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<?php include("includes/navigation.php"); ?>

<?php include("includes/sidebar.php"); ?>
        </nav><!-- /.navbar-collapse -->

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            PHOTOS
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Photos Page
                            </li>
                        </ol>
<?php if(isset($_GET['edit']) && !is_empty($_GET['edit'])): // EDIT PHOTO ?>
<?php
$photo_id = $db->escape($_GET['edit']);
$photo    = Photo::find_by_id($photo_id, 'photo_id');
?>

<?php if(isset($_POST['update']) && isset($photo)) {
    $photo->photo_title   = $db->escape($_POST['title']);
    $photo->photo_caption = $db->escape($_POST['caption']);
    $photo->photo_alt     = $db->escape($_POST['alt']);
    $photo->photo_desc    = $db->escape($_POST['desc']);
    if($photo->save())
        $message = 'Updated photo successfully!';
    else
        $message = 'Info not changed or some errors existed.';
    
    $session->message($message);
    redirect('photos.php');
    
} ?>
                        <form action="photos.php?edit=<?php echo $photo_id; ?>" method="post">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Photo Title: </label>
                                    <input type="text" name="title" id="title" class="form-control" value="<?php echo $photo->photo_title; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="title">Photo: </label>
                                    <a class="thumbnail" href="#"><img src="<?php echo $photo->photo_path(); ?>" alt="<?php echo $photo->photo_alt; ?>" class="img-responsive"></a>
                                </div>
                                <div class="form-group">
                                    <label for="caption">Photo Caption: </label>
                                    <input type="text" name="caption" id="caption" class="form-control" value="<?php echo $photo->photo_caption; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="alt">Photo Alternative Text: </label>
                                    <input type="text" name="alt" id="alt" class="form-control" value="<?php echo $photo->photo_alt; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="desc">Photo Description: </label>
                                    <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"><?php echo $photo->photo_desc; ?></textarea>
                                </div>
                            </div>
                            
                           <div class="col-md-4" >
                                <div  class="photo-info-box">
                                    <div class="info-box-header">
                                       <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                    </div>
                                    <div class="inside">
                                      <div class="box-inner">
                                         <p class="text">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                           Uploaded on: <?php echo date("Y-m-d H:i:s"); ?>
                                         </p>
                                         <p class="text ">
                                            Photo Id: <span class="data photo_id_box"><?php echo $photo->photo_id; ?></span>
                                         </p>
                                         <p class="text">
                                            Filename: <span class="data"><?php echo $photo->photo_fname; ?></span>
                                         </p>
                                         <p class="text">
                                            File Type: <span class="data"><?php echo $photo->photo_ftype; ?></span>
                                         </p>
                                         <p class="text">
                                           File Size: <span class="data"><?php echo $photo->photo_fsize; ?></span>
                                         </p>
                                      </div>
                                      <div class="info-box-footer clearfix">
                                        <div class="info-box-delete pull-left">
                                            <a href="?delete=<?php echo $photo->photo_id; ?>" class="btn btn-danger btn-lg">Delete</a>   
                                        </div>
                                        <div class="info-box-update pull-right ">
                                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                        </div>   
                                      </div>
                                    </div>          
                                </div>
                            </div>
                        </form>
<?php else: ?>
<?php $photos = User::find_by_id($_SESSION['user_id'], 'user_id')->get_user_photos(); ?>
                        <div class="col-md-12">
                           <h2 class="bg-success"><?php echo $session->message; ?></h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Title</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Size</th>
                                        <th>View Comments</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach($photos as $photo): // SHOW ALL PHOTOS ?>
                                    <tr>
                                        <td><?php echo $photo->photo_id; ?></td>
                                        <td><a href="../photo.php?id=<?php echo $photo->photo_id; ?>"><img src="<?php echo $photo->photo_path(); ?>" alt="<?php echo $photo->photo_title; ?>" class="img-responsive admin-photo-thumbnail"></a></td>
                                        <td><?php echo $photo->photo_title; ?></td>
                                        <td><?php echo $photo->photo_fname; ?></td>
                                        <td><?php echo $photo->photo_ftype; ?></td>
                                        <td><?php echo $photo->photo_fsize; ?></td>
                                        <td><a href="comments.php?photo=<?php echo $photo->photo_id; ?>" class="btn btn-primary">View Comments</a></td>
                                        <td><a href="?edit=<?php echo $photo->photo_id; ?>" class="btn btn-success">Edit</a></td>
                                        <td><a href="?delete=<?php echo $photo->photo_id; ?>" class="btn btn-danger delete-link">Delete</a></td>
                                    </tr>
<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
<?php endif; ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>

<?php if(isset($_GET['edit'])): ?>
<script>
    ClassicEditor
    .create(document.querySelector('#desc'))
    .catch(error => {
        console.error(error);
    });
</script>
<?php endif; ?>