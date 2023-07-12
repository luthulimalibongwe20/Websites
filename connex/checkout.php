<?php
include 'functions-page.php';

if(isset($_POST['order_btn'])){

   // Validate form inputs here
   $name = $_POST['name'];
   $email = $_POST['email'];
   $address = $_POST['address'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $zip = $_POST['zip'];
   $cardname = $_POST['cardname'];
   $cardnumber = $_POST['cardnumber'];
   $expmonth = $_POST['expmonth'];
   $cvv = $_POST['cvv'];

   // Perform form validation here

   // If form is valid, process the order
   $total_products = implode(', ', $product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(`id`, `name`, `email`, `address`, `city`, `state`, `zip`, `cardname`, `cardnumber`, `expmonth`, `cvv`) VALUES ('$id','$name','$email','$address','$city','$state','$zip','$cardname','$cardnumber','$expmonth','$cvv')") or die('query failed');

   if($detail_query){
      echo "
      <div class='order-message-container'>
         <div class='message-container'>
            <h3>Thank you for shopping!</h3>
            <div class='order-detail'>
               <span>".$total_products."</span>
               <span class='total'>Total: R".$price_total."/-</span>
            </div>
            <div class='customer-details'>
               <p>Your name: <span>".$name."</span></p>
               <p>Your email: <span>".$email."</span></p>
               <p>Your address: <span>".$city.", ".$state.", - ".$zip."</span></p>
               <p>Your payment mode: <span>".$cardname.", ".$cardnumber.", ".$expmonth.",".$cvv."</span></p>
               <p>(*Pay when product arrives*)</p>
            </div>
            <a href='products.php' class='btn'>Continue Shopping</a>
         </div>
      </div>
      ";
      echo "<script>showMessage('Order has been successful!');</script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style3.css">
   <link rel="stylesheet" href="css/style7.css">

</head>
<body>

<?php include 'load-page.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="load-page.php" method="post" onsubmit="return validateForm()">

   <div class="display-order">
      <!-- Display order items here -->
      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE 1");
         $total = 0;
         $grand_total = 0;

         foreach ($_SESSION as $key=>$val){
         
            if($key == 'admin_id' || $key == 'admin_email' || $key == 'admin_name' || $key == 'user_id' || $key == 'user_name' || $key == 'user_email'){continue;}
            $product_id = substr($key, -6);
            $id = return_info($conn, 'products', 'id', 'id', $product_id);
            $name = return_info($conn, 'products', 'name', 'id', $product_id);
            $image = return_info($conn, 'products', 'image', 'id', $product_id);
            $price = return_info($conn, 'products', 'price', 'id', $product_id);
   
           
      echo "
         <tr>
            <td><img src='images/$image' height='100' alt=''></td>
            <td> $name</td>
            <td>R $price</td>
            <td>
               <form action='load-page.php' method='post'>
                  <input type='hidden' name='id' value='$id'>
      
                  <input type='submit' name='remove_from_cart' value='delete' class='option-btn'> 
               </form>
            </td>
            <td>R$price</td>
               </tr>";
      
         $grand_total += $price;
            
      }
      
      ?>
   </div>

   <div class="row">
      <div class="col-75">
         <div class="container">
            <form>

               <!-- Billing Address -->
               <div class="row">
                  <div class="col-50">
                     <h3>Billing Address</h3>
                     <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                     <input type="text" id="fname" name="firstname" placeholder="Malbee">
                     <label for="email"><i class="fa fa-envelope"></i> Email</label>
                     <input type="text" id="email" name="email" placeholder="Malbee@example.com">
                     <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                     <input type="text" id="adr" name="address" placeholder="28 Albert Street">
                     <label for="city"><i class="fa fa-institution"></i> City</label>
                     <input type="text" id="city" name="city" placeholder="Durban">

                     <div class="row">
                        <div class="col-50">
                           <label for="state">State</label>
                           <input type="text" id="state" name="state" placeholder="SA">
                        </div>
                        <div class="col-50">
                           <label for="zip">Zip</label>
                           <input type="text" id="zip" name="zip" placeholder="4000">
                        </div>
                     </div>
                  </div>

                  <!-- Payment -->
                  <div class="col-50">
                     <h3>Payment</h3>
                     <label for="fname">Accepted Cards</label>
                     <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                     </div>
                     <label for="cname">Name on Card</label>
                     <input type="text" id="cname" name="cardname" placeholder="Malbee">
                     <label for="ccnum">Credit card number</label>
                     <input type="text" id="ccnum" name="cardnumber" placeholder="0123456789">
                     <label for="expmonth">Exp Month</label>
                     <input type="text" id="expmonth" name="expmonth" placeholder="July">
                     <div class="row">
                        <div class="col-50">
                           <label for="expyear">Exp Year</label>
                           <input type="text" id="expyear" name="expyear" placeholder="2019">
                        </div>
                        <div class="col-50">
                           <label for="cvv">CVV</label>
                           <input type="text" id="cvv" name="cvv" placeholder="352">
                        </div>
                     </div>
                  </div>
               </div>
               
               <label>
                  <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
               </label>
               <input type="submit" value="order now" name="order_btn" class="btn">
            </form>
         </div>
      </div>
   </div>

   </form>
</section>
</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
   function validateForm() {
      // Perform form validation here
      // You can use JavaScript to check the form inputs and display appropriate error messages if needed
      // Return true if the form is valid and can be submitted, or false to prevent form submission
      
      // Example validation for the "Full Name" field
      var fullName = document.getElementById("fname").value;
      if (fullName === "") {
         alert("Full Name field is required");
         return false; // Prevent form submission
      }

      // Example validation for the "Email" field
      var email = document.getElementById("email").value;
      if (email === "") {
         alert("Email field is required");
         return false; // Prevent form submission
      }

       // Example validation for the "address" field
       var address = document.getElementById("address").value;
      if (address === "") {
         alert("address field is required");
         return false; // Prevent form submission
      }

       // Example validation for the "city" field
       var city = document.getElementById("city").value;
      if (city === "") {
         alert("city field is required");
         return false; // Prevent form submission
      }

      // Example validation for the "state" field
      var state = document.getElementById("state").value;
      if (state === "") {
         alert("state field is required");
         return false; // Prevent form submission
      }

      // Example validation for the "zip" field
      var zip = document.getElementById("zip").value;
      if (zip === "") {
         alert("zip field is required");
         return false; // Prevent form submission
      }

      // Example validation for the "cardname" field
      var cardname = document.getElementById("cardname").value;
      if (cardname === "") {
         alert("cardname field is required");
         return false; // Prevent form submission
      }

      // Example validation for the "cardnumber" field
      var cardnumber = document.getElementById("cardnumber").value;
      if (cardnumber === "") {
         alert("cardnumber field is required");
         return false; // Prevent form submission
      }

      // Example validation for the "expmonth" field
      var expmonth = document.getElementById("expmonth").value;
      if (expmonth === "") {
         alert("expmonth field is required");
         return false; // Prevent form submission
      }

      // Example validation for the "cvv" field
      var cvv = document.getElementById("cvv").value;
      if (cvv === "") {
         alert("cvv field is required");
         return false; // Prevent form submission
      }

      // Add more validation for other fields as needed

      return true; // Form is valid, allow submission
   }
</script>
</body>
</html>
