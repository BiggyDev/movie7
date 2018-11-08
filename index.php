<?php include('inc/pdo.php');
include('inc/functions.php');

if(!empty($_POST['submitted'])) {
  $variable = $_POST['genre'];
  // echo '<pre>';
  // print_r($variable);
  // echo '</pre>';

  // Requête à la base de données filtres
   $sql = "SELECT * FROM movies_full WHERE 1=1 ";
   foreach ($variable as $key => $v) {
   $sql .= "AND genres LIKE '%" . $v . "%'";
   }
   $query = $pdo -> prepare($sql);
   $query -> execute();
   $genres = $query -> fetch();
  // Fin de la requête

  $sql = "SELECT * FROM movies_full WHERE genres = :genres";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':genres', $genres, PDO::PARAM_STR);
  $query -> execute();
  $filter = $query -> fetch();
  echo '<pre>';
  print_r($filter);
  echo '</pre>';


} else {
  // Requête à la base de données affichage aléatoire
  $sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 50";
  $query = $pdo -> prepare($sql);
  $query -> execute();
  $movies = $query -> fetchAll();
  // Fin de la requête
}

//Requête BDD
$sql = "SELECT genres FROM movies_full ORDER BY genres";
$query = $pdo -> prepare($sql);
$query -> execute();
$genres = $query -> fetchAll();

$tableau = array();
foreach ($genres as $genre) {
  $g = $genre['genres'];
  $explodes = explode(',',$g);
  foreach ($explodes as $explode) {
    $ex = trim($explode);
    if(!in_array($ex,$tableau)) {
      if(!empty($ex)) {
        $tableau[] = $ex;
      }
    }
  }
}


?>
<?php include('inc/header.php'); ?>
<form class="filtergenres" action="" method="post">
  <?php foreach ($tableau as $tab) { ?>
    <label for=""><input type="checkbox" name="genre[]" value="<?= $tab ?>"><?php echo $tab; ?></label>
  <?php } ?>
  <input type="submit" name="submitted" value="Filtrer">
</form>





<div class="wrap">
    <section class="movies">

  <?php
//       Boucle affichage aléatoire films
  foreach ($movies as $movie) { ?>
    <div class="filmtitle">
      <a href="details.php?id=<?php echo $movie['id']; ?>">
      <?php reloadImage($movie);?>
    </div>
  <?php }
//        Fin boucle
  ?>
    </section>
</div>
<div class="clear"></div>





















<p><a class="moremovies" href="index.php">Plus de films</a></p>

<?php include('inc/footer.php');
