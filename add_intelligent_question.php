<?php 
session_start();
// error_reporting(0);
if ($_SESSION['user_type']=="admin" || $_SESSION['user_type']=="department") {
include 'connection.php';  
if (isset($_POST['add'])) {
    //get the data
    $unit_name = mysqli_real_escape_string($link, trim($_POST['unit_name']));
    $unit_code = mysqli_real_escape_string($link, trim($_POST['unit_code']));
    $question= $_POST['question'];
    $answer= $_POST['answer'];
    $question_type= $_POST['question_type'];
    $errors = "";
    //insert to database
    foreach( $question as $key => $value ) {
            $new_question=mysqli_real_escape_string($link, trim($value));
            $new_answer=mysqli_real_escape_string($link, trim($answer[$key]));
            $new_question_type=mysqli_real_escape_string($link, trim($question_type[$key]));
            $insert=mysqli_query($link, "INSERT INTO `intelligent_questions`(`id`, `unit_name`, `unit_code`, `question`, `answer`, `question_type`) VALUES ('','$unit_name','$unit_code','$new_question','$new_answer','$new_question_type')");
    }

    if ($insert) {
        $msg="Question(s) added successfully";
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
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Add Intelligent Question</a>
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
                            <input type="text" id="unit_name" name="unit_name" class="form-control" autocomplete="new-text" placeholder="Unit Name" required autofocus>
                        </div><br>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" id="unit_code" name="unit_code" class="form-control" autocomplete="new-text" placeholder="Unit Code" required>
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <textarea id="question" name="question[]" class="form-control" rows="2" autocomplete="new-text" placeholder="Question" required></textarea> 
                        </div> 
                        <div class="col-sm-2">
                            <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <textarea id="answer" name="answer[]" class="form-control" rows="4" autocomplete="new-text" placeholder="Answer" required></textarea> 
                        </div>                    
                    </div>
                                        
                    <div class="form-group">
                        <div class="col-sm-10">
                            <select id="question_type" name="question_type[]" class="form-control show-tick" required>
                                <option value="">-- Select the question type --</option>
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
                    <hr>
                    <div id="dynamic_field">
                        
                                            
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

<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "/addmore.php";
      var i=1;  


      $('#add').click(function(){  
           i++;  
           //append question
           $('#dynamic_field').append('<div id="row_question'+i+'" class="dynamic-added form-group"><div class="col-sm-10"><textarea name="question[]" placeholder="Question" rows="2" class="form-control name_list" required></textarea></div><div class="col-sm-2"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><span class="glyphicon glyphicon-trash"></span></button></div></div>');  
           //append answer
           $('#dynamic_field').append('<div id="row_answer'+i+'" class="dynamic-added form-group"><div class="col-sm-10"><textarea name="answer[]" placeholder="Answer" rows="4" class="form-control name_list" required></textarea></div></div>');  
           //append question_type
           $('#dynamic_field').append('<div id="row_question_type'+i+'" class="dynamic-added form-group"><div class="col-sm-10"><select id="question_type" name="question_type[]" class="form-control show-tick" required><option value="">-- Select the question type --</option><option value="Define">Define</option><option value="Explain">Explain</option><option value="Describe">Describe</option><option value="Advantages">Advantages</option><option value="Disadvantages">Disadvantages</option><option value="Advantages & Disadvantages">Advantages &amp; Disadvantages</option><option value="Difference">Difference</option><option value="Features">Features</option><option value="State">State</option><option value="Discuss">Discuss</option><option value="Outline">Outline</option></select> </div></div><hr id="line'+i+'">');  
      });


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_question'+button_id+'').remove();  
           $('#row_answer'+button_id+'').remove();
           $('#row_question_type'+button_id+'').remove();  
           $('#line'+button_id+'').remove(); 
      });  

      
    });  
</script>
