<?php
require_once("../config.php");
function ocisti($retazec) {
  $retazec = htmlspecialchars( strip_tags($retazec) );
  return $retazec;
}

if( isset($_POST['product_action']) && $_POST['product_action'] == 'add') {
  $chyba = 0;
  $zapis = $db->query("INSERT INTO produkty (nazov,popis,cena) VALUES( '".ocisti($_POST['product_name'])."' , '".ocisti($_POST['product_desc'])."' , '".str_replace(',', '.', $_POST['product_price'])."' )");
  if($zapis) {
    $archiv = $db->query("INSERT INTO ceny (produkt_id,cena) VALUES( '".$zapis->insert_id."' , '".str_replace(',', '.', $_POST['product_price'])."' )");
    if(!$archiv) {
      $chyba++;
    }
  } else {
    $chyba++;
  }
  echo "Pocet chyb: " . $chyba;
}
 ?>
