<?php include('inc/pdo.php');
include('inc/functions.php');

// Requête à la base de données affichage aléatoire
$sql = "SELECT * FROM movies_full ORDER BY rand() LIMIT 50";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchAll();
// Fin de la requête

// Requête à la base de données filtres
$sql = "SELECT * FROM movies_full WHERE 1=1
AND genres LIKE '%Western%'
AND genres LIKE '%Action%'
AND genres LIKE '%Adventure%'
AND genres LIKE '%Comedy%'
AND genres LIKE '%Crime%'
AND genres LIKE '%Drama%'
AND genres LIKE '%Thriller%'
AND genres LIKE '%Romance%'
AND genres LIKE '%War%'
AND genres LIKE '%Musical%'
AND genres LIKE '%History%'
AND genres LIKE '%Sci-Fi%'
AND genres LIKE '%Animation%'
AND genres LIKE '%Family%'
AND genres LIKE '%Short%'";
$query = $pdo -> prepare($sql);
$query -> execute();
$genres = $query -> fetch();
// Fin de la requête


?>
<?php include('inc/header.php'); ?>
<form class="filtergenres" action="" method="post">
  <?php foreach ($genres as $genre) { ?>
    <input type="checkbox" name="genre" value="<?php echo $movies['genre']; ?>">
  <?php } ?>
  <input type="submit" name="submitted" value="Filtrer">
</form>





<div class="wrap">

  <?php
//       Boucle affichage aléatoire films
  foreach ($movies as $movie) { ?>
    <div class="filmtitle">
      <a href="details.php?id=<?php echo $movie['id']; ?>"><?php reloadImage($movie); ?>
    </div>
  <?php }
//        Fin boucle
  ?>

</div>





















<p><a class="moremovies" href="index.php">Plus de films</a></p>

<?php include('inc/footer.php');
