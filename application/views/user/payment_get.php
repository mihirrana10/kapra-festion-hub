<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
</head>
<body>
<h1>Payment Gateway </h1>

<!-- <p>Click on one of the text labels to toggle the related radio button:</p> -->
<input type="text" name="name"  title="Title" placeholder="Enter Rupess" /> 
<br><br>


<input type="radio" id="paypal" name="fav_language" value="paypal"  onclick='paypalcalled()'>
<label for="paypal">Paypal</label><br>
<input type="radio" id="razorpay" name="fav_language" value="razorpay" onclick='razorpaycalled()'>
<label for="razorpay">Razorpay</label><br>
<input type="radio" id="Stripe" name="fav_language" value="stripe" onclick='stripecalled()'>
<label for="Stripe">Stripe</label><br><br>


</body>
</html>

<script>
     function paypalcalled() {
          window.open("<?php echo base_url();?>user/paypaldemo"); 
          window.location = url; 
     }
     function razorpaycalled() {
          window.open("<?php echo base_url(); ?>user/razorpay");
          window.location = url; 
     }
     function stripecalled() {
          window.open("<?php echo base_url(); ?>user/strip");
          window.location = url; 
     }

//      function price() {

//           var amount = $('#amount').val();   
//           var options = {
//     "key": "rzp_test_WKHV9byNfOPggx", // Enter the Key ID generated from the Dashboard
//     "amount": amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
//     "currency": "INR",
//     "name": "Online Payment",
//     "description": "Test Transaction",
//     "image": "https://thumbs.dreamstime.com/z/payment-icon-flat-style-payment-icon-flat-style-hand-holding-money-yellow-background-circle-124180489.jpg",
//     // "account_id": "acc_Ef7ArAsdU5t0XL",
//     // "order_id": "order_DBJOWzybf0sJbb", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
//     "handler": function (response){
//         console.log(response);
//         // alert(response.razorpay_payment_id);
//         // alert(response.razorpay_order_id);
//         // alert(response.razorpay_signature)
//     }
   
// };
// var rzp1 = new Razorpay(options);
// rzp1.on('payment.failed', function (response){
//         alert(response.error.code);
//         alert(response.error.description);
//         alert(response.error.source);
//         alert(response.error.step);
//         alert(response.error.reason);
//         alert(response.error.metadata.order_id);
//         alert(response.error.metadata.payment_id);
// });
// document.getElementById('rzp-button1').onclick = function(e){
//     rzp1.open();
//     e.preventDefault();
// }
          
//      }

     
</script>