<?php
// Include config file
require_once "config2.php";

// Define variables and initialize with empty values
$id = $name = $email = $password = $user_type = "";
$id_err = $name_err = $email_err = $password_err = $user_type_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)){
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    
    // Validate email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)){
        $email_err = "Please enter a email.";
    } else {
        $email = $input_email;
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if (empty($input_password)) {
        $password_err = "Please enter the password.";
    } elseif (!ctype_digit($input_password)) {
        $password_err = "Please enter a positive integer value.";
    } else {
        $password = $input_password;
    }

    // Validate user_type
    $input_user_type = trim($_POST["user_type"]);
    if (empty($input_user_type)) {
        $user_type_err = "Please enter a user_type.";
    } else {
        $user_type = $input_user_type;
    }

    // Check input errors before updating the database
    if (empty($name_err) && empty($password_err) && empty($user_type_err)) {
        // Prepare an update statement
        $id = trim($_GET["id"]);
        $sql = "UPDATE user SET name=?, email=?, password=?, user_type=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_email, $param_password, $param_user_type, $param_id);

            // Set parameters
            $pwd = password_hash($password, PASSWORD_DEFAULT);
            $param_name = $name;
            $param_email = $email;
            $param_password = $pwd;
            $param_user_type = $user_type;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
               {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM user WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array.
                       Since the result set contains only one row,
                       we don't need to use a while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $id = $row["id"];
                    $name = $row["name"];
                    $email = $row["email"];
                    $password = $row["password"];
                    $user_type = $row["user_type"];
                } 
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User</title>

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
<h2 class="mt-5">Add New Users</h2>
<p>Please fill this form and submit to add User record to the database.</p>

                 
<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" email="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <input type="text" id="user_type" name="user_type" class="form-control <?php echo (!empty($user_type_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user_type; ?>">
                            <span class="invalid-feedback"><?php echo $user_type_err;?></span>
                        </div>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="admin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
</div>
</div>
</div>
</div>
</body>
</html>