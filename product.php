<?php session_start(); ?>
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

  <?php

  $productNumber = $_GET['product']; // Get Variable from parent Page to define Product Number
  include 'csvData.php';
  $array = getCsvData("data.csv");
  #array_unshift($array, "0");
  #unset($array[0]);
  $products = sizeof($array);

  //Get Product Variants
  if (array_key_exists('Variants', $array[$productNumber])) {
    $variants = explode(",",$array[$productNumber]['Variants']);
  }

  ?>

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <!-- Header -->
  <header class="container">
    <div class="row">
      <div class="twelve columns center" style="margin-top: 15%">
        <a href="index.php"><img src="images/logo.png" /></a>
        <p><a href="index.php">Zurück</a></p>
      </div>
    </div>
  </header>

  <!-- Product -->
  <div class="container" style="margin-top: 5%;">
    <div class="row">
      <div class="one-half column center">
        <img src="<?php echo $array[$productNumber]['ImagePath']?>" style="width: 100%;"/>
      </div>
      <div class="one-half column">
        <h4><?php echo $array[$productNumber]['Product']?></h4>
        <h5><?php echo $array[$productNumber]['Price'],' ',$array[$productNumber]['Currency']?></h5>

        <!-- Size Selector -->
        <?php
          if(isset($variants)){
            echo '<label for="exampleRecipientInput">Size</label>';
            echo '<select id="variant">';
            foreach ($variants as $key => $val) {
              echo '<option value="Option ',$key, ' ">',$val,'</option>';
            }
            echo '</select>';
          }
        ?>
        <script>
          var e = document.getElementById("variant");
          var variant = e.options[e.selectedIndex].text;
        </script>

        <p><?php echo $array[$productNumber]['Description']?></p>
        <a class="button" href="cart.php">In den Warenkorb</a>
        <?php $_SESSION["productToCart"] = $productNumber; ?>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <footer class="container">
    <div class="row">
      <div class="twelve columns center">
        <p>&copy; 2017 <a href="http://h2-ecommerce.com">H2 E-Commerce</a> <a href="#">Impressum</a></p>
      </div>
    </div>
  </footer>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
