<?php

 include('../layouts/header.php');
 include('../validation.php');

?>

	<div class="flex-center position-ref full-height">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 20px;">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body"></div>

                    <div class="col-md-12 pr-5 pl-5">

                    <?php

                        if(isset($_GET['error'])) {
                            if($_GET['error'] == 'emptyAllField') {
                                echo  '
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        All field are required!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                ';
                            }
                        }

                        if(isset($_GET['signup'])) {
                            if($_GET['signup'] == 'success') {
                                echo  '
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Now you can login in!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                ';
                            }
                        }
                    ?>
                    
                        <form action="../includes/signup-form.php" method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="name" class="form-check-label">Full Name</label>
                                    <input type="text" id="name"  class="form-control" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>" placeholder="Enter full name" autofocus>
                                    <span style="color: red;">
                                        <?php
                                            if(isset($_GET['error'])) {
                                                if($_GET['error'] == 'invalidName') {
                                                    echo  'Enter a valid name';
                                                }
                                            }
                                            if(isset($_GET['error'])) {
                                                if($_GET['error'] == 'nameLength') {
                                                    echo  'Enter name is not greater then 10 characters';
                                                }
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="email" class="form-check-label">Email address</label>
                                    <input type="text" id="email"  class="form-control" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" placeholder="Enter email address" autofocus>
                                    <span style="color: red;">
                                        <?php
                                            if(isset($_GET['error'])) {
                                                if($_GET['error'] == 'validEmail') {
                                                    echo  'Enter a valid email';
                                                }
                                            }
                                            if(isset($_GET['error'])) {
                                                if($_GET['error'] == 'emailLength') {
                                                    echo  'Enter email is not greater then 30 characters';
                                                }
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="sex" value="Male" <?php if(isset($sex) && $sex ='Male') echo 'checked="checked"'; ?> >
                                        <label class="form-check-label" for="sex">Male</label>
                                      </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" id="sex" value="Female" <?php if(isset($sex) && $sex ='Female') echo 'checked="checked"'; ?> >
                                        <label class="form-check-label" for="">Female</label>
                                      </div>
                                      <br>
                                      <span style="color: red;">
                                        <?php
                                            if(isset($error_msg['sex'])) {
                                                echo  $error_msg['sex'];
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="phone" class="form-check-label">Phone Number</label>
                                    <input type="text" id="phone"  class="form-control" name="phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'] ?>" placeholder="Enter email address" autofocus>
                                    <span style="color: red;">
                                        <?php
                                            if(isset($_GET['error'])) {
                                                if($_GET['error'] == 'validPhone') {
                                                    echo  'Enter a valid phone number';
                                                }
                                            }
                                            if(isset($_GET['error'])) {
                                                if($_GET['error'] == 'lengthPhone') {
                                                    echo  'Enter length not greater than 10 digits';
                                                }
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password" class="form-check-label">Enter Password</label>
                                    <input type="text" id="password"  class="form-control" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" placeholder="Enter password" autofocus>
                                    <span style="color: red;">
                                        <?php
                                            if(isset($_GET['error'])) {
                                                if($_GET['error'] == 'passwordMatch') {
                                                    echo  'Enter Password and Confirm Password are matched';
                                                }
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="confPassword" class="form-check-label">Confirm Password</label>
                                    <input type="text" id="confPassword"  class="form-control" name="confPassword" value="" placeholder="Enter confirm password" autofocus>
                                    
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                    <span style="color: red;">
                                        <?php
                                            if(isset($_GET['error'])) {
                                                if($_GET['error'] == 'imageError') {
                                                    echo  'Upload valiid images. Only PNG and JPEG are allowed.';
                                                }
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
    
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox" value="Yes" <?php if(isset($checkbox) && $checkbox ='Yes') echo 'checked="checked"'; ?>>
                                <label class="form-check-label" for="checkbox">Read terms and conditions</label>
                                <br>
                                <span style="color: red;">
                                    <?php
                                        if(isset($error_msg['checkbox'])) {
                                            echo  $error_msg['checkbox'];
                                        }
                                    ?>
                                </span>
                              </div>
    
                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <button type="submit" name="signup-submit" class="btn btn-primary">
                                        Rergister
                                    </button>
                                    <span><a href="../index.php">Login</a> </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include('../layouts/footer.php');

?>