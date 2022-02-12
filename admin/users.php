<?php include("includes/header.php"); ?>
<?php if(!$session->is_logged_in()) redirect('login.php'); ?>
<?php require_once("includes/photo_modal.php"); ?>

<?php if(isset($_GET['delete']) && !empty(trim($_GET['delete']))) {
    $user_id = $db->escape($_GET['delete']);
    $user    = User::find_by_id($user_id, 'user_id');
    if($user)
        $message = $user->delete_user() ? 'Deleted user.' : 'Cannot delete this user.';
    else
        $message = 'User is not existed.';
    
    $session->message($message);
    redirect('users.php');
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
                            USERS
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Users Page
                            </li>
                        </ol>
<?php if((isset($_GET['edit']) && !empty(trim($_GET['edit']))) || isset($_GET['add'])): // EDIT AND ADD USER ?>
<?php if(isset($_GET['edit'])) {
    $user_id = $db->escape($_GET['edit']);
    $user    = User::find_by_id($user_id, 'user_id');
} else
    $user    = new User();
?>

<?php if((isset($_POST['update']) || isset($_POST['add']))  && isset($user)) {
    if(is_empty($_POST['username']) && is_empty($_POST['password']))
        redirect('users.php');
    else {
        $user->user_name      = $db->escape($_POST['username']);
        $user->user_password  = $db->escape($_POST['password']);
        $user->user_firstname = $db->escape($_POST['firstname']);
        $user->user_lastname  = $db->escape($_POST['lastname']);

        if(isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
            $user->set_file($_FILES['photo']);
            $user->save_photo();
        }
        if($user->save())
            $message = 'Added or updated user successfully!';
        else
            $message = join('<br>', $user->errros);

        $session->message($message);
        redirect('users.php');

    }
}
?>
<?php if(isset($_GET['edit'])): ?>
                        <form action="users.php?edit=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
<?php else: ?>
                        <form action="users.php?add=true" method="post" enctype="multipart/form-data">
<?php endif; ?>
                            <h2><?php echo $session->message; ?></h2>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="username">Username: </label>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
<?php if(isset($_GET['add'])): ?>
                                <div class="form-group">
                                    <label for="photo">User Photo: </label>
                                    <input type="file" name="photo" id="photo" class="form-control">
                                </div>
<?php endif; ?>
                                <div class="form-group">
                                    <label for="password">Password: </label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="firstname">Firstname: </label>
                                    <input type="text" name="firstname" id="firstname" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Lastname: </label>
                                    <input type="text" name="lastname" id="lastname" class="form-control">
                                </div>
<?php if(isset($_GET['add'])): ?>
                                <div class="form-group">
                                    <input type="submit" name="add" class="btn btn-primary pull-right" value="Add User">
                                </div>
<?php endif; ?>
                            </div>
<?php if(isset($_GET['edit'])): // SHOW DETAIL EDITED USER ?>
                           <div class="col-md-4" >
                                <div  class="user-info-box">
                                    <div class="info-box-header">
                                       <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                    </div>
                                    <div class="inside">
                                      <div class="box-inner clearfix">
                                         <p class="text">
                                           <span class="glyphicon glyphicon-calendar"></span>
                                             <span class="pull-right">Edited on: <?php echo date("Y-m-d H:i:s"); ?></span>
                                         </p>
                                         <p class="text ">
                                            User Id: <span class="data user_id_box pull-right"><?php echo $user->user_id; ?></span>
                                         </p>
                                         <p class="text">
                                            Username: <span class="data pull-right"><?php echo $user->user_name; ?></span>
                                         </p>
                                         <p class="text">
                                            Password: <span class="data pull-right"><?php echo str_repeat('*', strlen($user->user_password)); ?></span>
                                         </p>
                                         <p class="text">
                                           Firstname: <span class="data pull-right"><?php echo $user->user_firstname; ?></span>
                                         </p>
                                          <p class="text">
                                           Lastname: <span class="data pull-right"><?php echo $user->user_lastname; ?></span>
                                         </p>
                                         <p class="text">
                                           Photo: <span class="data pull-right"><a class="thumbnail user_image_box" href="#" data-toggle="modal" data-target="#photo-library-modal"><img src="<?php echo $user->user_photo_path(); ?>" alt="<?php echo $user->user_name; ?>" class="img-responsive"></a></span>
                                         </p>
                                      </div>
                                      <div class="info-box-footer clearfix">
                                        <div class="info-box-delete pull-left">
                                            <a id="user_id" href="?delete=<?php echo $user->user_id; ?>" class="btn btn-danger btn-lg">Delete</a>   
                                        </div>
                                        <div class="info-box-update pull-right ">
                                            <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                        </div>   
                                      </div><!-- ./box-footer-->
                                    </div><!-- ./box-inside-->          
                                </div><!-- ./box-->
                            </div><!-- ./col-->
<?php endif; ?>
                        </form>
<?php else: ?>
<?php $users = User::find_all(); // SHOW ALL USERS ?>
                        <a href="?add=true" class="btn btn-primary pull-right">Add</a>
                        <div class="col-md-12">
                           <h2 class="bg-success"><?php echo $session->message; ?></h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>Username</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach($users as $user): ?>
                                    <tr>
                                        <td><?php echo $user->user_id; ?></td>
                                        <td><img src="<?php echo $user->user_photo_path(); ?>" alt="<?php echo $user->user_name; ?>" class="img-responsive user-photo-thumbnail"></td>
                                        <td><?php echo $user->user_name; ?></td>
                                        <td><?php echo $user->user_firstname; ?></td>
                                        <td><?php echo $user->user_lastname; ?></td>
                                        <td><a href="?edit=<?php echo $user->user_id; ?>" class="btn btn-success">Edit</a></td>
                                        <td><a href="?delete=<?php echo $user->user_id; ?>" class="btn btn-danger delete-link">Delete</a></td>
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
