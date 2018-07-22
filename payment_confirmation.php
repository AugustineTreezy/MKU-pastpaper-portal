<?php
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="student") {
    header("location: logout.php");
}
include 'connection.php';
include 'config.php';
$reg_no=$_SESSION['reg_no'];
if (isset($_POST['submit'])) { 
    $time=date("h:ia");
    $date=date('m/d/Y');
    $type=$_POST['type'];
    $mode=$_POST['mode'];
    $mpesa_code=$_POST['mpesa_code'];

    switch ($type) {
        case '1 month':
            $amount=199;
            $startDate = date('Y-m-d'); // select date in Y-m-d format
            $nMonths = 1; // choose how many months you want to move ahead
            $valid_untill = endCycle($startDate, $nMonths); // output
            break;
        case '3 months':
            $amount=499;
            $startDate = date('Y-m-d'); // select date in Y-m-d format
            $nMonths = 3; // choose how many months you want to move ahead
            $valid_untill = endCycle($startDate, $nMonths); // output
            break;
        default:
            $amount=799;
            $startDate = date('Y-m-d'); // select date in Y-m-d format
            $nMonths = 6; // choose how many months you want to move ahead
            $valid_untill = endCycle($startDate, $nMonths); // output
            break;
    }

    //show the amount with 2 dp
    $final_amount= number_format((float)$amount, 2, '.', '');

    $ins=mysqli_query($link, "INSERT INTO `payments_report`(`id`, `user_reg_no`, `payment_type`, `payment_mode`, `date_payed`, `time_payed`, `valid_untill`, `amount`) VALUES ('','$reg_no','$type','$mode','$date','$time','$valid_untill','$final_amount')");
    if ($ins) {
            //check if user made any payments and update, else insert it
            $check=mysqli_query($link,"SELECT * FROM `payments` WHERE `user_reg_no`='$reg_no'");            
            if (mysqli_num_rows($check)==1) {
                $update=mysqli_query($link, "UPDATE `payments` SET `payment_type`='$type',`payment_mode`='$mode',`date_payed`='$date',`time_payed`='$time',`valid_untill`='$valid_untill',`amount`='$final_amount' WHERE `user_reg_no`='$reg_no'");
            }else {
                $insert=mysqli_query($link, "INSERT INTO `payments`(`id`, `user_reg_no`, `payment_type`, `payment_mode`, `date_payed`, `time_payed`, `valid_untill`, `amount`) VALUES ('','$reg_no','$type','$mode','$date','$time','$valid_untill','$final_amount')");

            }
            $msg="You successfully deposited Ksh $final_amount to your account. <a href='student_account.php'>Click here </a>to see your payment info";
        }else{
            $error="Something went wrong, please try again later";
        }


}else {
    header("loacation: student_dash.php");
}   

function endCycle($d1, $months){
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add(add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new DateInterval('P1D')); 

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('m/d/Y'); 

        return $dateReturned;
    }

function add_months($months, DateTime $dateObject){
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }
?>
<?php require('student_header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="student_dash.php">Home</a>
        </li>
        <li>
            <a href="upgrade_account.php"> Upgrade Account</a>
        </li>
        <li>
            <a href="#"> Payment Confirmation</a>
        </li>
    </ul>
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

</div>
    <!--/span-->
</div><!--/row-->
<?php require('footer.php'); ?>


