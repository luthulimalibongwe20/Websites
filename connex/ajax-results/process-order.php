<?php
include_once("functions-page.php");

$total = "50";

// if ($total == 0.00) {
//   alert("Add a product to cart to proceed");
//   redirect_back();
// }

$email = post_check_same_page("email");
$name = post_check_same_page("name");
$name_person = $name;
$phone = post_check_same_page("phone");
$lastname = post_check_same_page("lastname");

// $address_2 = post_check("address_2");
// $country = post_check("country");
// check_if_empty_same_page($country, 'Country');
// $city = post_check("city");
// check_if_empty_same_page($city, 'City');
// $zip_code = post_check("zip_code");
// check_if_empty_same_page($zip_code, 'zip code');
// $terms = post_check("terms");
// check_if_empty_same_page($terms, 'Term and conditions');

// $payment_status = 'NOT PAID';

// $list_code = array();
// $items = array();

// foreach ($_SESSION as $key => $value) {

//   if ($key == 'email' || $key == 'Total' || $key == 'Invoice') {
//     continue;
//   }

//   $list_code[] = $key . ' ' . $value;

//   $key = str_replace(' ', '', "$key");
//   $key = substr("$key", 1);

  // $pname = return_info($conn, 'products', 'name', 'id', $key);
  // $price = return_info($conn, 'products', 'price', 'id', $key);
  // $supplier = return_info($conn, 'products', 'supplier', 'id', $key);
  // // 	$group = return_info($conn,'products','group','id',$key);
  // // 	$description = return_info($conn,'products','description','id',$key);
  // //  $image = return_info($conn,'products','image','id',$key);
  // // 	$image_2 = return_info($conn,'products','image_2','id',$key);

  // $items[] = $value . ' ' . $pname . ' R ' . $price;
// }

// $list_code = implode(": ", $list_code);
// $items = implode(": ", $items);

$id = rand(1000, 9999);

// $_SESSION['Invoice'] = $id;
// $invoice = $id;

// $ip = get_ip();

// check_if_exists($conn, $dbname, 'orders', 'email', $id);


// insert_info($conn, $dbname, 'test_transactions', 'id', $id);
// update_info($conn, $dbname, 'test_transactions', 'name', 'id', $name, $id);
// update_info($conn, $dbname, 'test_transactions', 'lastname', 'id', $lastname, $id);
// update_info($conn, $dbname, 'test_transactions', 'email', 'id', $email, $id);
// update_info($conn, $dbname, 'test_transactions', 'phone', 'id', $phone, $id);

// if ($address_2 !== '') {

//   check_if_empty_same_page($address_2, 'address_2');
//   update_info($conn, $dbname, 'orders', 'address_2', 'id', $address_2, $id);
// }
// update_info($conn, $dbname, 'orders', 'payment_status', 'id', "$payment_status", $id);
// update_info($conn, $dbname, 'orders', 'email', 'id', $email, $id);
// update_info($conn, $dbname, 'orders', 'ip', 'id', $ip, $id);
// update_info($conn, $dbname, 'orders', 'number', 'id', $number, $id);
// update_info($conn, $dbname, 'orders', 'list_code', 'id', $list_code, $id);
// update_info($conn, $dbname, 'orders', 'list', 'id', $items, $id);
// update_info($conn, $dbname, 'orders', 'total', 'id', $total, $id);
// update_info($conn, $dbname, 'orders', 'address', 'id', $address, $id);

// update_info($conn, $dbname, 'orders', 'country', 'id', $country, $id);
// update_info($conn, $dbname, 'orders', 'city', 'id', $city, $id);
// update_info($conn, $dbname, 'orders', 'zip_code', 'id', $zip_code, $id);
// update_info($conn, $dbname, 'orders', 'terms', 'id', $terms, $id);
// update_info($conn,$dbname,'orders','news_letter','id',$news_letter,$id);

// removing commas for payfast gatway
// $total = floatval(preg_replace('/[^\d.]/', '', $total));

