<?php

    session_start();
    include('layouts/header.php');

?>
	<div class="flex-center position-ref full-height">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 20px;">
           
          
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 pr-5 pl-5">
                        <?php

                            if(isset($_SESSION['userId'])) {
                                echo '
                                    <p>You Logged In</p>

                                    <form action="includes/logout.php" method="post">
                                        <span><button type="submit" class="btn btn-primary" name="logout-submit">Logout</button> </span>
                                    </form>
                                    ';
                            } else {
                                echo '<p>You Logged Out</p>';
                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>
            
            <?php 
                if(!isset($_SESSION['userId'])) {
                echo '
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 pr-5 pl-5">

                            <form action="../includes/login.php" method="post">
                                    
            
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="email" class="form-check-label">Email address</label>
                                            <input type="text" id="email"  class="form-control" name="email"  placeholder="Enter email address" autofocus>
                                        </div>
                                    </div>
                                    
                                

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label for="password" class="form-check-label">Enter Password</label>
                                            <input type="text" id="password"  class="form-control" name="password" placeholder="Enter password" autofocus>
                                        </div>
                                    </div>
            
                                

                                
            
                                    <div class="form-group row mb-5">
                                        <div class="col-md-6">
                                            <button type="submit" name="login-submit" class="btn btn-primary">
                                                Login
                                            </button>
                                            <span><a href="pages/register.php">Signup</a> </span>
                                        </div>
                                    </div>
                                </form>
                            
                                
                            </div>
                        </div>
                    </div>
                </div>
                ';
                }
            ?>
            
        </div>
    </div>
</div>
<?php

include('layouts/footer.php');

?>