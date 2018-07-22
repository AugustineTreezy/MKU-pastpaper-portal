<?php
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="department") {
    header("location: logout.php");
}
include 'connection.php';
require('department_header.php'); 

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
