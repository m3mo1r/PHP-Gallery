<?php include("includes/header.php"); ?>
<?php if(!$session->is_logged_in()) redirect('login.php'); ?>
       
<?php
if(isset($_FILES['file'])) {
    $photo                = new Photo();
    $photo->photo_user_id = $db->escape($_SESSION['user_id']);
    $photo->photo_title   = $db->escape($_POST['title']);
    $photo->photo_caption = $db->escape($_POST['caption']);
    $photo->photo_alt     = $db->escape($_POST['alt']);
    $photo->photo_desc    = $db->escape($_POST['desc']);
    
    $photo->set_file($_FILES['file']);
    
    if($photo->save())
        $message = 'Photo uploaded successfully!';
    else
        $message = join('<br>', $photo->errros);
    
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
                            UPLOAD
                            <small>Subheading</small>
                        </h1>
                        
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                        
                        <div class="col-lg-6">
                           <h2 class="bg-danger"><?php echo $session->message; ?></h2>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Photo Title: </label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="caption">Photo Caption: </label>
                                    <input type="text" name="caption" id="caption" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="alt">Photo Alternative Text: </label>
                                    <input type="text" name="alt" id="alt" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="desc">Photo Description: </label>
                                    <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="file">Photo File: </label>
                                    <input type="file" name="file" id="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="upload" value="Upload File" class="form-control btn btn-primary">
                                </div>
                            </form>                            
                        </div>
                        
                        <div class="col-lg-6">
                            <h2 class="bg-danger"><?php echo $session->message; ?></h2>
                            <label for="">DROPZONE: UPLOAD MULTIPLE IMAGES 👌</label>
                            <form action="upload.php" class="dropzone" method="post"></form>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>


<script>
    ClassicEditor
    .create(document.querySelector('#desc'))
    .catch(error => {
        console.error(error);
    });
</script>
