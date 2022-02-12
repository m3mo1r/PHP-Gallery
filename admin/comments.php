<?php include("includes/header.php"); ?>
<?php if(!$session->is_logged_in()) redirect('login.php'); ?>

<?php if(isset($_GET['delete']) && !empty(trim($_GET['delete']))) { // DELETE COMMENT
    $comment_id = $db->escape($_GET['delete']);
    $comment    = comment::find_by_id($comment_id, 'comment_id');
    if($comment)
        $message = $comment->delete($comment_id, 'comment_id') ? 'Deleted comment.' : 'Cannot delete this comment.';
    else
        $message = 'Comment is not existed.';
    
    $session->message($message);
    redirect('comments.php');
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
                            COMMENTS
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Comments Page
                            </li>
                        </ol>
<?php if(isset($_GET['photo'])) {
    $comments = Comment::find_photo_comments($db->escape($_GET['photo'])); // SHOW PHOTO COMMENTS
    if(!$comments)
        $message = 'No comment for this photo.';
    else {
        $count = count($comments);
        $message = 'This photo has ' . $count . ' comments';
    }
    $session->message($message);
    redirect('comments.php');
} else
    $comments = comment::find_all(); // SHOW ALL COMMENTS
?>
                        <div class="col-md-12">
                           <h2 class="bg-success"><?php echo $session->message; ?></h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        <th>Date</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach($comments as $comment): ?>
                                    <tr>
                                        <td><?php echo $comment->comment_id; ?></td>
                                        <td><?php echo $comment->comment_author; ?></td>
                                        <td><?php echo $comment->comment_body; ?></td>
                                        <td><?php echo $comment->comment_date; ?></td>
                                        <td><a href="?delete=<?php echo $comment->comment_id; ?>" class="btn btn-danger">Delete</a></td>
                                    </tr>
<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<?php include("includes/footer.php"); ?>
