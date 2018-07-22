<?php 
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="admin") {
    header("location: logout.php");
}
include 'connection.php';
    if (isset($_GET['del'])) {
        $id=$_GET['del'];
        $del=mysqli_query($link,"DELETE FROM `department` WHERE `id`='$id'");
        if ($del) {
            $msg=" Deleated successfully";
            $sel=mysqli_query($link, "SELECT * FROM `department`");
        }else{
            $errors=" Something went wrong, please try again later";

        }
        
    }
    $sel=mysqli_query($link, "SELECT * FROM `department`");
?>
<?php require('admin_header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="admin_dash.php">Home</a>
        </li>
        <li>
            <a href="manage_pastpapers.php"> Manage Department Members</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Department Members</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div><br>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
        while ($fetch=mysqli_fetch_assoc($sel)) { ?>
    <tr>
        <td><?php echo $fetch['email']; ?></td>
        <td class="center">
            <a class="btn btn-danger" href="manage_department_members.php?del=<?php echo $fetch['id'];?>" onclick="return confirm('Are you sure you want to delete');">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>
        </td>
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