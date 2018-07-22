<?php 
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="admin") {
    header("location: logout.php");
}
include 'connection.php';
    $sel=mysqli_query($link, "SELECT * FROM `students`");
?>
<?php require('admin_header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="admin_dash.php">Home</a>
        </li>
        <li>
            <a href="manage_pastpapers.php"> Total Members</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Members</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div><br>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Username</th>
        <th>Registration Number</th>
    </tr>
    </thead>
    <tbody>
    <?php
        while ($fetch=mysqli_fetch_assoc($sel)) { ?>
    <tr>
        <td><?php echo $fetch['username']; ?></td>
        <td><?php echo $fetch['reg_no']; ?></td>
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
    <!--/span-->
</div><!--/row-->
<?php require('footer.php'); ?>