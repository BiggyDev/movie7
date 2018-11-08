<?php

function reloadImage($movie)
{ ?>
<img src="posters/<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
<?php
}
