<?php
$dest = imagecreatefrompng('https://www.stopoint.com/shippinglabels/STP1112885687.png');
$src = imagecreatefromjpeg('https://www.stopoint.com/image.php?filetype=JPEG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&text=STP1112885687&thickness=60&code=BCGcode128');

imagealphablending($dest, true);
imagesavealpha($dest, true);

imagecopymerge($dest, $src, 10, 9, 0, 0, 181, 180, 100); //have to play with these numbers for it to work for you, etc.

header('Content-Type: image/png');
imagepng($dest);

//imagedestroy($dest);
//imagedestroy($src);
?>