<?php include("includes/header.php"); ?>
<?php $photos = Photo::find_all(); ?>
<?php
$current_page   = (isset($_GET['page']) && !is_empty($_GET['page'])) ? (int)$db->escape($_GET['page']) : 1;
$items_per_page = 3;
$total_items    = Photo::index();
$pagination     = new Pagination($total_items, $items_per_page, $current_page);
$photos         = Photo::find_rows("SELECT * FROM photos LIMIT {$pagination->offset()},{$items_per_page}");
?>
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <div class="row thumbnails">
<?php foreach($photos as $photo): ?>
                   <div class="col-xs-6 col-md-4">
                       <a href="<?php echo "photo.php?id={$photo->photo_id}"; ?>" class="thumbnail">
                           <img class="img-responsive photo" src="<?php echo "admin/{$photo->photo_path()}"; ?>" alt="<?php echo $photo->alt; ?>">
                       </a>
                   </div>
<?php endforeach; ?>
               </div><!-- /.row -->
               <div class="row">
                   <ul class="pagination">
<?php if($pagination->pages() > 1): ?>
    <?php if($pagination->has_next()): ?>
                        <li class="next"><a href="<?php echo "?page={$pagination->next()}"; ?>">Next</a></li>
    <?php endif; ?>
    
    <?php for($i = 1; $i <= $pagination->pages(); $i++): ?>
        <?php if($i === $pagination->current_page): ?>
                        <li class="active"><a href="<?php echo "?page={$i}"; ?>"><?php echo $i; ?></a></li>
        <?php else: ?>
                        <li><a href="<?php echo "?page={$i}"; ?>"><?php echo $i; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    
    <?php if($pagination->has_prev()): ?>
                        <li class="previous"><a href="<?php echo "?page={$pagination->prev()}"; ?>">Previous</a></li>
    <?php endif; ?>
<?php endif; ?>
                   </ul>
               </div>
            </div><!-- /.col -->
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
<?php include("includes/sidebar.php"); ?>
            </div>
        </div><!-- /.row -->
<?php include("includes/footer.php"); ?>
