
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['signin']))
{
$uname=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT EmailId,Password,Status,id FROM tblemployees WHERE EmailId=:uname and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':uname', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
 foreach ($results as $result) {
    $status=$result->Status;
    $_SESSION['eid']=$result->id;
  } 
if($status==0)
{
$msg="Your account is Inactive. Please contact admin";
} else{
$_SESSION['emplogin']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'leavehistory.php'; </script>";
} }

else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?><!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>ELMS | Home Page</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
             <link href="assets/css/materialdesign.css" rel="stylesheet">
        <link href="assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">      


        	
        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        <link rel="icon" type="image/png" href="logo.png">

        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        
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
        <div class="mn-content fixed-sidebar">
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title"><h4></h4></div>

                          <div class="col s12 m6 l8 offset-l2 offset-m3">
                              <div class="card white darken-1">

                                  <div class="card-content ">
                                      <span class="card-title" style="font-size:20px;">Employee Login</span>
                                         <?php if($msg){?><div class="errorWrap"><strong>Error</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                       <div class="row">
                                           <form class="col s12" name="signin" method="post">
                                               <div class="input-field col s12">
                                                   <input id="username" type="text" name="username" class="validate" autocomplete="off" required >
                                                   <label for="email">Email Id</label>
                                               </div>
                                               <div class="input-field col s12">
                                                   <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                   <label for="password">Password</label>
                                               </div>
                                               <div class="col s12 right-align m-t-sm">
                                                
                                                   <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn teal">

                                               </div>
                                               
                                                <a  class="passwordbtn" href="forgot-password.php"><b>forgot password</b></a>
                                                
                                           </form>
                                      </div>
                                  </div>
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
      .col.s12.m6.l8.offset-l2.offset-m3{
        margin-left: 0px;
        width: 500px;
        margin-left: 300px; 
        margin-top: 80px;
      }
    @media only screen and (max-width: 600px){
      .col.s12.m6.l8.offset-l2.offset-m3{
        margin-left: auto;
        width: auto;
        margin-left: auto; 
        margin-top: auto;
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
      .card.white.darken-1{
        margin-top: 50px;
      }

    }
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