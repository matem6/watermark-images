<?php
function createImages($imagename)
{
    // White background and blue text
    $im = imagecreatefromjpeg($imagename);
    $im2 = imagecreatefromjpeg($imagename);
    $color = imagecolorat($im, 0, 0);
    //0 = nero, 16777215 = bianco?

    if($color < 8388607)
    {
        $stamp = imagecreatefrompng('voodoobianco.png');
    }
    else
    {
        $stamp = imagecreatefrompng('voodoonero.png');
    }
    $stamp2 = imagecreatefrompng('pd.png');

    // Set the margins for the stamp and get the height/width of the stamp image
    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);
    $sx2 = imagesx($stamp2);
    $sy2 = imagesy($stamp2);

    // Copy the stamp image onto our photo using the margin offsets and the photo 
    // width to calculate positioning of the stamp.
    imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
    imagecopy($im2, $stamp2, imagesx($im2) - $sx2 - $marge_right, imagesy($im2) - $sy2 - $marge_bottom, 0, 0, imagesx($stamp2), imagesy($stamp2));

    // Output and free memory
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $name = generate_string($permitted_chars, 20);
    $name1 = $name."-1.png";
    $name2 = $name."-2.png";
    imagepng($im, "/var/www/dev/images/".$name1);
    imagepng($im2, "/var/www/dev/images/".$name2);
    imagedestroy($im);
    imagedestroy($im2);

    return array("voodoo_name" => $name1, "prodi_name" => $name2);
}

function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}
?>