<?php include('inc/pdo.php'); ?>
<?php include('inc/functions.php'); ?>



<?php
//initialise la variable contenant les messages d'erreurs à... rien
$error = array();
$success = false;

//Formulaire Soumis
if (!empty($_POST['submitted'])) {

    // Protection faille XSS
    $login      = trim(strip_tags($_POST['login']));
    $password   = trim(strip_tags($_POST['password']));

//Requete sur identité utilisateur (s'il existe)
  $sql   = "SELECT *
            FROM m7_users_website
            WHERE pseudo = :login
            OR email = :login";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':login', $login, PDO::PARAM_STR);
  $query -> execute();
  $user = $query -> fetch();

  // print_r($user);
  if (!empty($user)) {
     if (!password_verify($password, $user['password'])) {
       $error['password'] = 'Mot de passe erroné';
     }
  } else {
    $error['login'] = 'Veuillez vous inscrire';
  }

    if (count($error) == 0) {

      $success = true;
      $_SESSION['m7_users_website'] = array(
        'id'      => $user['id'],
        'pseudo'  => $user['pseudo'],
        'email'   => $user['email'],
        'role'    => $user['role'],
        'ip'      => $_SERVER['REMOTE_ADDR']
      );
      if (isAdmin()) {
        header('Location: indexb.php');
      } else {
        header('Location: index.php');
      }
    }
}

$title = 'CINEWORLD - Connexion'; ?>
<?php include('inc/header.php'); ?>

<div class="wrap">
  <h2>Connectez-vous à votre compte :</h2><br>

  <form class="connexion" action="" method="post">

    <label for="login">Votre Pseudo ou votre Email* :</label><br>
    <input type="text" name="login" value=""><br><br>

    <label for="password">Votre Mot de Passe* :</label><br>
    <input type="password" name="password" value=""><br><br>

    <input type="submit" name="submitted" value="Connexion">

  </form>

  <p><span class="needeed">* = Champs obligatoires</span></p><br>

  <p><a href="passwordforget.php">Mot de passe oublié ?</a></p><br>

  <p><span><em>Pas encore inscrit ? Cliquez <a href="inscription.php">ici </a>!</em></span></p><br>
</div>

<?php include('inc/footer.php');
