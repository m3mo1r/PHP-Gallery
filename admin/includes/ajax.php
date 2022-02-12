<?php require_once("init.php"); ?>

<?php if(isset($_POST['img_name'], $_POST['user_id'])) {
    $user_photo   = $db->escape($_POST['img_name']);
    $user_id      = $db->escape($_POST['user_id']);
    
    $user         = User::find_by_id($user_id, 'user_id');
    $user->ajax_save($user_id, $user_photo);
    
    echo $user->user_photo_path();
} ?>

<?php if(isset($_POST['photo_id'])): ?>
<?php
$photo_id = $db->escape($_POST['photo_id']);
$photo = Photo::find_by_id($photo_id, 'photo_id');
?>
<div class="photo-info-box">
    <div class="info-box-header">
       <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
    </div>
    <div class="inside">
      <div class="box-inner">
        <a href="#" class="thumbnail">
            <img class="img-responsive" src="<?php echo $photo->photo_path(); ?>" alt="<?php echo $photo->photo_alt; ?>">
        </a>
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
      </div><!-- ./box-inner-->
    </div><!-- ./inside-->
</div><!-- ./box-->
<?php endif; ?>