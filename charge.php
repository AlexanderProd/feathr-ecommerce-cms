<?php session_start(); ?>
<html>
<body>

<?php

 $productNumber = $_SESSION["productToCart"];
 include 'csvData.php';
 $array = getCsvData("data.csv");
 #array_unshift($array, "0"); // Fügt den Wert 0 an den Anfang des Arrays an
 #unset($array[0]); // Entfernt den ersten Wert das Arrays
 $products = sizeof($array);

 $priceInCents = str_replace(",", "", $array[$productNumber]['Price']);

?>

<?php
  require_once('./config.php');

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $priceInCents,
      'currency' => $array[$productNumber]['Currency']
  ));

  echo '<h1>Thank you for buying ',$array[$productNumber]['Product'], ' for ',$array[$productNumber]['Price'],'</h1>';
?>

</body>
</html>
