<?php
require('includes/config.php');

 $val = $_GET['val'];

include($define['header']);
?>
  <div class="view-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <div class="row row-cols-1 row-cols-md-1">
      <?php foreach ($user->getImage($val) as $data) {
        // code...
      ?>
      <div class="col mb-4">
        <div style="
        background-color: #10100e;position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 240px;
        border-radius: 6px 6px 0 0;
        overflow: hidden;">
          <img src="<?php echo UPLOAD.$data['name']; ?>" class="img-fluid" alt="Responsive image"><br />
        </div>
        <div style="background-color: #10100e;border-radius: 0px 0px 6px 6px;padding: 10px;">
          <h6>Share link <span class="badge badge-secondary"><?php echo UPLOAD . $data['name']; ?></span></h6>
          <h6>BBCode <span class="badge badge-secondary"><samp><?php echo '[img]'. UPLOAD . $data['name'] .'[/img]'; ?></samp></span></h6>
        </div>
      </div>
      <?php }?>
    </div>
  </div>
  <div class="inner">
    <p>Created with <i class="fas fa-heart" style="color: red"></i> ! by <kbd>m1lfman</kbd></p>
    <a href="../index.php" class="btn btn-info"><i class="fas fa-arrow-left"></i> Back to Home</a>
  </div>


<?php
include($define['footer']);

?>
