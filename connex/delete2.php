<?php
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"])){
// Include config file
require_once "config2.php";
// Prepare a delete statement
$sql = "DELETE FROM user WHERE id = ?";
if($stmt = mysqli_prepare($link, $sql)){
// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "i", $param_id);
// Set parameters
$param_id = trim($_POST["id"]);
// Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
// Records deleted successfully. Redirect to landing page
header("location: index11.php");

exit();  
} else{
echo "Oops! Something went wrong. Please try again later.";
}
}
// Close statement
mysqli_stmt_close($stmt);
// Close connection
mysqli_close($link);
} else{
// Check existence of id parameter
if(empty(trim($_GET["id"]))){
// URL doesn't contain id parameter. Redirect to error page
header("location: error2.php");
exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delete Record</title>
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
<h2 class="mt-5 mb-3">Delete Record</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="alert alert-danger">
<input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>

<p>Are you sure you want to delete this user record?</p>



<p>
    <input type="submit" value="Yes" class="btn btn-danger">
    <a href="index11.php" class="btn btn-secondary">No</a>
</p>

</div>
</form>
</div>
</div>
</div>
</div>

</body>
</html>