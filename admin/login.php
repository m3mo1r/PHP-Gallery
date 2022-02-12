<?php require_once("includes/header.php"); ?>
<?php if($session->is_logged_in()) redirect('index.php'); ?>

<?php
if(isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $found_user = User::verify_user($username, $password);
    if($found_user) {
        $session->login($found_user);
        redirect('index.php');
    } else
        $session->message("Your username or password is incorrect.");
} else
    $username = $password = '';

?>


<div class="col-md-4 col-md-offset-3">
    <h4 class="bg-danger"><?php echo $session->message; ?></h4>	
    <form id="login-id" action="" method="post">	
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="login" value="Login" class="btn btn-primary">
        </div>
    </form>
</div>