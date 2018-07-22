<?php 
session_start();
// error_reporting(0);
if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="department") {
include 'connection.php';  
if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $sel=mysqli_query($link, "SELECT * FROM `intelligent_questions` WHERE `id`='$id'");
    $fetch=mysqli_fetch_assoc($sel);
}else {
    header("location: logout.php");
}
if (isset($_POST['update'])) {
    //get the data
    $unit_name = mysqli_real_escape_string($link, trim($_POST['unit_name']));
    $unit_code = mysqli_real_escape_string($link, trim($_POST['unit_code']));
    $question= $_POST['question']; 
    $answer= $_POST['answer'];
    $question_type= $_POST['question_type'];   
    $errors = "";

    //update
    $update=mysqli_query($link, "UPDATE `intelligent_questions` SET `unit_name`='$unit_name',`unit_code`='$unit_code',`question`='$question',`answer`='$answer',`question_type`='$question_type' WHERE `id`='$id'");
    
    if ($update) {
        $msg="Question(s) added successfully";
        $sel=mysqli_query($link, "SELECT * FROM `intelligent_questions` WHERE `id`='$id'");
        $fetch=mysqli_fetch_assoc($sel);
    }else {
        $errors="Something went wrong, please try again later.";

    }
}
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
            <a href="manage_intelligent_question.php">Manage Intelligent Question</a>
        </li>
        <li>
            <a href="#">Edit Intelligent Question</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Add Intelligent Question</h2>

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
                <form role="form" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" id="unit_name" name="unit_name" value="<?php echo $fetch['unit_name'] ?>" class="form-control" autocomplete="new-text" placeholder="Unit Name" required>
                        </div><br>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" id="unit_code" name="unit_code" value="<?php echo $fetch['unit_code'] ?>" class="form-control" autocomplete="new-text" placeholder="Unit Code" required>
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea id="question" name="question" class="form-control" rows="2" autocomplete="new-text" placeholder="Question" required><?php echo $fetch['question'] ?></textarea> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea id="answer" name="answer" class="form-control" rows="4" autocomplete="new-text" placeholder="Answer" required><?php echo $fetch['answer'] ?></textarea> 
                        </div>                    
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <select id="question_type" name="question_type" class="form-control show-tick" required>
                                <option value="<?php echo $fetch['question_type'] ?>"><?php echo $fetch['question_type'] ?></option>
                                <option value="Define">Define</option>
                                <option value="Explain">Explain</option>
                                <option value="Describe">Describe</option>
                                <option value="Advantages">Advantages</option>
                                <option value="Disadvantages">Disadvantages</option>
                                <option value="Advantages & Disadvantages">Advantages &amp; Disadvantages</option>
                                <option value="Difference">Difference</option>
                                <option value="Features">Features</option>
                                <option value="State">State</option>
                                <option value="Discuss">Discuss</option>
                                <option value="Outline">Outline</option>                          
                           </select>
                        </div>
                    </div>

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


