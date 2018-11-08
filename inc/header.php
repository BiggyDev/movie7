<?php ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="asset/style.css">
        <title>Cineworld</title>
    </head>
    <body>
        <header>
            <h1>Cineworld</h1>
            <div class="wrap">
                <nav class="navbar">
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <?php if(islogged()){ ?>
                        <li><a href="deconnexion.php">Deconnexion</a></li>
                        <li><a href="account.php" class="account">Mon compte</a></li>

                        <?php } else {?>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="connexion.php">Connexion</a></li>
                        <?php } ?>


                    </ul>
                </nav>
            </div>
        </header>
