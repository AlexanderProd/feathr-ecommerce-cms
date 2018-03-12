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

   $productNumber = $_SESSION["productToCart"];
   include 'csvData.php';
   $array = getCsvData("data.csv");
   #array_unshift($array, "0"); // Fügt den Wert 0 an den Anfang des Arrays an
   #unset($array[0]); // Entfernt den ersten Wert das Arrays
   $products = sizeof($array);

   $priceInCents = str_replace(",", "", $array[$productNumber]['Price']);
   $priceWithDots = str_replace(",", ".", $array[$productNumber]['Price']);

  ?>

</head>

<body>
  <!-- Main Header & Nav Bar -->
  <header class="container">
    <div class="row">
      <div class="twelve columns center" style="margin-top: 15%">
        <ul class="topnav">
          <li class="center"><a class="active" href="#home">Home</a></li>
          <li><a href="#news">News</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#about">About</a></li>
        </ul>
      </div>
    </div>
  </header>

  <div class="container" style="margin-top: 5%;">
    <div class="row">
      <div class="two columns center">
        <img src="<?php echo $array[$productNumber]['ImagePath'] ?>" style="width: 100%;" />
      </div>
      <div class="four columns left">
        <p><?php echo $array[$productNumber]['Product'] . $_REQUEST['variant']?></p>
      </div>
      <div class="three columns center">
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
      </div>
      <div class="right three columns">
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
      </div>
    </div>
  </div>

  <?php echo $array[$productNumber]['Product']?><br>
  <?php echo $array[$productNumber]['Price'],' ',$array[$productNumber]['Currency']?><br>


  <!-- Stripe Checkout -->
  <?php require_once('./config.php'); ?>
  <form action="charge.php" method="post">
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-amount="<?php echo $priceInCents?>"
            data-name="s1ck.one"
            data-description="<?php echo $array[$productNumber]['Product']?>"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto"
            data-zip-code="true"
            data-currency="<?php echo $array[$productNumber]['Currency']?>">
    </script>
  </form>

  <!-- PayPal Express Checkout Button -->
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <div id="paypal-button"></div>

    <script>
      paypal.Button.render({
        env: 'production', // Or 'sandbox',

        client: {
              sandbox:    '',
              production: ''
        },

        commit: true, // Show a 'Pay Now' button

        style: {
          color: 'gold',
          size: 'medium'
        },

        payment: function(data, actions) {
          return actions.payment.create({
                  payment: {
                      transactions: [
                          {
                              amount: { total: '<?php echo $priceWithDots ?>', currency: '<?php echo $array[$productNumber]['Currency']?>' }
                          }
                      ]
                  }
          });
        },

        onAuthorize: function(data, actions) {
          return actions.payment.execute().then(function(payment) {
            window.open ('index.php','_self',false)
          });
        },

        onCancel: function(data, actions) {
          /*
           * Buyer cancelled the payment
           */
        },

        onError: function(err) {
          /*
           * An error occurred during the transaction
           */
        }
      }, '#paypal-button');
    </script>

</body>
</html>
