<?php include('inc/pdo.php');
include('inc/functions.php');

// Requête à la base de données
$sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 50,50";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchAll();
// Fin de la requête






















?>
<?php include('inc/header.php'); ?>

<div class="wrap">

  <?php
  // echo '<pre>';
  // print_r($movies);
  // echo '</pre>';

  foreach ($movies as $movie) { ?>
    <div class="filmtitle">
      <a href="details.php?id=<?php echo $movie['id']; ?>">
      <?php reloadImage($movie); ?>
    </div>



  <?php }




   ?>

</div>























<?php include('inc/footer.php');
