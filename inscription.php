<?php include('inc/functions.php');
      include('inc/pdo.php');

$error = array();

if(!empty($_POST['submitted'])){
    $pseudo = trim(strip_tags($_POST['pseudo']));
    $email = trim(strip_tags($_POST['email']));
    $password = trim(strip_tags($_POST['password']));
    $password2 = trim(strip_tags($_POST['password2']));

    //Verification pseudo
    if(!empty($pseudo)){
        if(strlen($pseudo) < 3 ) {
            $error['pseudo'] = 'Votre pseudo est trop court. (minimum 3 caractères)';
        } elseif(strlen($pseudo) > 100) {
            $error['pseudo'] = 'Votre pseudo est trop long. (maximum 100 caractères)';
        } else {
            $sql = "SELECT pseudo FROM m7_users_website WHERE pseudo = :pseudo";
            $query = $pdo->prepare($sql);
            $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
            $query->execute();
            $userPseudo=$query->fetch();
              if(!empty($userPseudo)) {
              $error['pseudo'] = 'Pseudo deja utilise';
              }
            }
      } else {
      $error['pseudo'] = 'Veuillez entrer un pseudo';
      }


    //Verification email
    if (!empty($email)){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email']='Veuillez renseigner une adresse valide';
        } else {
            $sql = "SELECT email FROM m7_users_website WHERE email = :email";
            $query = $pdo->prepare($sql);
            $query->bindValue(':email',$email,PDO::PARAM_STR);
            $query->execute();
            $userMail=$query->fetch();
              if(!empty($userMail)) {
              $error['email'] = 'email deja utilise';
              }
        }
    } else {
      $error['email'] = 'Veuillez entrer un email';
    }

    // Verification mdp
    if (!empty($password) && !empty($password2)){
        if($password != $password2) {
            $error['password'] = 'Vos mots de passe ne correspondent pas';
        }
        if(strlen($password) < 6 ) {
            $error['password'] = 'Votre mot de passe est trop court. (minimum 6 caractères)';
        } elseif(strlen($password) > 255) {
            $error['password'] = 'Le mot de passe est trop long. (Maximum 255 caractères)';
        }
    } else {
        $error['password'] = 'Veuillez entrer un mot de passe';
    }

    if(count($error) == 0) {
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $token = generateRandomString(90);

        $sql = "INSERT INTO m7_users_website (pseudo, email, token, role, password, created_at)
                VALUES (:pseudo, :email, '$token', 'user', :password, NOW())";
        $query= $pdo->prepare($sql);
        $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
        $query->bindValue(':email',$email, PDO::PARAM_STR);
        $query->bindValue(':password',$hash, PDO::PARAM_STR);
        $query->execute();
        header("Location: index.php");
    }
}
$title = 'CINEWORLD - Inscription';
include('inc/header.php');?>
    <div class="wrap">
        <section class="inscription">
            <form class="formInscription" action="" method="post">
                <label for="pseudo">Pseudo: <span class="error">*<?php if (!empty($error['pseudo'])) { echo $error['pseudo'];}?></span></label>
                <input type="text" name="pseudo" value="<?php if(!empty($_POST['pseudo'])) { echo $_POST['pseudo'];}?>" id="pseudo">
                <br>
                <label for="mail">Email: <span class="error">*<?php if (!empty($error['email'])) { echo $error['email'];} ?></span></label>
                <input type="email" name="email" value="<?php if(!empty($_POST['email'])) { echo $_POST['email'];}?>" id="email">
                <br>
                <label for="password">Mot de passe: <span class="error">*<?php if (!empty($error['password'])) { echo $error['password'];} ?></span></label>
                <input type="password" name="password" id="password">
                <br>
                <label for="password2">Confirmer votre mot de passe: </label>
                <input type="password" name="password2" id="password2">
                <br>
                <input type="submit" name="submitted" value="Envoyer">
            </form>
        </section>
    </div>
<?php include('inc/footer.php');
