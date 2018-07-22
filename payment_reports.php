<?php
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="admin") {
    header("location: logout.php");
}
require('admin_header.php');
include 'connection.php';

if(!isset($_SESSION['reg_no'])){  
    header('location:index.php');

}else{
    $id_number=$_SESSION['reg_no'];
    $sel=mysqli_query($link, "SELECT * FROM payments_report,students");

} ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Payment Reports</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Payment Reports</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div><br>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Student Name</th>
        <th>Reg No</th>
        <th>Payment Type</th>
        <th>Payment Mode</th>
        <th>Amount Paid</th>
        <th>Payment Date/Time</th>
        <th>Payment Valid Untill</th> 
    </tr>
    </thead>
    <tbody>
        <?php
        while ($cols=mysqli_fetch_assoc($sel)) { ?>
        <tr>
            <td><?php echo $cols['username']; ?></td>
            <td><?php echo $cols['reg_no']; ?></td>
            <td><?php echo $cols['payment_type']; ?></td>
            <td><?php echo $cols['payment_mode']; ?></td>
            <td><?php echo "Ksh ". $cols['amount']; ?></td>
            <td><?php echo $cols['date_payed']; ?>, <?php echo $cols['time_payed']; ?></td>
            <td><?php echo $cols['valid_untill']; ?></td>
        </tr>
        <?php
        }

        ?>

    </tbody>
    </table>
            
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

<?php require('footer.php'); ?>
