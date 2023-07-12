<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $description = $price = $image = "";
$name_err = $description_err = $price_err = $image = "";

// Processing form data when form is submitted 
if($_SERVER["REQUEST_METHOD"]  == "POST"){
    // Validate name
$input_name = trim($_POST["name"]);
if(empty($input_name)){
$name_err = "Please enter a name.";
} elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP,
array("options"=>array("regexp"=>" /^[a-zA-Z\s]+$/")))){
$name_err = "Please enter a valid name.";
} else{
    $name = $input_name;
}

// Validate description
$input_description = trim($_POST["description"]);
if(empty($input_description)){
$description_err = "Please enter an description.";
} else{
$description = $input_description;
}


// Validate price
$input_price = trim($_POST["price"]);
if(empty($input_price)){
$price_err = "Please enter the price amount.";
} elseif(!ctype_digit($input_price)){
$price_err = "Please enter a positive integer value.";
} else{
$price = $input_price;
}



// image
if (isset($_FILES['pp']['name']) AND !empty($_FILES['pp']['name'])) {
         
         
    $img_name = $_FILES['pp']['name'];
    $tmp_name = $_FILES['pp']['tmp_name'];
    $error = $_FILES['pp']['error'];
    
    if($error === 0){
       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
       $img_ex_to_lc = strtolower($img_ex);

       $allowed_exs = array('jpg', 'jpeg', 'png');
       if(in_array($img_ex_to_lc, $allowed_exs)){
          $new_img_name = uniqid($name, true).'.'.$img_ex_to_lc;
          $img_upload_path = '../images/'.$new_img_name;
          move_uploaded_file($tmp_name, $img_upload_path);

           // Insert into Database
        //    $sql = "INSERT INTO products (images) VALUES('$img_name')";
        //    $stmt = mysqli_query($link,$sql);
        //    if ($stmt){
        //     echo "congtas";
        //    }

        // Check input errors before inserting in database
    }
 }
}
if(empty($name_err) && empty($description_err) && empty($id_err)  && empty($image_err) && empty($price_err)&& empty($status_err)){
   
    // Prepare an insert statement
     $sql = "INSERT INTO products (id, price, description, name, status, image) VALUES (?, ?, ?, ?, ?, ?)";
    // $sql = "INSERT INTO `products`(`id`, `name`, `description`, `price`) VALUES ('$id','$name','$description',$price)";
    
    
    if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt,  "ssssss", $param_id,  $param_price, $param_description,  $param_name, $param_status, $param_img_name);
    
    // Set parameters
    $param_id = rand(100000, 999999);
    $param_price = $price;
    $param_description = $description;
    $param_name = $name;
    $param_status = "used";
    $param_img_name = $img_name;
    
    // Attempt to execute the prepared statement 
    if(mysqli_stmt_execute($stmt)){
    // Records created successfully. Redirect to landing page 
    header("location: admin.php");
    exit();
    } else{
    echo "Oops! Something went wrong. Please try again later.";
    }
    }
    
    // Close statement
     mysqli_stmt_close($stmt);
}

// Close connection 
mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Products</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

<style>
.wrapper{
width: 600px;
margin: 0 auto;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<h2 class="mt-5">Add Other Products</h2>
<p>Please fill up to add product to user interface and in database.</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"  enctype="multipart/form-data">  
<!-- <div class="form-group">
    <label>Product ID </label>
    <input type="interger" name="id" class="form-control <?php echo (!empty($id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $id; ?>">
    <span class="invalid-feedback"><?php echo $id_err;?></span>
</div> -->
<div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
    <span class="invalid-feedback"><?php  echo $name_err;?></span>
</div>
<div class="form-group">
    <label>Description</label>
    <input type="text" name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $description; ?>">
    <span class="invalid-feedback"><?php  echo $description_err;?></span>
</div>
<!-- <div class="form-group">
    <label>status</label>
    <input type="text" name="status" class="form-control <?php echo (!empty($status_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $status; ?>">
    <span class="invalid-feedback"><?php  echo $description_err;?></span>
</div> -->
<div class="form-group">
    <label>Price</label>
    <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
    <span class="invalid-feedback"><?php echo $price_err;?></span>
</div>
<br>
<div class="mb-3">
		    <label class="form-label"></label>
		    <input type="file" 
		           class="form-control"
		           name="pp">
		  </div>
            <br>
<input type="submit" class="btn btn-primary" value="submit">
<a href="admin.php" class="btn btn-secondary ml-2">Cancel</a>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
