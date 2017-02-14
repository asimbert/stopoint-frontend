<?php

RotateJpg('shippinglabels/STP908394717.png',90,'shippinglabels/STP908394717.png');


function RotateJpg($filename = '',$angle = 0,$savename = false)

    {

        // Your original file

		header('Content-type: image/png');

        $original   =   @imagecreatefrompng($filename);

        

		//print_r($original);

		$srcsize = @getimagesize($filename);

		$dest_x = 2000; 

		$dest_y = (2000 / $srcsize[0]) * $srcsize[1]; 

		//echo $dest_x." ".$dest_y;

		$dst_img = @imagecreatetruecolor($dest_x, $dest_y);

		@imagecopyresampled($dst_img, $original, 0, 0, 0, 0,$dest_x, $dest_y, $srcsize[0], $srcsize[1]); 

		@imagedestroy($original);

		// Rotate

        $rotated    =   @imagerotate($dst_img, $angle, 0);

		//print_r($rotated);

		@imagedestroy($dst_img);

		

        // If you have no destination, save to browser

        if($savename == false) {

                header('Content-Type: image/png');

                @imagepng($rotated);

            }

        else

            // Save to a directory with a new filename

			

        @imagepng($rotated,$savename);

			

			//print_r( imagepng($rotated,$savename));

        // Standard destroy command

        imagedestroy($rotated);

    }
?>