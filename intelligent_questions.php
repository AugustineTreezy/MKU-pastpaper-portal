<?php
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="student") {
    header("location: logout.php");
}
error_reporting(0);
require('student_header.php');
if (!isset($_SESSION['reg_no'])) {
    header("loacation: logout.php");
}
include 'connection.php';
if (isset($_POST['department'])) {
    $department=$_POST['department'];
    if ($department!=='') {        
        $sel=mysqli_query($link, "SELECT * FROM `pastpapers` WHERE `department`='$department'");

    }
}
if (isset($_POST['search'])) {
    $unit=$_POST['unit_name'];
    $keywords=$_POST['keywords'];
    $sel=mysqli_query($link, "SELECT * FROM `intelligent_questions` WHERE `question` LIKE '%$keywords%' AND `unit_name`='$unit' OR `unit_code`='$unit'");    
    
}
//fetch payment data for that specific student
$sel2=mysqli_query($link, "SELECT * FROM `payments` WHERE `user_reg_no`='$reg_no'");
$cols2=mysqli_fetch_assoc($sel2);
$date=date('m/d/Y');
//check payment status
if (mysqli_num_rows($sel2)==1) {
    if ($cols2['valid_untill']<=$date) {
        $payment_status="Expired";
    }else {
        $payment_status="Active";
    }
}else {
    $payment_status="Never paid";
} 
?>
<style>
#search-list{z-index:1000; float:left;list-style:none;margin-top:1px;padding:0;width:480px;position: absolute;box-shadow:  0 4px 8px 0 rgba(0,0,0,0.2);border-radius: 5px;}
#search-list li{padding: 10px; background: #fffff0; border-bottom: #bbb9b9 1px solid;}
#search-list li:hover{background:#ece3d2;cursor: pointer;}
</style>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="student_dash.php">Home</a>
        </li>
        <li>
            <a href="#">Intelligent Questions</a>
        </li>
    </ul>
</div><div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Intelligent Questions</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
            <?php
            if ($payment_status=="Never paid") {                
            ?>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    You might want to consider upgrading your account to access answers from intelligent questions and also to be able to use intelligent answers.
                  
            </div>
            <?php
            }
            ?>

            <?php
            if ($payment_status=="Expired") {                
            ?>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    You might want to consider renewing your account to access answers from intelligent questions.
                  
            </div>
            <?php
            }
            ?>                
                 <form role="form" method="post"> 
                    <div class="rows">
                    <div class="col-md-5">                   
                            <div class="form-group">
                                <label for="unit_name"><h3>Input unit name or code</h3></label>
                                <input type="text" id="unit_name" name="unit_name" class="form-control" autocomplete="off" autocomplete="new-text" placeholder="Unit Name or Unit code" required>
                                <div class="card" id="suggesstion-box"></div>
                            </div>
                            
                                                    
                    </div>
                    
                    <div class="col-md-7">                    
                            <div class="form-group">
                                <label for="unit_name"><h3>Keywords</h3></label>
                                <input type="text" id="keywords" name="keywords" class="form-control" autocomplete="off" autocomplete="new-text" placeholder="Question Keywords" required>
                            </div>                           
                        
                    </div>
                    &nbsp; &nbsp; <button type="submit" class="btn btn-default" name="search">Search</button>
                   </div>
                </form>  
                <br>                  
                            

                <table class="table table-hover border-collapse">
                    
                    <tbody>
                        <?php while ($fetch=mysqli_fetch_assoc($sel)) {
                           
                        ?>
                        <tr data-toggle="collapse" data-target="#accordion<?php echo $fetch['id']; ?>" class="clickable" style="cursor: pointer;">
                            <td <?php if ($payment_status=="Active") {?> data-toggle="tooltip" data-placement="left" title="Click to view answer"<?php } ?> >  &rArr; <?php echo $fetch['question']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <div id="accordion<?php echo $fetch['id']; ?>" class="collapse accordion">
                                <?php if ($payment_status=="Active") {
                                ?>
                                 <p>&nbsp; &nbsp; &nbsp; &bull; &nbsp;<?php echo $fetch['answer']; ?></p>
                                <?php }  ?>
                             </div>
                            </td>
                        </tr>
                            
                        <?php  } 
                        if (isset($_POST['search'])) {
                            if (mysqli_num_rows($sel)==0) {
                                echo "We did not find any questions related to your keywords";
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <ul class="pagination pagination-centered">
                        <li><a href="#">Prev</a></li>
                        <li class="active">
                            <a href="#">1</a>
                        </li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">Next</a></li>
                </ul>

            </div>


        </div>
    </div>
    <!--/span-->

</div>
    <!--/span-->
</div><!--/row-->
<?php require('footer.php'); ?>
<script>
$(document).ready(function(){
    $("#unit_name").keyup(function(){
        $.ajax({
        type: "POST",
        url: "ajax_search.php",
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            $("#search-box").css("background","#FFF url(img/LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#unit_name").css("background","#FFF");
        }
        });
    });
});

function selectsearch(val) {
$("#unit_name").val(val);
$("#suggesstion-box").hide();
}
</script>




