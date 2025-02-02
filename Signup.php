<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include 'partials/_dbconnect.php';
	$username = $_POST["username"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];

	// Check whether this username exists
	$existSql = "SELECT * FROM `users` WHERE username = '$username'";
	$result = mysqli_query($conn, $existSql);
	$numExistRows = mysqli_num_rows($result);
	if ($numExistRows > 0) {
		$showError = "Username Already Exists";
	} else { 
		if (($password == $cpassword)) {

			$sql = "INSERT INTO `users` ( `username`, `password`, `Date`) VALUES ('$username', '$password', current_timestamp())";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				$showAlert = true;	
			}

		} else {
			$showError = "Passwords do not match";
		}
	}
}

?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>SignUp</title>
</head>

<body>
	<?php require 'partials/_nav.php' ?>
	<?php
	if ($showAlert) {
		echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is now created and you can login
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
	}
	if ($showError) {
		echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
	}
	?>

	<div class="container my-4">
		<h1 class="text-center">Signup to our website</h1>
		<form action="/MyLoginSystem/signup.php" method="post">
			<div class="form-group">
				<label for="username">Username</label>
				<input type="text" maxlength="11" class="form-control" id="username" name="username"
					aria-describedby="emailHelp">

			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" maxlength="23" class="form-control" id="password" name="password">
			</div>
			<div class="form-group">
				<label for="cpassword">Confirm Password</label>
				<input type="password" class="form-control" id="cpassword" name="cpassword">
				<small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
			</div>

			<button type="submit" class="btn btn-primary">SignUp</button>
		</form>
	</div>
</body>

</html>