<?php
session_start();
if(!$_SESSION['author_id']){
  header("Location:register.php");

}

// print_r($_SESSION);
// exit();




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safest</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body style="height:100vh;display:flex;align-items:center;justify-content:center">
<div style="margin:0 auto">
<form id="paymentForm">

<button type="submit" class="btn btn-primary btn-lg" onclick="payWithPaystack()"> Make payment </button>
</form>
</div>

<script src="https://js.paystack.co/v1/inline.js"></script>  

<script>
    const paymentForm = document.getElementById('paymentForm');
paymentForm.addEventListener("submit", payWithPaystack, false);
function payWithPaystack(e) {
  e.preventDefault();
  let handler = PaystackPop.setup({
    key: 'PAYSTACK_PUBLIC_KEY', // Replace with your public key
    email: 'this@gmail.com',
    amount: 1500 * 100,
    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
    // label: "Optional string that replaces customer email"
    onClose: function(){
        // window.location.href = "error.php";
      // alert('Window closed.');
      window.location.href = "../../index.php";
    },
    callback: function(response){
      let message = 'Payment complete! Reference: ' + response.reference;
      alert(message);
      window.location = "http://localhost/stellar-master/pages/samples/verify_payment.php?reference=" + response.reference;

    }
  });
  handler.openIframe();
}
</script>
</body>
</html>