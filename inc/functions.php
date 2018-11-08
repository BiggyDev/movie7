<?php

function reloadImage($movie)
{ ?>
<img src="posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
<?php
}



function affichageCategories()
{
  foreach ($genres as $genre) {
    $g = $genre['genres'];
    $explodes = explode(',',$g);
    foreach ($explodes as $explode) {
      $ex = trim($explode);
      if(!in_array($ex,$tableau)) {
        if(!empty($ex)) {
          $tableau[] = $ex;
        }
      }
    }
  }
}
