<?php

if(isset($_POST['signup-submit'])) {

    // Name
    $name = $_POST['name'];
    if($name == "") {
        $error_msg['name'] = "Name is required";
    }
    if(!preg_match("/^[a-zA-Z -]*$/",$name)) {
        $error_msg['name'] = "Only letters valid";
    }
    if(strlen($name) >= 10) {
        $error_msg['name'] = "Name length in smaller than 10 characters";
    }
    
    // Email
    $email = $_POST['email'];
    if($email == "") {
        $error_msg['email'] = "Email is required";
    }
    if(strlen($email) > 30) {
        $error_msg['email'] = "Email length in smaller than 15 characters";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg['email'] = "Invalid email address";
    }

    // Gender
    $sex = $_POST['sex'];
    if(empty($sex)) {
        $error_msg['sex'] = "Gender is required";
    }
    
    // Phone
    $phone = $_POST['phone'];
    if($phone == "") {
        $error_msg['phone'] = "Phone is required";
    }
    if(!is_numeric($phone)) {
        $error_msg['phone'] = "Only numbers allowed";
    }
    if(strlen($phone) != 10) {
        $error_msg['phone'] = "Only 10 characters";
    }

    // Password
    $password = $_POST['password'];
    $confirmPassword = $_POST['confPassword'];

    if($password == "") {
        $error_msg['password'] = "Password is required";
    }
    if(strlen($password) >= 20) {
        $error_msg['password'] = "Password length in smaller than 20 characters";
    }

    // Confirm Password
    if($confirmPassword == "") {
        $error_msg['confPassword'] = "Confirmed password is required";
    }
    if($_POST["password"] != $_POST["confPassword"]) {
        $error_msg['samePass'] = "Passwords should be same.";
    }


    // Image
    $image = $_POST['image'];
    if($_FILES["image"]["name"]) {

        

        if($_FILES["image"]["size"] <= (1024*1024) and (($_FILES["image"]["type"] == 'image/jpeg') and ($_FILES["image"]["type"] == 'image/png')  and ($_FILES["image"]["type"] == 'image/jpg')))  {

            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" .time() .rand() ."_" .$_FILES["image"]["name"]);

        } else {
            $error_msg['image'] = "Only .jpeg and .png format and max 1 MB file allowed";
        }
    } else {
        $error_msg['image'] = "Image is required";
    }

    // CHECKBOX
    $checkbox = $_POST['checkbox'];
    if(empty($checkbox)) {
        $error_msg['checkbox'] = "Check box is required";
    }
    

}


?>