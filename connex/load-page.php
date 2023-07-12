<?php
include_once('functions-page.php');


// Reading information from the database

if (isset($_POST['add_to_cart'])) {
    $id = $_POST['id'];
    // this is the query to insert into database
    $query ="SELECT `id` FROM `products` WHERE `id` = '$id';";
    
    // runs query to database
    $result = mysqli_query($conn, $query);

    // checks number of rows returned if not "0" makes email = $value 
    $row = mysqli_num_rows($result);
	if ($row == 0) {
		echo ("Product $id is not found");
	} else {
        while ($row = mysqli_fetch_assoc($result)) {
            $value = $row["id"];
        }  
        
        $name = return_info($conn, 'products', 'name', 'id', $id);
        $id = return_info($conn, 'products', 'id', 'id', $id);
        $price = return_info($conn, 'products', 'price', 'id', $id);
        $description = return_info($conn, 'products', 'description', 'id', $id);
        $status = return_info($conn, 'products', 'status', 'id', $id);

        $_SESSION["p$id"] = "1";
        $session = ''.$_SESSION["p$id"];
        
        // echo ("ID of product is Id: $id <br>Name: $name <br>Price: $price <br>Description: $description <br>Session: $session");
        // echo("<br>");
        // echo("<br>");
        // echo("Product ID's selected or in cart");
        // echo("<br>");
        
        // include("calculate-total.php");
        redirect_back();

    }
}


if (isset($_POST['checkout'])) {
    foreach ($_SESSION as $key=>$val)
    echo $key." ".$val."<br/>";
    include("calculate-total.php");

    echo"This is your total";
}

if (isset($_POST['register'])) {

    $email = post_check("email");
    $name = post_check("name");
    $surname = post_check("surname");
    $phone = post_check("phone");
    $password = post_check("password");
    $username = post_check("username");
    $confirm_password = post_check("confirm_password");

    $id = rand(100000,999999);

	check_if_exists_same_page($conn,$dbname,'users','email',$email," account with $email has already been created");
	check_if_exists_same_page($conn,$dbname,'users','id',$id," account with $id has already been created");

    insert_info($conn,$dbname,'users','email',$email);
	update_info($conn,$dbname,'users','name','email',$name,$email);
	update_info($conn,$dbname,'users','username','email',$username,$email);
	update_info($conn,$dbname,'users','surname','email',$surname,$email);
	update_info($conn,$dbname,'users','phone','email',$phone,$email);
	update_info($conn,$dbname,'users','password','email',$password,$email);

    
    echo"Your account has been created successfuly";
    
    //  This function will send an email once the user has c
    // send_email('noreply@finetrades.co.za', "$email", "$name", 'Welcome Email', "Hello $name, Welcome to connex
    
    // <br><br><a href='#'>Go to Connex</a>");
    


}

if (isset($_POST['remove_from_cart'])) {
    $id = $_POST['id'];
    unset($_SESSION["p$id"]);

    // include("calculate-total.php");
    redirect_back();
    
}

// if (isset($_POST['update_product'])) {
//     $product_id = $_POST['product_id'];
//     $property = $_POST['property'];
//     $value = $_POST['value'];

// 	update_info($conn,$dbname,'products',$property,'id',$value,$product_id);

//     go_to('cart.php');
    
    
// }