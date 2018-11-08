<?php include('inc/pdo.php');
include('inc/functions.php');
























?>
<?php include('inc/header.php'); ?>

<div class="wrap">

  <?php
  echo '<pre>';
  print_r($movies);
  echo '</pre>';

  foreach ($movies as $movie) { ?>
    <div class="filmtitle">
      <a href="details.php?id=<?php echo $movie['id']; ?>">
      <?php reloadImage($movie); ?>
    </div>

  <?php }




   ?>

</div>























<?php include('inc/footer.php'); ?>
