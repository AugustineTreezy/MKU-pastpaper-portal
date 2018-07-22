<?php
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="admin") {
    header("location: logout.php");
}
include 'connection.php';
require('admin_header.php'); 
$sel_total_members=mysqli_query($link, "SELECT * FROM students");
$total_members=mysqli_num_rows($sel_total_members);

$sel_1month=mysqli_query($link, "SELECT payment_type FROM payments WHERE payment_type='1 month'");
$_1month=mysqli_num_rows($sel_1month);

$sel_2months=mysqli_query($link, "SELECT payment_type FROM payments WHERE payment_type='2 months'");
$_2months=mysqli_num_rows($sel_2months);

$sel_3months=mysqli_query($link, "SELECT payment_type FROM payments WHERE payment_type='3 months'");
$_3months=mysqli_num_rows($sel_3months);

$sel_pastpapers=mysqli_query($link, "SELECT * FROM pastpapers");
$pastpapers=mysqli_num_rows($sel_pastpapers);

$sel_intelligent_q=mysqli_query($link, "SELECT * FROM intelligent_questions");
$intelligent_q=mysqli_num_rows($sel_intelligent_q);
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a class="well top-block" href="members.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Total Members</div>
            <div><?php echo $total_members; ?></div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a class="well top-block" href="paying_1month.php">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Paying 1 Month</div>
            <div><?php echo $_1month; ?></div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a class="well top-block" href="paying_2months.php">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Paying 2 Months</div>
            <div><?php echo $_2months; ?></div>
        </a>
    </div>

     <div class="col-md-3 col-sm-3 col-xs-6">
        <a class="well top-block" href="paying_3months.php">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Paying 3 Months</div>
            <div><?php echo $_3months; ?></div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a class="well top-block" href="manage_pastpapers.php">
            <i class="glyphicon glyphicon-random blue"></i>

            <div>Total Pastpapers</div>
            <div><?php echo $pastpapers; ?></div>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a class="well top-block" href="manage_intelligent_question.php">
            <i class="glyphicon glyphicon-folder-close blue"></i>

            <div>Intelligent Questions</div>
            <div><?php echo $intelligent_q; ?></div>
        </a>
    </div>
</div>
<?php require('footer.php'); ?>
