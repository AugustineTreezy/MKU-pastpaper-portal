<?php 
session_start();
error_reporting(0);
include 'connection.php';
if (isset($_POST['sign_up'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    $reg_no = mysqli_real_escape_string($link, trim($_POST['reg_no']));
    $errors = "";

    //check if the user type is not student and validate the email address
    if ($password!==$confirm_password) {        
            $errors .= "Error: Password do not match";        
    }    

        //if there are no errors, we proceed
        if (empty($errors)) {
            $ins=mysqli_query($link, "INSERT INTO `students`(`id`, `username`, `password`, `reg_no`) VALUES ('','$username','$password','$reg_no')");
            if ($ins) {
                $msg="Account created succesfully,you can now proceed to login";
            }else {
                $errors .= "Error: Unable to create account. Try again later.";
            }
        }

    }
?>
<?php
$no_visible_elements = true;
include('student_header.php'); ?>

    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>MKU PastPapers Portal</h2>
        </div>        
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">            
            <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $errors; ?>
              
            </div>
            <?php } ?>
            <?php if (!empty($msg)) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $msg; ?>
              
            </div>
            <?php } ?>
            <div class="alert alert-info">
                Please Input your credetials for new account.
            </div>
            <form class="form-horizontal" method="post">
                <fieldset>

                    <div id="reg_no_div">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" id="reg_no" name="reg_no" class="form-control" autocomplete="new-text" placeholder="Registration Number" required>
                    </div>
                    <div class="clearfix"></div><br>
                    </div>

                    <div id="username_div">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" id="username" name="username" class="form-control" autocomplete="new-text" placeholder="Full name" required>
                    </div>
                    <div class="clearfix"></div><br>
                    </div>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" placeholder="Password" required>
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" autocomplete="new-password" placeholder="Confirm Password" required>
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-prepend" id="no_account">
                        <p align="left">Already have an account? Click <a href="index.php">here</a></p>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" name="sign_up" class="btn btn-primary">Register</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
<?php require('footer.php'); ?>
<script type="text/javascript">
         
   
    </script>
