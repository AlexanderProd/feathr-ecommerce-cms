<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_isUmCswqt3dxoxIuzG0H34cL",
  "publishable_key" => "pk_test_Gmbhao56LeFZAs7MKivhIXXL"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
