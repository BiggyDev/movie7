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
   $sql .= "OR genres LIKE '%" . $v . "%'";
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


$title = 'CINEWORLD - Acceuil'; ?>
<?php include('inc/header.php'); ?>
  <div class="container">
    <div class="filtermovies">
      <h3 class="filtermoviestitle">Filtres</h3>
      <form class="filtergenres" action="" method="post">
        <?php foreach ($tableau as $tab) { ?>
        <label class="checkboxfilter" for=""><input class="checkboxfilterchoice "  type="checkbox" name="genre[]" value="<?= $tab ?>"><?php echo $tab; ?></label><br>
        <?php } ?>
        <input class="filtervalidation" type="submit" name="submitted" value="Filtrer">
      </form>
    </div>
  </div>


<div class="wrap">
  <section class="movies">
  <?php
//Boucle affichage aléatoire films
  foreach ($movies as $movie) { ?>
    <div class="filmtitle">
      <a href="details.php?slug=<?php echo $movie['slug']; ?>">
      <?php reloadImage($movie); ?>
    </div>
<<<<<<< HEAD

      <?php  }  ?>
<div class="clear"></div>
=======
      <?php  }  ?>
>>>>>>> f8daf5aeed598fd8693c115f04928846251b6a44
  </section>
  <div class="clear"></div>
</div>

<<<<<<< HEAD

=======
>>>>>>> f8daf5aeed598fd8693c115f04928846251b6a44

<p><a class="moremovies" href="index.php">Plus de films</a></p>

<?php include('inc/footer.php');
