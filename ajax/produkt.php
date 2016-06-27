<?php
require_once("../config.php");
header('Content-Type: application/json');

function ocisti($retazec) {
  $retazec = htmlspecialchars( strip_tags($retazec) );
  return $retazec;
}

if( isset($_POST['product_action']) && $_POST['product_action'] == 'add') {
  $chyba = 0;
  $zapis = $db->query("INSERT INTO produkty (nazov,popis,cena) VALUES( '".ocisti($_POST['product_name'])."' , '".ocisti($_POST['product_desc'])."' , '".str_replace(',', '.', $_POST['product_price'])."' )");
  if($zapis) {
    $last_id = $db->insert_id;
    $archiv = $db->query("INSERT INTO ceny (produkt_id,cena) VALUES( '".$last_id."' , '".str_replace(',', '.', $_POST['product_price'])."' )");
    if(!$archiv) {
      $chyba++;
      $err_cena = $archiv->error;
    }
  } else {
    $chyba++;
    $err_produkt = $zapis->error;
  }

  if($chyba == '0')  {
    $ret['code'] = 'OK';
    $ret['inserted'] = $last_id;
    $ret['nazov'] = ocisti($_POST['product_name']);
    $ret['popis'] = ocisti($_POST['product_desc']);
    $ret['cena'] = str_replace(',', '.', $_POST['product_price']);
  } else {
    $ret['code'] = 'fail';
    $ret['text'] = 'Chyb: '.$chyba.'<br>Produkt insert:'.$err_produkt.'<br>Cena insert:'.$err_cena;
  }
  echo json_encode($ret);
}
?>
