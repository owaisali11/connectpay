<?php
    session_start();

    
    //check if user already logged in 
    if(isset($_SESSION['username'])){
        header("location: customerpage.php");
        exit;
    }
    
    
    require_once "config.php";
    $msg1 = " Invalid Username or Password ";

    
    $username=$password="";
    $username_error=$password_error="";
    $err="";
    //if request method is [post]
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
            $_SESSION['msg1']='please enter id password';
        }
        else {
            $username=trim($_POST['username']);
            $password=trim($_POST['password']);
        }

        if(empty($err)){
            $sql="SELECT username, passwords FROM customers WHERE username=? AND passwords=?";
            $stmt=mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($stmt,"ss", $param_username,$param_passwords);
            $param_username=$username;
            $param_passwords=$password;
            //execute the query
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1){
                    mysqli_stmt_bind_result($stmt,$username,$passwords);
                    if(mysqli_stmt_fetch($stmt)){
                        //password is correct so move on
                        session_start();
                        $_SESSION["username"]=$username;
                        
                        $_SESSION["loggedin"]=true;

                        //redirect user
                        header("location: customerpage.php");

                    }
                    else { 
                       echo $msg1 ;
                }
            }
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" type="image/png" href="img/icon.png" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/loginpage.css" />

    <title>Connectpay | When Banking meets Minimalist</title>

    <script defer src="../js/homepageScript.js"></script>
    <script defer src="../js/loginpage.js"></script>


</head>

<body>

<div  style="padding:20px">
<a href="../index.html">
<img src="../img/logo1.jpg" alt="Connectpay logo" class="nav__logo" id="logo" designer="Jonas"
                data-version-number="3.0" style="width:80px;" />
</a>
</div>

<div class="center">
        <h1>Login</h1>
        <form  class="modal__form" method= "post">
            <div class="txt_field">
                <input type="text" required name="username">
                <span></span>
                <label> Username</label>
            </div>
            <div class="txt_field">
                <input type="password" required name="password">
                <span></span>
                <label>Password</label>
            </div>

            <div class="errorShow  ">
            <p   id="errorMessage"><?php echo $msg1;?></p>
            <button class="btn--close-modal-closeMsg">&times;</button>
           
            </div>
            <div class="pass">Forget Password?</div>
            <input class = "submit" type="submit" value="login">
        </form>
    </div>
<!-- <h2 class="modal2__header"> Login </h2>
   <div class="errorShow  ">
        <p  id="errorMessage"><?php echo $msg1;?></p>
        <button class="btn--close-modal-closeMsg">&times;</button>
    </div>
    
    <form class="modal__form" method="POST">
   
        <label>username</label>
        <input type="text" required name="username" />
        <label>Password</label>
        <input type="text" required name="password" />
        <input class = "submit" type="submit" value = "Login" /> -->

<!--         <a class="nav__link nav__link--btn btn--show-login-modal" href="/customerpage">Login</a>
 -->        <!-- <button class="btn">Login </button> -->
   <!--  </form> -->
    
</body>