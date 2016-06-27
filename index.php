<?php
ob_start();
session_start();
header('Content-type: text/html; charset=utf-8');
require_once("./config.php");
?>
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="content-language" content="sk" />
  <meta name="description" content="eshop,produkty" />
  <meta name="keywords" content="eshop,produkty" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="Mon 26 Oct 1987 00:00:00">
  <meta name="author" content="eMDi">
  <meta name="copyright" content="eMDi" />
  <link rel="stylesheet" type="text/css" href="styles.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="./scripts.js"></script>
  <title>Administracia produktov</title>
</head>
<body>
  <div id="wrapper">
    <header>
      <span class="title">Administracia produktov</span>
      <a id="add_product_show_form" href="#">Pridat produkt</a>
    </header>
    <div id="content">
      <div id="new_product">
        <form name="product" id="add_product" method="post">
          <div id="submit_state"></div>
          <div><label for="product_name">Nazov produktu</label><input type="text" name="product_name" placeholder="Nazov produktu" maxlength="255"></div>
          <div><label for="product_desc">Popis produktu</label><textarea name="product_desc" placeholder="Popis produktu"></textarea></div>
          <div><label for="product_price">Cena produktu</label><input type="text" name="product_price" placeholder="0,00" maxlength="10"></div>
          <input type="hidden" name="product_action" value="add">
          <div><input type="submit" name="submit_product" value="Pridať produkt"></div>
        </form>
      </div>
      <div id="product_list">
        <?php
          $select = $db->query("SELECT * FROM produkty ORDER BY nazov ASC");
          if($select) {
            while($data=mysqli_fetch_assoc($select)) {
              echo "<div class=\"produkt\">
                      <span class=\"nazov\"></span>
                      <span class=\"popis\"></span>
                      <span class=\"cena\"></span>
                      <span class=\"akcie\"></span>
                    </div>";
            }
        }
        ?>
      </div>
    </div>
    <footer>
      &copy; <?php date("Y"); ?> eMDi
    </footer>
  </div>
</body>
</html>
