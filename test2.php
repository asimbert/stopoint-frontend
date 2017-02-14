<?php
  $yourPngImage = imagecreatefrompng("shippinglabels/STP1950381107.png");
$im = new Imagick();

ob_start();
imagepng($yourPngImage);
$image_data = ob_get_contents();
ob_end_clean();

// Get image source data
$im->readimageblob($image_data);

$im->setImageFormat('pdf');

header("Content-Type: application/pdf");
echo $im;
?>