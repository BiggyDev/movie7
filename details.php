<?php include('inc/pdo.php');
include('inc/functions.php');

// Requête à la base de données
$sql = "SELECT * FROM movies_full WHERE slug = :slug";
$query = $pdo -> prepare($sql);
$query -> bindValue(':slug', $_GET['slug'], PDO::PARAM_STR);
$query -> execute();
$movie = $query -> fetch();

// Fin de la requête
 $title = 'CINEWORLD - ' . $movie['title'];

 ?>


<?php include('inc/header.php'); ?>
    <div class="clear"></div>
    <div class="wrap">
      <div class="clear"></div>
      <section class="affiche">
<?php reloadImage($movie); ?>
      </section>
        <section class="description">
        <ul>
          <li>Titre : <?php echo $movie['title'] ?></li>
          <li>Année de sortie : <?php echo $movie['year'] ?></li>
          <li>Genre : <?php echo $movie['genres'] ?></li>
          <li>Synopsis : <?php echo $movie['plot'] ?></li>
          <li>Réalisateur(s) : <?php echo $movie['directors'] ?></li>
          <li>Casting : <?php echo $movie['cast'] ?></li>
          <li>Durée : <?php echo $movie['runtime'] ?>min</li>
          <li>Note : <?php echo $movie['rating'] ?></li>
          <li>Popularité : <?php echo $movie['popularity'] ?>/100</li>
        </ul>
        </section>
        <div class="clear"></div>
        <?php if(islogged()) { ?>
        <form action="" class="ratings" >
            <label for="rating">Votre note</label>
            <span><input type="text" name="rating" id="rating">/100</span>
            <input type="submit" name="submitted" value="Voter">
        </form>
        <?php } ?>
    </div>
    <div class="clear"></div>









































<?php include('inc/footer.php');