// $date = return_info($conn, 'orders', 'date', 'id', $invoice);

// $order_id = $invoice;
// $first_name = $name;
// $lastname = '';
// $item_description = 'Order (Please see email inbox for more, Invoice: #orderid";';
// $amount = "$total";
// $item_name = "Order (#$invoice)";

// $ymd = '' . date("Y-m-d");

/**
 * @param array $data
 * @param null $passPhrase
 * @return string
 */
// '1Q2w3e4r5t6y7u8i9o.'
// jt7NOE43FZPn
function generateSignature($data, $passPhrase = 'jt7NOE43FZPn')
{
  // Create parameter string
  $pfOutput = '';
  foreach ($data as $key => $val) {
    if ($val !== '') {
      $pfOutput .= $key . '=' . urlencode(trim($val)) . '&';
    }
  }
  // Remove last ampersand
  $getString = substr($pfOutput, 0, -1);
  if ($passPhrase !== null) {
    $getString .= '&passphrase=' . urlencode(trim($passPhrase));
  }
  return md5($getString);
}

// Construct variables
$cartTotal = $total; // This amount needs to be sourced from your application
$data = array(
  // Merchant details
//   'merchant_id' => '17393408',
//   'merchant_key' => 'nn2tkc8asjvsi',
  'merchant_id' => '10000100',
  'merchant_key' => '46f0cd694581a',
  'return_url' => 'https://gconnex.000webhostapp.com/ajax-results/return.php',
  'cancel_url' => 'https://gconnex.000webhostapp.com/ajax-results/cancel.php',
  'notify_url' => 'https://gconnex.000webhostapp.com/ajax-results/notify.php',
  // Buyer details
  'name_first' => "$name",
  'name_last'  => "$lastname",
  'email_address' => "$email",
  'cell_number' => "$phone",

  // Transaction details
  'm_payment_id' => "$id", //Unique payment ID to pass through to notify_url
  'amount' => number_format(sprintf('%.2f', $total), 2, '.', ''),
  'item_name' => "Test-transaction",
  'item_description' => "Test-transaction",
  'custom_int1' => '2',
  'custom_int2' => '4',
  'custom_int3' => '6',
  'custom_int4' => '8',
  'custom_int5' => '10',
  'custom_str1' => 'two',
  'custom_str2' => 'four',
  'custom_str3' => 'six',
  'custom_str4' => 'eight',
  'custom_str5' => 'ten',
  'email_confirmation' => "1",
  'confirmation_address' => "admin@finetrades.co.za",
  'payment_method' => '',
);

$signature = generateSignature($data);
$data['signature'] = $signature;

// If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
$testingMode = true;
$pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
$htmlForm = '<form action="https://' . $pfHost . '/eng/process" method="post">';
foreach ($data as $name => $value) {
  $htmlForm .= '<input name="' . $name . '" type="hidden" value=\'' . $value . '\' />';
}
$htmlForm .= '<button type="submit" class="m-4 btn btn-lg btn-success"> <i class="fab fa-cc-mastercard"></i> <i class="fab fa-cc-visa"></i> Pay Now</button></form>';

echo $htmlForm;

send_email('noreply@finetrades.co.za', "$email", "$name_person", 'Test transcation', "Hello $name_person, We're notifying you that your test has been recieved
  
  <br>Total: R $total 
  <br><br><a href='https://gconnex.000webhostapp.com/'>Go to Gconnex</a>");

send_email('noreply@finetrades.co.za', "admin@finetrades.co.za", "$name_person $lastname", "Test transaction", "$name_person $lastname with email $email has sent a test transaction
  <br><br>Name: $name_person 
  <br><br>Lastname: $lastname 
  <br> Email: $email 
  <br> Number: $phone 
  <br> Total: R $total 
  <br> PLEASE respond to customer  
  <br><br><a href='https://gconnex.000webhostapp.com/'>Go to Gconnex</a>");

?>