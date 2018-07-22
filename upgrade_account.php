<?php
session_start();
error_reporting(0);
if ($_SESSION['user_type']!=="student") {
    header("location: logout.php");
}
include 'connection.php';

?>
<style>
#search-list{z-index:1000; float:left;list-style:none;margin-top:1px;padding:0;width:480px;position: absolute;box-shadow:  0 4px 8px 0 rgba(0,0,0,0.2);border-radius: 5px;}
#search-list li{padding: 10px; background: #fffff0; border-bottom: #bbb9b9 1px solid;}
#search-list li:hover{background:#ece3d2;cursor: pointer;}
body{ 
    margin-top:40px; 
}

.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
</style>
<?php
 require('student_header.php');
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
}  ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="student_dash.php">Home</a>
        </li>
        <li>
            <a href="upgrade_account.php"> Upgrade Account</a>
        </li>
    </ul>
<?php
if ($payment_status=="Expired") {                
?>
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Upgrade your account to access both questions and answers of the past papers. Upgrade by choosing one of the packages below.          
</div>
<?php
}
?>

<?php
if ($payment_status=="Active") {                
?>
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        No need to upgrade, you already have an active package.       
</div>
<?php
}
?>

<?php
if ($payment_status=="Never paid") {                
?>
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Upgrade your account to access both questions and answers of the past papers. Upgrade by choosing one of the packages below.          
</div>
<?php
}
?>
</div><div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> MKU PastPapers Portal- Upgrade Account</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="container">
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Step 1</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Step 2</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Step 3</p>
        </div>
    </div>
</div>
<form role="form" method="post" action="payment_confirmation.php">
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Choose your payment package</h3>
                <div class="form-group">
                <div class="radio">
                    <label><input type="radio" name="type" value="1 month" required>1 Month @Ksh 199</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="type" value="3 months" required checked>3 Months @Ksh 499</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="type" value="6 months" required>6 Months @Ksh 799</label>
                </div>
                </div><br>
                <h3> Choose mode of payment</h3>
                <div class="form-group">
                <label class="radio-inline"><input type="radio" value="mpesa" name="mode" required checked>M-Pesa</label>
                <label class="radio-inline" data-toggle="tooltip" title="Paypal is not supported currently"><input type="radio" value="paypal" data-toggle="tooltip" title="Paypal is not supported currently" name="mode" required disabled>Paypal</label>
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Payment</h3>
                <p>1. Go to M-Pesa on your phone<br>
                   2. Select Payment Services<br>
                   3. Select Pay Bill option <br>
                   4. Enter Business number: <b>666444</b> <br>
                   5. Enter Account number: <b><?php echo substr(str_shuffle(MD5(microtime())), 0, 8);?></b><br>
                   6. Enter Amount: <b><span id="amount">499</span></b>
                </p><br>                
                <div class="form-group">
                    <label class="control-label">M-Pesa confirmation code</label>
                    <input maxlength="200" minlength="5" style="text-transform: uppercase;" name="mpesa_code" type="text" required="required" class="form-control" placeholder="Enter the M-Pesa confirmation code you received"  />
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button><br>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Complete</h3>
                <p>Click finish to complete your payment</p>
                <button class="btn btn-success btn-lg pull-right" name="submit" type="submit">Finish!</button>
            </div>
        </div>
    </div>
</form>
</div>     

            </div>


        </div>
    </div>
    <!--/span-->

</div>
    <!--/span-->
</div><!--/row-->
<?php require('footer.php'); ?>
<script type="text/javascript">
            $(document).ready(function () {

            var navListItems = $('div.setup-panel div a'),
                    allWells = $('.setup-content'),
                    allNextBtn = $('.nextBtn');

            allWells.hide();

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                        $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });

            allNextBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }

                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-primary').trigger('click');
        });
</script>
<script type="text/javascript">
         
    $(document).ready(function(){
        $('input[type=radio][name=type]').change(function() {
            if (this.value == '1 month') {
                $("#amount").text("199");
            }
            else if (this.value == '3 months') {
                $("#amount").text("499");
            }else {
                $("#amount").text("799");
            }
        });
     });
</script>
