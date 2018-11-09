<?php include('inc/pdo.php');
include('inc/functions.php');

$title = 'Mot de passe oublié';
$error = array();


if (!empty($_POST['submitted'])) {
  $email = trim(strip_tags($_POST['passwordforget']));

  if (!empty($email)){
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error['email'] = '<span style="color:red">' . 'Veuillez renseigner un e-mail valide.' . '</span>';
      }
      else {
        $sql = "SELECT email, token FROM m7_users_website WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',$email, PDO::PARAM_STR);
        $query->execute();
        $user = $query -> fetch();

        if (!empty($user)) {
          $body = '<p>Veuillez cliquer sur le lien ci-dessous</p>';
          $body .= '<a href="passwordmodif.php?email='.urlencode($user['email']).'&token='.urlencode($user['token']).'">ici !</a>';

          echo $body;
        }
      }
  } else {
    $error['email'] = '<span style="color:red">' . 'Veuillez renseigner un e-mail.' . '</span>';
  }
}

include('inc/header.php'); ?>
<div class="wrap">
  <form class="passwordforget" action="" method="post">

      <label for="">Votre adresse e-mail :</label>
      <input type="email" name="passwordforget" value="">

      <input type="submit" name="submitted" value="Envoyer">

  </form>


<?php  ?>


</div>
















<?php include('inc/footer.php');
