<?php
function normalize($name) {

  $normalized = htmlentities( $name, ENT_NOQUOTES, 'utf-8' );
  $normalized = preg_replace( '#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $normalized );
  $normalized = preg_replace( '#&([A-za-z]{2})(?:lig);#', '\1', $normalized );
  $normalized = preg_replace( '#&[^;]+;#', '', $normalized );

  $normalized = trim($normalized);
  $normalized = preg_replace ("#[////]#", "", $normalized);
  $normalized = preg_replace ("/\s+/", " ", $normalized);
  $normalized = preg_replace ("/ /", "-", $normalized);
  $normalized = preg_replace ("/\'/", "-", $normalized);
  $normalized = strtolower($normalized);

  return $normalized;
}

function base64_url_encode($input, $key) {
  return strtr(base64_encode($input.$key), '/+=', '-_|');
}

function base64_url_decode($input, $key) {
  return str_replace($key,"" , base64_decode(strtr($input, '-_|', '/+=')));
}

function generateOrderNumber() {
  $date = new DateTime();

  return $date->format('U') . '-' . generateRandomString(3);
}

function generateRandomString($length = 3) {
  $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

?>
