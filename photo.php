<?php include("includes/header.php"); ?>
<?php if(!empty(trim($_GET['id']))) {
    $photo      = Photo::find_by_id($db->escape($_GET['id']), 'photo_id');
    $photo_id   = $photo->photo_id;
    
    if(isset($_POST['comment']) && $photo) {
        $author      = !empty($_POST['author']) ? $db->escape($_POST['author']) : 'anonymous';
        $body        = !empty($_POST['body'])   ? $db->escape($_POST['body'])   : 'Good or not ?';
        
        $new_comment = Comment::create_comment($photo_id, $author, $body);
        $message     = $new_comment->save() ? 'Thank for your comment.' : 'There was some problems.';
    }
} else
    redirect('index.php');
?>

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->photo_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="<?php echo "admin/{$photo->photo_path()}"; ?>" alt="<?php echo $photo->alt; ?>">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->photo_caption; ?></p>
                <p><?php echo $photo->photo_desc; ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                       <div class="form-group">
                           <label for="author">Your name: </label>
                           <input type="text" name="author" id="author" class="form-control">
                       </div>
                        <div class="form-group">
                            <label for="body">Your comment: </label>
                            <textarea name="body" id="body" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" name="comment" class="btn btn-primary">Submit</button>
                    </form>
                    <h4><?php if(isset($message)) echo $message; ?></h4>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
<?php $comments = Comment::find_photo_comments($photo_id); ?>
<?php foreach($comments as $comment):?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/62x62" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->comment_author; ?>
                            <small><?php echo $comment->comment_date; ?></small>
                        </h4>
                        <?php echo $comment->comment_body; ?>
                    </div>
                </div>
<?php endforeach; ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
<?php include("includes/sidebar.php"); ?>
            </div><!-- /.col -->
        </div><!-- /.row -->
<?php include("includes/footer.php"); ?>