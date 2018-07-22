<?php 
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="department") {
    header("location: logout.php");
}
include 'connection.php';
$email=$_SESSION['email'];
$sel=mysqli_query($link, "SELECT email FROM department WHERE email='$email'");
$fetch=mysqli_fetch_assoc($sel);

if(isset($_POST['submit'])) {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$confirmpassword=md5($_POST['confirmpassword']);
$errors="";

    if ($newpassword!=$confirmpassword) {
        $errors="Your password does not match";
    }
    if (empty($errors)) {
        $check=mysqli_query($link,"SELECT * FROM `department` WHERE `email`='$email'");
        $cols=mysqli_fetch_assoc($check);
        $db_pass=$cols['password'];
    if ($password==$db_pass) {
        $update=mysqli_query($link,"UPDATE `department` SET `password`='$newpassword' WHERE `email`='$email'");
        if ($update) {
            $msg="Password updated successfully";
        }else{
            $errors="Something went wrong. Please try again";
        }
        
    }else{
        $errors="Current password does not match the one previously set";
       }
    }

 }
?>
<?php require('department_header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="admin_dash.php">Home</a>
        </li>
        <li>
            <a href="manage_pastpapers.php"> Profile</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> User Info</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div><br>
            <div class="box-content">
                <!-- put your content here -->
                <h4><label>Email:&nbsp; &nbsp;</label><?php echo $fetch['email']; ?></h4>
            </div>
    
            
        </div>
    </div>
    <!--/span-->

</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Update Password</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div><br>
            <div class="box-content">
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
             <form method="post">
                <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" placeholder="Current Password">
                </div>
                <div class="clearfix"></div><br>

                <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" id="newpassword" name="newpassword" class="form-control" autocomplete="new-password" placeholder="New Password">
                </div>
                <div class="clearfix"></div><br>

                <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" autocomplete="new-password" placeholder="Confirm Password">
                </div>
                <div class="clearfix"></div><br>

                <p class="center col-md-5">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </p>
              </form>
               
            </div>
    
            
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
    <!--/span-->
</div><!--/row-->
<?php require('footer.php'); ?>