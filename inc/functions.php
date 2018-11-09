<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function isLogged () {
    if(!empty($_SESSION['m7_users_website']) &&
        !empty($_SESSION['m7_users_website']['id']) &&
        !empty($_SESSION['m7_users_website']['pseudo']) &&
        !empty($_SESSION['m7_users_website']['email']) &&
        !empty($_SESSION['m7_users_website']['role']) &&
        !empty($_SESSION['m7_users_website']['ip'])) {
        if($_SESSION['m7_users_website']['ip'] == $_SERVER['REMOTE_ADDR']) {
            return true;
        }
    } else {
      return false;
    }
}

function isAdmin () {
    if(isLogged()){
        if($_SESSION['m7_users_website']['role'] == 'admin'){
            return true;
        }
    }
    return false;
}

function reloadImage($movie)
{ ?>
<img src="posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
<?php
}



// function affichageCategories()
// {
//   foreach ($genres as $genre) {
//     $g = $genre['genres'];
//     $explodes = explode(',',$g);
//     foreach ($explodes as $explode) {
//       $ex = trim($explode);
//       if(!in_array($ex,$tableau)) {
//         if(!empty($ex)) {
//           $tableau[] = $ex;
//         }
//       }
//     }
//   }
// }
