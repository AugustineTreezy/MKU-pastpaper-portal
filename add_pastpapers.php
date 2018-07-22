<?php 
session_start();
error_reporting(0);
if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="department") {
include 'connection.php';  
if (isset($_POST['add'])) {
    $department = $_POST['department'];
    $programme = $_POST['programme'];
    $unit_name = mysqli_real_escape_string($link, trim($_POST['unit_name']));
    $unit_code = mysqli_real_escape_string($link, trim($_POST['unit_code']));
    $question=$_FILES['question']['tmp_name'];
    $answer=$_FILES['answer']['tmp_name'];
    $errors = "";

    //renaming the files
    $new_count="";
    $check=mysqli_query($link, "SELECT unit_name FROM pastpapers WHERE unit_name='$unit_name'");
    if (mysqli_num_rows($check)>0) {
        $sel=mysqli_query($link, "SELECT id FROM pastpapers");
        $count=mysqli_num_rows($sel);
        $new_count=$count++;
    }    

    $question_file = explode(".", $_FILES["question"]["name"]);
    $new_question_name = "$unit_name" . "-qn$new_count" . "." . end($question_file);

    $answer_file = explode(".", $_FILES["answer"]["name"]);
    $new_answer_name = "$unit_name" . "-ans$new_count" . "." . end($answer_file);

        //if there are no errors, we proceed
        if (empty($errors)) {
            $folder="pastpapers/";
            $move_question_file=move_uploaded_file($question,$folder.$new_question_name);
            $move_answer_file=move_uploaded_file($answer,$folder.$new_answer_name);
            if ($move_question_file && $move_answer_file) {
                $ins=mysqli_query($link, "INSERT INTO `pastpapers`(`id`, `department`, `programme`, `unit_name`, `unit_code`, `question`, `answer`) VALUES ('','$department','$programme','$unit_name','$unit_code','$new_question_name','$new_answer_name')");
                if ($ins) {
                    $msg="PastPaper added successfully.";
                }else {
                    $errors="Something went wrong. Unable to add pastpaper. Try again later";
                }
            }else {
                $errors="Something went wrong. Try again later";
            }
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
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Add Pastpapers</a>
        </li>
    </ul>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Add a PastPaper</h2>

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
                            <option value="">-- Department where the pastpaper belongs --</option>
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
                            <option value="">-- Study level where the pastpaper belongs --</option>
                            <option value="Phd">Phd</option>
                            <option value="Masters">Masters</option>
                            <option value="Degree">Degree</option>
                            <option value="Diploma">Diploma</option>
                            <option value="Certificate">Certificate</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="unit_name">Unit Name</label>
                        <input type="text" id="unit_name" name="unit_name" class="form-control" autocomplete="new-text" placeholder="Unit Name" required>
                    </div>
                    <div class="form-group">
                        <label for="unit_code">Unit Code</label>
                        <input type="text" id="unit_code" name="unit_code" class="form-control" autocomplete="new-text" placeholder="Unit Code" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Question file</label>
                        <input type="file" name="question" id="question" required>

                        <p class="help-block">Browse and choose the question pastpaper.</p>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Answer file</label>
                        <input type="file" name="answer" id="answer" required>

                        <p class="help-block">Browse and choose the answer pastpaper.</p>
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
