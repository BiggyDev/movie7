<?php include('inc/pdo.php'); ?>
<?php include('inc/functions.php'); ?>



<?php
// declaration $error  dans un array
$error = array();
//form soumis
if (!empty($_POST['submitted'])) {
  //faille xxs
  $login    = trim(strip_tags($_POST['login']));
  $password = trim(strip_tags($_POST['password']));

  //requete pour verifier exactitude du password
  $sql = "SELECT * FROM m7_users_website
      WHERE pseudo = :login OR email = :login";
      $query = $pdo->prepare($sql);
      $query->bindValue(':login',$login);
      $query->execute();
 $user = $query->fetch();

 if(!empty($user)) {
   if(!password_verify($password,$user['password'])) {
     $error['password'] = 'mauvais mot de passe';
   }
 } else {
   $error['login'] = 'veuillez vous inscrire';
 }

 if(count($error) == 0) {
       $_SESSION['user'] = array(
         'id' => $user['id'],
         'pseudo' => $user['pseudo'],
         'email' => $user['email'],
         'role'  => $user['role'],
         'ip'  => $_SERVER['REMOTE_ADDR']
       );
       header('Location: index.php');
 }
}

 ?>
<?php include('inc/header.php'); ?>

     <form class="formConnect" action="" method="post">

       <label for="login">login</label>
       <input type="text" name="login" id = "login" value="">

       <label for="password">password</label>
       <span class="error"><?php if(!empty($error['password'])) {echo $error['password'];}  ?></span>
       <input type="password" name="login" id = "password" value="">

       <input type="submit" name="submitted" value="connexion">
     </form>


<?php include('inc/footer.php');
