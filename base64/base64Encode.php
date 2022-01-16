<?php 

/*
how to encode a binary file (image or other binary file) to base64
 */

$file="flower.png";
$f = fopen($file, "rb");
$readFile=fread($f,filesize($file));
$sectors=unpack('H*',$readFile);
  

function hex_to_base64($sectors){
$return = '';
foreach(str_split($sectors, 2) as $pair){
$return .= chr(hexdec($pair));

  }
   
    return base64_encode($return);
}

 echo hex_to_base64(implode($sectors));

?>