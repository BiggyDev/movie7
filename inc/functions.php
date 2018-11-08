<?php

function reloadImage($movie)
{ ?>
<img src="<?php echo $movie['id']; ?>.jpg" alt="<?php echo $movie['title']; ?>">
<?php
}
