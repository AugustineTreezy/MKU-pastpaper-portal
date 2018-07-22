<?php 
session_start();
error_reporting(0);
if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="department") {
include 'connection.php';
    if (isset($_GET['del'])) {
        $id=$_GET['del'];
        $del=mysqli_query($link,"DELETE FROM `intelligent_questions` WHERE `id`='$id'");
        if ($del) {
            $msg=" Deleated successfully";
            $sel=mysqli_query($link, "SELECT * FROM `intelligent_questions`");
        }else{
            $errors=" Something went wrong, please try again later";

        }
        
    }
    $sel=mysqli_query($link, "SELECT * FROM `intelligent_questions`");
}else {
    header("location: logout.php");
}
?>
<?php 
if ($_SESSION['user_type']=="admin") {
    require('admin_header.php');
}else{
    require('department_header.php');
}
 ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="admin_dash.php">Home</a>
        </li>
        <li>
            <a href="manage_intelligent_question.php"> Manage Intelligent questions</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Manage Intelligent questions</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div><br>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive table-hover">
    <thead>
    <tr>
        <th>Unit Name</th>
        <th>Unit Code</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php
        while ($fetch=mysqli_fetch_assoc($sel)) { ?>
    <tr>
        <td class="center"><?php echo mb_strimwidth($fetch['unit_name'], 0, 25, "..."); ?></td>
        <td class="center"><?php echo $fetch['unit_code']; ?></td>
        <td class="center"><?php echo mb_strimwidth($fetch['question'], 0, 50, "..."); ?></td>
        <td class="center"><?php echo mb_strimwidth($fetch['answer'], 0, 50, "..."); ?></td>
        <td class="center">
            <a class="btn btn-info" href="edit_intelligent_question.php?id=<?php echo $fetch['id'];?> ">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            <a class="btn btn-danger" href="manage_intelligent_question.php?del=<?php echo $fetch['id'];?>" onclick="return confirm('Are you sure you want to delete');">
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