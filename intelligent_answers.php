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
    $question=$_POST['question'];

    //put question into array
    $pieces = explode(" ", $question);
    $size=sizeof($pieces);//check size of array

    $q_type = array('defin','expla','descri','advantages','disadvantages','differe','feature','state','discuss','outline','what');//the question type words
    $new_q_type="";
    $errors="";


    for ($i=0; $i < $size; $i++) { 
    				
		if (strlen($pieces[$i])<=3) {
			// echo "Delete: $pieces[$i]<br>";
    		// array_splice($pieces, array_search($pieces[$i], $pieces ), 1);				

		   }else{
		   	//check for the question type and remove the question type from the array of question

		   	if (stripos($pieces[$i], $q_type[0]) !== false || stripos($pieces[$i], $q_type[10]) !== false) {
				$new_q_type="define";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);  
				break;
				//$i--;	
			}elseif (stripos($pieces[$i], $q_type[1]) !== false){
				$new_q_type="explain";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[2]) !== false){
				$new_q_type="describe";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[3]) !== false){
				$new_q_type="advantages";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[4]) !== false){
				$new_q_type="disadvantages";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[3]) !== false && stripos($pieces[$i], $q_type[4]) !== false){
				$new_q_type="advantages and disadvantages";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[5]) !== false){
				$new_q_type="difference";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[6]) !== false){
				$new_q_type="features";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[7]) !== false){
				$new_q_type="state";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[8]) !== false){
				$new_q_type="discuss";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;
			}elseif (stripos($pieces[$i], $q_type[9]) !== false){
				$new_q_type="outline";
				//remove the question type from question array	
				array_splice($pieces, array_search($pieces[$i], $pieces ), 1);
				break;
				//$i--;

			}else{
				// if (strlen($pieces[$i])<=3) {
					// $a_l=strlen($pieces[$i]);
					// echo "Delete: $pieces[$i] $a_l<br>";
		    		// array_splice($pieces, array_search($pieces[$i], $pieces ), 1);				

			   // }else{
			   	  // echo "Do not delete: $pieces[$i] $a_l<br>";

			   // }

				
		           
			   }
		

			}

		}

	$size=sizeof($pieces);
	//echo "New size: $size<br>";
	$j=0;

	//delete unnecessary words leaving only words with meaning
	if ($size<4) {
		$size=sizeof($pieces);
		do {
		if(strlen($pieces[$j])<4){
	           	   
	                 $a_l=strlen($pieces[$j]);
					 //echo "Delete: $pieces[$j], Length $a_l<br>";
					 array_splice($pieces, array_search($pieces[$j], $pieces ), 1);
					 //echo "array: $pieces[0],$pieces[1],$pieces[2]<br>";
					 $le=strlen($pieces[0]);
					 //echo "array len 1: $len<br>";
					 $size--;
	    } 
	   
	    $j++;
		} while ( $j < $size );
	}else{
		$size=sizeof($pieces);
		do {
		if(strlen($pieces[$j])<4){
	           	   
	                 $a_l=strlen($pieces[$j]);
					 echo "Delete: $pieces[$j], Length $a_l<br>";
					 array_splice($pieces, array_search($pieces[$j], $pieces ), 1);
					 echo "array: $pieces[0],$pieces[1],$pieces[2]<br>";
					 $le=strlen($pieces[0]);
					 //echo "array len 1: $len<br>";
					 //$size--;
	    } 
	   
	    $j++;
		} while ( $j < $size );

	}
	
    //construct the query satement 
	$size=sizeof($pieces);
	//echo "Final New size: $size<br>";
	if ($size==2) {
		for ($k=0; $k < ($size-1); $k++) { 
	    	if($k == 0){
	            $construct .="question LIKE '%$pieces[$k]%'";
	            $final_construct = $final_construct . ' ' . $construct; 
	            //echo "$pieces[$k] added<br>";  
	        }else{
	       	  $construct .=" OR question LIKE '%$pieces[$k]%'";
	          $final_construct = $final_construct . ' ' . $construct; 

	        }

	    }
	}else {
	    for ($k=0; $k < $size; $k++) { 
	    	if($k == 0){
	            $construct .="question LIKE '%$pieces[$k]%'";
	            $final_construct = $final_construct . ' ' . $construct; 
	            //echo "$pieces[$k] added<br>";  
		    }else{
		       	  $construct .=" OR question LIKE '%$pieces[$k]%'";
		          $final_construct = $final_construct . ' ' . $construct; 

		    }

		}
    }
	
    //if question type is not found, the question is probably invalid		
	if (empty($new_q_type)) {
		$errors="Your question seems to be not valid. Please write a valid question";
	}


    if (empty($errors)) {
		$sel_question=mysqli_query($link, "SELECT answer FROM intelligent_questions WHERE (question_type='$new_q_type') AND ($final_construct)"); 
		$count=mysqli_num_rows($sel_question);
		//echo "Final_query: SELECT answer FROM intelligent_questions WHERE (question_type='$new_q_type') AND $final_construct";
		
	}       
    
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
            <a href="#">Intelligent Answers</a>
        </li>
    </ul>
</div><div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Intelligent Answers</h2>

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
                    You might want to consider upgrading your account to access both questions and answers. Currently you can access questions only.
                  
            </div>
            <?php
            }
            ?>

            <?php
            if ($payment_status=="Expired") {                
            ?>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    You might want to consider renewing your account to access both questions and answers. Currently you can access questions only.
                  
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
                                <label for="unit_name"><h3>Your Question</h3></label>
                                <input type="text" id="question" name="question" class="form-control" autocomplete="off" autocomplete="new-text" placeholder="Question" required>
                            </div>                           
                        
                    </div>
                    &nbsp; &nbsp; <button type="submit" class="btn btn-default" name="search">Search</button>
                   </div>
                </form>  
                <br>      

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
                            

                <table class="table table-hover border-collapse">
                    
                    <tbody>
                        <?php
                         if (isset($_POST['search']) && empty($errors)) {
                         while ($fetch=mysqli_fetch_assoc($sel_question)) {
                           
                        ?>
                        <tr data-toggle="collapse" data-target="#accordion<?php echo $fetch['id']; ?>" class="clickable" style="cursor: pointer;">
                            <td>  &rArr; <?php echo $fetch['answer']; ?></td>
                        </tr>
                                                    
                        <?php  } 
                        
                            if (mysqli_num_rows($sel_question)==0) {
                                echo "We did not find any answers related to your question";
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




