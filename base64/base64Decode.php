<?php

$streamFile = fopen("stream.txt", "r") or die("Unable to open file!");
$stream= fread($streamFile,filesize("stream.txt"));
fclose($streamFile);


$bin = base64_decode($stream);

// Load GD resource from binary data
$im = imageCreateFromString($bin);


if (!$im) {
  die('Base64 value is not a valid image');
}

// Specify the location where you want to save the image
$img_file = 'flowerFromBase64.png';

// Save the GD resource as PNG in the best possible quality (no compression)
// This will strip any metadata or invalid contents (including, the PHP backdoor)
// To block any possible exploits, consider increasing the compression level
imagepng($im, $img_file, 0);
