<?php include('inc/pdo.php'); ?>
<?php include('inc/functions.php'); ?>
<?php
$error = array();

if(!empty($_GET['email']) && !empty($_GET['token'])) {
  $email = urldecode($_GET['email']);
  $token = urldecode($_GET['token']);
  $sql = "SELECT id FROM m7_users_website WHERE email = :email AND token = :token";
  $query = $pdo -> prepare($sql);
  $query -> bindValue(':email', $email, PDO::PARAM_STR);
  $query -> bindValue(':token', $token, PDO::PARAM_STR);
  $query -> execute();
  $user = $query -> fetch();

  // print_r($user);
  if (!empty($user)) {
    //si le formulaire est soumis
    if (!empty($_POST['submitted']) ) {
        // Protection faille XSS
        $password    = trim(strip_tags($_POST['password']));
        $password2   = trim(strip_tags($_POST['password2']));

        // verification password
        if (!empty($password)){
            if(strlen($password) < 6 ) {
                $error['password'] = 'Le mot de passe est trop court. (Minimum 6 caractères)';
            } elseif(strlen($password) > 255) {
                $error['password'] = 'Le mot de passe est trop long. (Maximum 255 caractères)';
            }
        } else {$error['password'] = 'Veuillez renseigner un mot de passe';}

        // verification password2
        if (!empty($password2)){
            if($password2 !== $password) {
              $error['password2'] = 'Les mots de passes renseignés ne correspondent pas';
            }
        } else {$error['password2'] = 'Veuillez réécrire le mot de passe rensigné ci-dessus';
            }

        if (count($error) == 0) {
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $token = generateRandomString(90);
          $sql = "UPDATE m7_users_website SET password = :password, token = :token WHERE id = :id";
          $query = $pdo -> prepare($sql);
          $query -> bindValue(':password', $hash, PDO::PARAM_STR);
          $query -> bindValue(':token', $token, PDO::PARAM_STR);
          $query -> bindValue(':id', $user['id'], PDO::PARAM_INT);
          $query -> execute();
          // header('Location: connexion.php');
          // die;
        }
      }
} else {
  die('404 1');
}
} else {
  die('404 2');
}

$title = 'Changement de mot de passe'?>
<?php include('inc/header.php'); ?>
<div class="wrap">

  <form class="passwordmodif" action="" method="post">

      <label for="">Votre nouveau mot de passe : </label><br>
      <input type="password" name="password" value=""><br><br>

      <label for="">Confirmez votre nouveau mot de passe : </label><br>
      <input type="password" name="password2" value=""><br><br>

      <input type="submit" name="submitted" value="Modifier">

  </form>

</div>





















<?php include('inc/footer.php'); ?>
