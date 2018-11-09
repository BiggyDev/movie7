<?php include('inc/pdo.php');?>
<?php include('inc/fonctions.php');?>

<?php

//declaration variable note
$moviesvote = true;

//Si parametre d url slug existe ?
if(!empty($_GET['slug']))
//SI oui
{
  // requete : aller chercher tire du film et son slug
  // avant ca : declaration d une variable slug pour la requete
  $slug = $_GET['slug'];
  $sql = "SELECT FROM movies_full WHERE "











}
//Si non
else {
  die('404');
}


















 ?>
