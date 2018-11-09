<?php include('inc/pdo.php');?>
<?php include('inc/functions.php');?>

<?php

//déclaration d'une variable note
$moviesvote = true;

//Si parametre d url slug existe ? (si le user clic sur un film)
if(!empty($_GET['slug'])){
//SI oui

  // requete : aller chercher le film grace à son slug
  // avant ca : déclaration dune variable slug pour la requete
  $slug = $_GET['slug'];
  $sql = "SELECT FROM movies_full WHERE slug=:slug";
  //preparation de la Requete
  $stmt = $PDO->prepare($sql);
  //protection des injections sql
  $stmt = bienValue(':slug',$slug, PDO::PARAM_STR);
  //execution de la requete
  $stmt-> execute();
  // récupération du resultat avec un fetch dans une variable
  $movie = $stmt-> fetch();
  // Av de faire requete pour afficher film Poser 2 conditions d'abord si movie existe-si oui- si user est connecté
    if(!empty($movie)) {
      if(is_logged()) {
        //les 2 condi remplies requete pour recuperer detail du films
        $idSession = $_SESSION['user']['id'];
        $sql = "SELECT * FROM m7_pivot_users_movies
              WHERE id_users = :iduser
              AND id_movies = :idmovie";
        // preparation de la req
        $stmt = $pdo->prepare($sql);
        //protection injection
        $stmt->bindValue(':iduser',$idSession);
        $stmt->bindValue(':idmovie',$idSession['id']);
        //execution
        $stmt->execute();
        //recupere la note (le film a t il deja ete noté ?)
        $note = $query->fetch();
        //si oui
          if(!empty($note)) {$moviesnote = false;}

        // Si form Soumis
          if(!empty($_POST['sumitted'])) {
          // faille xss
            $idmovierecup = trim(strip_tags($_POST['movie']));
          // condition si idmoviesrecup coorespond id movie
          if($idmovierecup == $movie['id']) {
            //requete pour injecter film dans bbd page film a voir
            $sql = "INSERT INTO m7m7_pivot_users_movies ( id_users, id_movies,note,	created_at)
                   VALUES ( :idusers, :idmovies,null, NOW())";
            // Preparation
            $stmt = $pdo->prepare($sql);
            // Protection injections SQL
            $stmt->bindValue(':idusers',$idSession);
            $stmt->bindValue(':idmovies',$idmovierecup);
            //execute
            $stmt->execute();
            // $moviesvote = false;

            // redirection vers la page des films àà voir +++!!!
            header("Location: filmavoir.php");
          }
        } else {
        die ('404');
      }
      }
    }
//Si non
}else {
  die('404');
}
?>

  <?php  if(isLogged() && $moviesnote) { ?>
          <form class="" action="" method="post">
              <input type="hidden" name="movie" value=" <?php echo $movie['id']; ?> ">
              <input type="submit" name="submitted" value="film à voir">
            </form>
          <?php } ?>
