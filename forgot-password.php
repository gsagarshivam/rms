
<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code for change password 
if(isset($_POST['change']))
    {
$newpassword=md5($_POST['newpassword']);
$empid=$_SESSION['empid'];

$con="update tblemployees set Password=:newpassword where id=:empid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':empid', $empid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}

?><!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ELMS | Password Recovery</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="logo.png">        

        	
        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
  <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
        
    </head>
    <body>
        <div class="loader-bg"></div>
        <div class="loader">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                    <div class="circle"></div>
                    </div><div class="circle-clipper right">
                    <div class="circle"></div>
                    </div>
                </div>

            </div>
        </div>

            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                    

                          <div class="col s12 m6 l8 offset-l2 offset-m3">
                              <div class="card white darken-1">

                                  <div class="card-content ">
                                      <span class="card-title" style="font-size:20px;">Employee Password Recovery</span>
                                         <?php if($msg){?><div class="succWrap"><strong>Success </strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                       <div class="row">
                                           <form class="col s12" name="signin" method="post">
                                               <div class="input-field col s12">
                                                   <input id="empid" type="text" name="empid" class="validate" autocomplete="off" required >
                                                   <label for="email">Employee Id</label>
                                               </div>
                                               <div class="input-field col s12">
                                                   <input id="password" type="text" class="validate" name="emailid" autocomplete="off" required>
                                                   <label for="password">Email id</label>
                                               </div>
                                               <div class="col s12 right-align m-t-sm">
                                                
                                                   <input type="submit" name="submit" value="Reset" class="waves-effect waves-light btn teal">
                                               </div>
                                               <a  class="passwordbtn" href="leave.php"><b>Back to Login</b></a>
                                           </form>
                                      </div>
                                  </div>
<?php if(isset($_POST['submit']))
{
$empid=$_POST['empid'];
$email=$_POST['emailid'];
$sql ="SELECT id FROM tblemployees WHERE EmailId=:email and EmpId=:empid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':empid', $empid, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach ($results as $result) {
    $_SESSION['empid']=$result->id;
  } 
    ?>

 <div class="row">
          <span class="card-title " style="font-size:20px; text-transform: uppercase;"><b>&nbsp;&nbsp;&nbsp;&nbsp;change your password</b> </span>                                     
    <form class="col s12" name="udatepwd" method="post">
  <div class="input-field col s12">
 <input id="password" type="password" name="newpassword" class="validate" autocomplete="off" required>
                                                <label for="password">New Password</label>
                                            </div>

<div class="input-field col s12">
<input id="password" type="password" name="confirmpassword" class="validate" autocomplete="off" required>
 <label for="password">Confirm Password</label>
</div>


<div class="input-field col s12">
<button type="submit" name="change" class="waves-effect waves-light btn indigo m-b-xs" onclick="return valid();">Change</button>

</div>
</div>
</form>
<?php } else{ ?>
<div class="errorWrap" style="margin-left: 2%; font-size:22px;">
 <strong>ERROR</strong> : <?php echo htmlentities("Invalid details");
}?></div>
<?php } ?>






                              </div>
                          </div>
                    </div>
                </div>
            </main>
            
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        
    </body>
        <style >
      .card.white.darken-1 {
        margin-left: 0px;
        width: 479px;
        height: 345px;
        margin-left: 300px; 
        margin-top: 80px;
      }
    @media only screen and (max-width: 600px){
      .card.white.darken-1 {
        margin-left: auto;
        width: auto;
        margin-left: auto; 
        margin-top: auto;
      }

      .card.white.darken-1 {
        margin-top: 50px;
      }
      .passwordbtn {
        background-color: #26a69a;
        color: #fff;
        margin-top: 10px;
        border: none;
        border-radius: 2px;
        display: inline-block;
        height: 36px;
        line-height: 36px;
        outline: 0;
        padding: 0 2rem;
        text-transform: uppercase;
        vertical-align: middle;
        -webkit-tap-highlight-color: transparent;
      }

    }
    .card.white.darken-1 {
        margin-left: 0px;
        width: 479px;
        height: auto;
        margin-left: 300px; 
        margin-top: 80px;}
    .passwordbtn{
      text-decoration: none;
      color: #fff;
      font-size: 13px;
      background-color: #26a69a;
      text-align: center;
      letter-spacing: .5px;
      transition: .2s ease-out;
      cursor: pointer;
      border: none;
      border-radius: 2px;
      display: inline-block;
      height: 36px;
      line-height: 36px;
      outline: 0;
      padding: 0 2rem;
      text-transform: uppercase;
      vertical-align: middle;
      -webkit-tap-highlight-color: transparent;

      }




    </style>
</html>