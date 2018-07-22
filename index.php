<?php 
session_start();
error_reporting(0);
include 'connection.php';
if (isset($_POST['sign_in'])) {
    $user_type = $_POST['user_type'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $reg_no = mysqli_real_escape_string($link, trim($_POST['reg_no']));
    $errors = "";

    //check if the user type is not student and validate the email address
    if ($user_type!=='student') {
        if (!preg_match(
        "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
        $email)){
            $errors .= "Error: Invalid email address";
        }
    }    

        //if there are no errors, we proceed
        if (empty($errors)) {
            //check which type of user is signing in to determine we will check fro which db
            if ($user_type=="student") {
                $sel=mysqli_query($link, "SELECT `reg_no` FROM `students` WHERE `reg_no`='$reg_no' AND `password`='$password'");                
                if (mysqli_num_rows($sel)==1) {
                    $_SESSION['user_type'] = $user_type;
                    $_SESSION['reg_no'] = $reg_no;
                    header("location:student_dash.php");                   
                }else {
                    $errors = "Invalid email address or password";
                }
                
            }elseif ($user_type=="department") {
                $sel=mysqli_query($link, "SELECT `email` FROM `department` WHERE `email`='$email' AND `password`='$password'");                
                if (mysqli_num_rows($sel)==1) {
                    $_SESSION['user_type'] = $user_type;
                    $_SESSION['email'] = $email;
                    header("location:department_dash.php");                   
                }else {
                    $errors = "Invalid email address or password";
                }
                
            }elseif ($user_type=="admin"){
                $sel=mysqli_query($link, "SELECT `email` FROM `admin` WHERE `email`='$email' AND `password`='$password'");                
                if (mysqli_num_rows($sel)==1) {
                    $_SESSION['user_type'] = $user_type;
                    $_SESSION['email'] = $email;
                    header("location:admin_dash.php");                   
                }else {
                    $errors = "Invalid email address or password";
                }

            }else {
                //the choice is invalid
                $errors = "The user type does not exist";
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
                Please login with your Username and Password.
            </div>
            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tower red"></i></span>
                      <select id="user_type" name="user_type" class="form-control show-tick" required autofocus>
                            <option value="">-- Please select user type --</option>
                            <option value="student">Student</option>
                            <option value="admin">Admin</option>
                            <option value="department">Department</option>                            
                      </select>
                    </div>
                    <div class="clearfix"></div><br>

                    <div id="reg_no_div">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" id="reg_no" name="reg_no" class="form-control" autocomplete="new-text" placeholder="Registration Number">
                    </div>
                    <div class="clearfix"></div><br>
                    </div>

                    <div id="username_div">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" id="email" name="email" class="form-control" autocomplete="new-text" placeholder="Email">
                    </div>
                    <div class="clearfix"></div><br>
                    </div>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" placeholder="Password">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-prepend" id="no_account">
                        <p align="left">Don't have an account? Click <a href="signup.php">here</a></p>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" name="sign_in" class="btn btn-primary">Login</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
<?php require('footer.php'); ?>
<script type="text/javascript">
         
    $(document).ready(function(){
        //hide divs for student reg no and study level on page start
        $("#reg_no_div").hide();
        $("#no_account").hide();

           $("#user_type").change(function () {       
            var DropVal = $('#user_type').val();
            if (DropVal=='student') {
                //show divs for student reg no and study level when student is selected on dropdown
                $("#username_div").hide();
                $("#reg_no_div").show();
                $("#no_account").show();

            }else {
                $("#username_div").show();
                $("#reg_no_div").hide();
                $("#no_account").hide();
            }
        });
     });
</script>
