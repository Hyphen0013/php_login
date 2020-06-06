<?php

if(isset($_POST['signup-submit'])) {

	include('../dbcon.php');
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$sex = $_POST['sex'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$confPassword = $_POST['confPassword'];

	// all field
	if(empty($name) || empty($email) || empty($sex) || empty($phone) || empty($password) || empty($confPassword)) {
		header('Location: ../pages/register.php?error=emptyAllField&name='.$name.'&email='.$email.'&sex='.$sex.'&phone='.$phone.'&password='.$confPassword);
		exit();
	} 

	// Name
	else if(!preg_match("/^[a-zA-Z -]*$/",$name)) {
		header('Location: ../pages/register.php?error=invalidName&name'.$name);
	} 
	else if(strlen($name) >= 10) {
		header('Location: ../pages/register.php?error=nameLength&name'.$name);
	} 
	
	// Email
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('Location: ../pages/register.php?error=validEmail&email'.$email);
	} 
	else if(strlen($email) > 30) {
		header('Location: ../pages/register.php?error=emailLength&email'.$email);
	} 

	// Phone
	else if(!is_numeric($phone)) {
		header('Location: ../pages/register.php?error=validPhone&phone'.$phone);
	} 
	else if(strlen($phone) != 10) {
		header('Location: ../pages/register.php?error=lengthPhone&phone'.$phone);
	} 
	
	// Password
	else if($_POST["password"] != $_POST["confPassword"]) {
		header('Location: ../pages/register.php?error=passwordMatch&password'.$password);
	} else {
		
		$sql = "SELECT email FROM users WHERE email = ?";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header('Location: ../pages/register.php?error=sqlerror');
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "s", $email);
			mysqli_stmt_execute($stmt);
			
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);

			if($resultCheck > 0) {
				header('Location: ../pages/register.php?$error_msg["email"] = "Email already exists"');
				exit();
			} else {

				$sql = "INSERT INTO users (name, email, sex, phone, password) VALUES (?, ?, ?, ?, ?)";
				$stmt = mysqli_stmt_init($conn);

				if(!mysqli_stmt_prepare($stmt, $sql)) {
					header('Location: ../pages/register.php?error=sqlerror');
					exit();
				} else {
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

					echo ($hashedPassword);
					mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $sex, $phone, $hashedPassword);
					mysqli_stmt_execute($stmt);
					header('Location: ../pages/register.php?signup=success');
					exit();
				}
			}
		}
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

} else {
	header('Location: ../pages/register.php');
	exit();
}