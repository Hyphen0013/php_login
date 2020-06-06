<?php

if(isset($_POST['login-submit'])) {

	include('../dbcon.php');

	$email = $_POST['email'];
	$password = $_POST['password'];

	if(empty($email) || empty($password)) {
		header('Location: ../index.php?error=emptyfields');
		exit();
	} else {
		$sql = "SELECT * FROM users WHERE name = ? OR email = ?";

		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header('Location: ../index.php?error=sqlerror');
			exit();
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $email, $email);
			mysqli_stmt_execute($stmt);

			$result = mysqli_stmt_get_result($stmt);
			
			if($row = mysqli_fetch_assoc($result)) {
				$pwdCheck = password_verify($password, $row['password']);

				if($pwdCheck == false) {
					header('Location: ../index.php?error=wrongPassword');
					exit();	

				} else if($pwdCheck == true) {

					session_start();
					$_SESSION['userId'] = $row['id'];
					$_SESSION['userEmail'] = $row['email'];

					header('Location: ../index.php?login=success');
					exit();

				} else {
					header('Location: ../index.php?error=wrongPassword');
					exit();	
				}
			} else {
				header('Location: ../index.php?error=nouser');
				exit();
			}
		}
	}
 
} else {
	header('Location: ../pages/index.php');
	exit();
}