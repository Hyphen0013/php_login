<?php

if(isset($_POST['signup-submit'])) {

	include('../dbcon.php');
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$sex = $_POST['sex'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$confPassword = $_POST['confPassword'];
	$image = $_FILES['image'];

	$filename = time() . '_' . $_FILES['image']['name'];
	$filepath = $image['tmp_name'];
	$fileerror = $image['error'];

    // Get Image Dimension
    $fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
	);
	
   
    // Get image file extension
    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    
	// print_r($file_extension); die; return ;

	// all field
	if(empty($name) || empty($email) || empty($sex) || empty($phone) || empty($password) || empty($confPassword) || empty($image)) {
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
	} 
	
	// Image
	else if (! in_array($file_extension, $allowed_image_extension)) {
		header('Location: ../pages/register.php?error=imageError&image'.$image);
	} else if (($_FILES["image"]["size"] > 1000000)) {
		header('Location: ../pages/register.php?error=imageSize&image'.$image);
	} else if ($width > "1500" || $height > "1600") {
		header('Location: ../pages/register.php?error=imageDimension&image'.$image);
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

				if($fileerror == 0) {
					
					// $destfile = 'upload/'.$filename;
					$destfile = "upload/" . basename($_FILES["image"]["name"]);;

					move_uploaded_file($_FILES['image']['tmp_name'], $destfile);

					$sql = "INSERT INTO users (name, email, sex, phone, password, image) VALUES (?, ?, ?, ?, ?, ?)";
					$stmt = mysqli_stmt_init($conn);
					
					if(!mysqli_stmt_prepare($stmt, $sql)) {
						header('Location: ../pages/register.php?error=sqlerror');
						exit();
					} else {
						$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

						mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $sex, $phone, $hashedPassword, $filename);
						mysqli_stmt_execute($stmt);
						header('Location: ../pages/register.php?signup=success');
						exit();
					}
				} else {
					header('Location: ../pages/register.php?error=imageUploadError&image='.$image);
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