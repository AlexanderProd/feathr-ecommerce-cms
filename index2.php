<?php
session_start();

include 'csvData.php';
$array = getCsvData("data.csv");
#array_unshift($array, "0"); // Fügt den Wert 0 an den Anfang des Arrays an
#unset($array[0]); // Entfernt den ersten Wert das Arrays
$products = sizeof($array);

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			#$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			#$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>s1ck.one</title>
  <meta name="description" content="">
  <meta name="author" content="H2 E-Commerce">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/style.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <!-- Header -->
  <header class="container">
    <div class="row">
      <div class="twelve columns center" style="margin-top: 15%">
        <img src="images/logo.png" />
        <ul class="topnav">
          <li class="center"><a class="active" href="#home">Home</a></li>
          <li><a href="#news">News</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#about">About</a></li>
        </ul>
      </div>
    </div>
  </header>

  <div class="container center">
    <div class="row">
      <div class="twelve columns center" style="margin-top: 10%">
        <h4>Produkte:</h4>
      </div>
    </div>
  </div>

  <!-- Products -->
  <div class="container products center">
    <?php
      for ($i = 1; $i <= $products; $i++) {
        if ($i == 1 || ($i/$products) != 0) {
          echo '<div class="row">';
        }
        echo
        '<div class="one-third column">
          <a href="product.php?product=',$i,'">
          <div class="img-wrapper">
            <img src="',$array[$i]['ImagePath'],'">
          </div>
          </a>
          <p>',$array[$i]['Product'],'</p>
          <h6>',$array[$i]['Price'],' ',$array[$i]['Currency'],'</h6>
        </div>';
        if ($i == 0 || ($i/$products) == 0) {
          echo "</div>";
        }
      }
    ?>
  </div>

  <!-- Newsletter Signup -->
  <div class="container" style="margin-top: 100px;">
    <div class="row">
      <div class="twelve columns center">
        <!-- Begin MailChimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
        <style type="text/css">
        	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; width:100%;}
          #mc-embedded-subscribe {padding: 0 20px; height: 32px; line-height: 32px; background-color: #C30933; border-color: #EA1953;}
        </style>
        <div id="mc_embed_signup">
          <form action="https://nureinberg.us15.list-manage.com/subscribe/post?u=dc5e0460fc0395d0e55702a6a&amp;id=889db71edd" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
            	<label for="mce-EMAIL">Bei Interesse an den Shirts hier eintragen.</label>
            	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Adresse" required>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_dc5e0460fc0395d0e55702a6a_889db71edd" tabindex="-1" value=""></div>
                <div class="clear"><input type="submit" value="JA MANN!" name="subscribe" id="mc-embedded-subscribe" class="button-primary"></div>
              </div>
          </form>
        </div>

        <!--End mc_embed_signup-->
      </div>
    </div>
    <?php
      #echo "<pre>";
      #print_r($array);
      #echo "</pre>";
    ?>
  </div>

  <!-- Footer -->
  <footer class="container">
    <div class="row">
      <div class="twelve columns center">
        <p style="font-weight: normal;">&copy; 2017 <a href="http://h2-ecommerce.com">H2 E-Commerce</a> <a href="#">Impressum</a></p>
      </div>
    </div>
  </footer>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
