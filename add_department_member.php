<?php 
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="admin") {
    header("location: logout.php");
}
include 'connection.php';
if (isset($_POST['add'])) {
    $email= $_POST['email'];
    $password = md5("123456");
    $errors = "";

    //check if email exists
    $check=mysqli_query($link, "SELECT `email` FROM `department` WHERE `email`='$email'");
    if (mysqli_num_rows($check)>0) {
        $errors = "The email address is alredy registered.";
    }

        //if there are no errors, we proceed
        if (empty($errors)) {
                $ins=mysqli_query($link, "INSERT INTO `department`(`id`, `email`, `password`) VALUES ('','$email','$password')");
                if ($ins) {
                    $msg="Member added successfully.";
                }else {
                    $errors="Something went wrong. Unable to add department member. Try again later";
                }
            
        }

    }
?>
<?php require('admin_header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Add Department Member</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Add Department Member</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
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
            <div class="box-content">
                <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    The default password for the department member will be <b>123456</b>
                  
                </div>
                <form role="form" method="post">
                    <div class="form-group">
                        <label for="unit_name">Email: </label>
                        <input type="email" id="email" name="email" class="form-control" autocomplete="new-text" placeholder="Email Address" required>
                    </div>
                    <button type="submit" class="btn btn-default btn-lg" name="add">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
    <!--/span-->
</div><!--/row-->
<?php require('footer.php'); ?>
