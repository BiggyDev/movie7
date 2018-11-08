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
    if(!empty($_SESSION['membre']) &&
        !empty($_SESSION['membre']['id']) &&
        !empty($_SESSION['membre']['pseudo']) &&
        !empty($_SESSION['membre']['mail']) &&
        !empty($_SESSION['membre']['role']) &&
        !empty($_SESSION['membre']['ip'])) {
        if($_SESSION['membre']['ip'] == $_SERVER['REMOTE_ADDR']) {
            return true;
        }
    }
    return false;
}

function isAdmin () {
    if(isLogged()){
        if($_SESSION['membre']['role'] == 'admin'){
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
