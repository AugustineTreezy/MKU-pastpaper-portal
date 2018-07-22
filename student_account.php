<?php
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="student") {
    header("location: logout.php");
}
include('student_header.php');
//upating password
if(isset($_POST['update'])) {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$confirmpassword=md5($_POST['confirmpassword']);
$errors="";

    if ($newpassword!=$confirmpassword) {
        $errors="Your password does not match";
    }
    if (empty($errors)) {
        $check=mysqli_query($link,"SELECT * FROM `students` WHERE `reg_no`='$reg_no'");
        $cols=mysqli_fetch_assoc($check);
        $db_pass=$cols['password'];
            if ($password==$db_pass) {
                $update=mysqli_query($link,"UPDATE `students` SET `password`='$newpassword' WHERE `reg_no`='$reg_no'");
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

//fetch the data for that specific student
$sel2=mysqli_query($link, "SELECT * FROM `payments` WHERE `user_reg_no`='$reg_no'");
$cols2=mysqli_fetch_assoc($sel2);
$valid_untill=$cols2['valid_untill'];
$date=date('m/d/Y');

//calculate difference between the dates
$date1=date_create("$date");
$date2=date_create("$valid_untill");
$diff=date_diff($date1,$date2);
$ans=$diff->format("%R%a");
$int = (int)$ans;

//check payment status
if (mysqli_num_rows($sel2)==1) {
    if ($cols2['valid_untill']<=$date) {
        $payment_status="Expired";
    }else {
        $payment_status="Active";
    }
}else {
    $payment_status="Never paid";
} 

//check the payment package
if (mysqli_num_rows($sel2)==1) {
    $payment_package=$cols2['payment_type'];
    }else {
        $payment_package="None";
}

//check date payed
if (mysqli_num_rows($sel2)==1) {
    $date_payed=date("M jS, Y", strtotime($cols2['date_payed']));
}else {
    $date_payed= "Not yet paid";
} 

//check the amount paid
if (mysqli_num_rows($sel2)==1) {
   $amount= 'Ksh ' . $cols2['amount'];                                        
}else {
    $amount= "Not yet paid";
}

//check the validity
if (mysqli_num_rows($sel2)==1) {
    if ($cols2['valid_untill']<=$date) {
        $valid_untill= "Invalid as from " . date("M jS, Y", strtotime($cols2['valid_untill']));  
    }else {
       $valid_untill= date("M jS, Y", strtotime($cols2['valid_untill']));                                        
    }
}else {
    $valid_untill=  "Not yet paid";
    }


?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="student_dash.php">Home</a>
        </li>
        <li>
            <a href="student_account.php">Account Settings</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i> User Info</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <!-- put your content here -->
                <h4><label>Name:&nbsp; &nbsp;</label><?php echo $fetch_student['username']; ?></h4>
                <h4><label>Registration Number:&nbsp; &nbsp;</label><?php echo $fetch_student['reg_no']; ?></h4>
            </div>
        </div>
    </div>

    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-star-empty"></i> Account Info</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <!-- put your content here -->
                <h4><label>Payment Status:&nbsp; &nbsp;</label><?php echo $payment_status; ?></h4>
                <h4><label>Package Validity:&nbsp; &nbsp;</label><?php echo $payment_package; ?></h4>                
                <h4><label>Package valid until:&nbsp; &nbsp;</label><?php echo $valid_untill; ?></h4>
                <h4><label>Date Paid:&nbsp; &nbsp;</label><?php echo $date_payed; ?></h4>
                <h4><label>Amount Paid:&nbsp; &nbsp;</label><?php echo $amount; ?></h4>
            </div>
        </div>
    </div>
</div><!--/row-->

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
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                </p>
              </form>
               
            </div>
    
            
        </div>
    </div>
</div>
    <!--/span-->

</div>

<?php include('footer.php'); ?>
