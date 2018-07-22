<?php 
session_start();
error_reporting(0);
if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="department") {
include 'connection.php';
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $sel=mysqli_query($link, "SELECT * FROM `pastpapers` WHERE `id`='$id'");
    $fetch=mysqli_fetch_assoc($sel);
}
if (isset($_POST['update'])) {
    $department = $_POST['department'];
    $programme = $_POST['programme'];
    $unit_name = mysqli_real_escape_string($link, trim($_POST['unit_name']));
    $unit_code = mysqli_real_escape_string($link, trim($_POST['unit_code']));


        //if there are no errors, we proceed
        if (empty($errors)) {
                $update=mysqli_query($link, "UPDATE `pastpapers` SET `department`='$department',`programme`='$programme',`unit_name`='$unit_name',`unit_code`='$unit_code' WHERE id='$id'");
                if ($update) {
                    $msg="PastPaper updated successfully.";
                    $sel=mysqli_query($link, "SELECT * FROM `pastpapers` WHERE `id`='$id'");
                    $fetch=mysqli_fetch_assoc($sel);
                }else {
                    $errors="Something went wrong. Unable to add pastpaper. Try again later";
           
                }

        }
}
}else {
    header("location: logout.php");
}
?>
<?php require('admin_header.php'); ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="admin_dash.php">Home</a>
        </li>
        <li>
            <a href="manage_pastpapers.php"> Manage Pastpapers</a>
        </li>
        <li>
            <a href="edit_pastpapers.php"> Edit Pastpapers</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Update PastPaper</h2>

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
                <form role="form" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select id="department" name="department" class="form-control show-tick" required autofocus>
                            <option value="<?php echo $fetch['department']; ?>"><?php echo $fetch['department']; ?></option>
                            <option value="Architecture & Civil Engineering">Architecture &amp; Civil Engineering</option>
                            <option value="Biology">Biology</option>
                            <option value="Chemical Engineering">Chemical Engineering</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Economics">Economics</option>
                            <option value="Education">Education</option>
                            <option value="Electrical & Electronic Engineering">Electrical &amp; Electronic Engineering</option>
                            <option value="Foreign Languages Centre">Foreign Languages Centre</option>
                            <option value="Health">Health</option>
                            <option value="Mathematical Science">Mathematical Science</option>
                            <option value="Mechanical Engineering">Mechanical Engineering</option>
                            <option value="MN">Mechanical Engineering</option>
                            <option value="Natural Sciences">Natural Sciences</option>
                            <option value="Pharmacy & Pharmacology">Pharmacy &amp; Pharmacology</option>
                            <option value="Physics">Physics</option>
                            <option value="Politics, Languages &amp; International Studies">Politics, Languages &amp; International Studies</option>
                            <option value="Psychology">Psychology</option>
                            <option value="Social & Policy Sciences">Social &amp; Policy Sciences</option>
                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="programme">Programme</label>
                        <select id="programme" name="programme" class="form-control show-tick" required autofocus>
                            <option value="<?php echo $fetch['programme']; ?>"><?php echo $fetch['programme']; ?></option>
                            <option value="Phd">Phd</option>
                            <option value="Masters">Masters</option>
                            <option value="Degree">Degree</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Certificate">Certificate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_name">Unit Name</label>
                        <input type="text" id="unit_name" name="unit_name" value="<?php echo $fetch['unit_name']; ?>" class="form-control" autocomplete="new-text" placeholder="Unit Name" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_code">Unit Code</label>
                        <input type="text" id="unit_code" name="unit_code" value="<?php echo $fetch['unit_code']; ?>" class="form-control" autocomplete="new-text" placeholder="Unit Code" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleInputFile">Question file</label>
                        <input type="file" name="question" id="question" required>

                        <p class="help-block">Browse and choose the question pastpaper.</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Answer file</label>
                        <input type="file" name="answer" id="answer" required>

                        <p class="help-block">Browse and choose the answer pastpaper.</p>
                    </div> -->
                    <button type="submit" class="btn btn-default btn-lg" name="update">Update</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
    <!--/span-->
</div><!--/row-->
<?php require('footer.php'); ?>
