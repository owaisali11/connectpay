<?php
    require_once "config.php";

    $username=$password=$email=$fname=$lname=$cnic=$phone="";
    $username_error=$password_error=$email_error=$cnic_error=$phone_error="";
    
    $insertSql=FALSE;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        //check if username empty
        if(empty(trim($_POST["username"]))){
            $username_error="cannot be blank";
        }
        else{
            $sql="SELECT username FROM customers WHERE username=?";
            $stmt=mysqli_prepare($conn,$sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt,"s",$param_username);

                //set the value of username
                $param_username=trim($_POST['username']);

                //execute
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1){
                        $username_error="username already taken";

                    }

                    else {
                        $username=trim($_POST['username']);
                    }
                }

                else echo "something went wrong";
            }
        }
        //mysqli_stmt_close($stmt);
    

        //check email
        if(empty(trim($_POST["email"]))){
            $username_error="email cannot be blank";
        }
        else{
            $sql="SELECT email FROM customers WHERE email=?";
            $stmt=mysqli_prepare($conn,$sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt,"s",$param_email);

                //set the value of username
                $param_email=trim($_POST['email']);

                //execute
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1){
                        $email_error="email already taken";

                    }

                    else {
                        $email=trim($_POST['email']);
                    }
                }

                else echo "something went wrong";
            }
        }
       // mysqli_stmt_close($stmt);
    

        //check for cnic
        if(empty(trim($_POST["cnic"]))){
            $cnic_error="cnic cannot be blank";
        }
        else{
            $sql="SELECT cnic FROM customers WHERE cnic=?";
            $stmt=mysqli_prepare($conn,$sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt,"s",$param_cnic);

                //set the value of username
                $param_cnic=trim($_POST['cnic']);

                //execute
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1){
                        $cnic_error="cnic already taken";

                    }

                    else {
                        $cnic=trim($_POST['cnic']);
                    }
                }

                else echo "something went wrong";
            }
        }
   //     mysqli_stmt_close($stmt);
    
        //check for phone no
        if(empty(trim($_POST["phone"]))){
            $phone_no_error="phone number cannot be blank";
        }
        else{
            $sql="SELECT phone FROM customers WHERE phone=?";
            $stmt=mysqli_prepare($conn,$sql);
            if($stmt){
                mysqli_stmt_bind_param($stmt,"s",$param_phone);

                //set the value of username
                $param_phone=trim($_POST['phone']);

                //execute
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)==1){
                        $phone_error="phone number already taken";

                    }

                    else {
                        $phone=trim($_POST['phone']);
                    }
                }

                else echo "something went wrong";
            }
        }
        // mysqli_stmt_close($stmt);
    

    //check for password
    if(empty([$_POST['password']])){
        $password_error="password cannot be blank";
    }
    else if(strlen(trim($_POST['password'])) <5){
        $password_error="password cannot be less than 5 characters";
    }
    else{
        $password=trim($_POST['password']);
    }
  
    //insert in the database
    if(empty($username_error) && empty($password_error) && empty($cnic_error) && empty($phone_error)){

        $insertSql="INSERT  INTO customers VALUES(NULL,?,?,?,?,?,?,?,?,now())";
         $accountSql="INSERT INTO accounts VALUES(NULL,?,0)";
        $stmt=mysqli_prepare($conn,$insertSql);
        $stmt2=mysqli_prepare($conn,$accountSql);
        if($stmt){
            mysqli_stmt_bind_param($stmt,"ssssssss", $param_username, $param_passwords, $param_fname,$param_lname,$param_phone,$param_email,$param_phone,$param_cnic);
            mysqli_stmt_bind_param($stmt2,"s", $param_phone);

            $param_cnic=$cnic;
            $param_username=$username;
            $param_fname=$_POST['fname'];
            $param_lname=$_POST['lname'];
            $param_passwords=$password;
            $param_phone=$phone;
            $param_email=$email;

            if(mysqli_stmt_execute($stmt) && mysqli_stmt_execute($stmt2)){
               echo "inserted";}

            }
            else echo "not inserted";
            
            
        }
        
       mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);/*

    require_once "config.php";

    $insert = false;

    if(isset($_POST['btnId']))
    {
        $username= $_POST['username'];
        $password= $_POST['password'];
        $email= $_POST['email'];
        $fname= $_POST['fname'];
        $lname= $_POST['lname'];
        $cnic= $_POST['cnic'];
        $phone= $_POST['phone'];



        
        $sql = "INSERT INTO customers (`username`, `passwords`, `first_name`, `last_name`, `phone`, `email`,`acc_no`, `cnic`, `reg_date`) VALUES ('$username', '$password', '$fname', '$lname', '$phone', '$email','$phone', '$cnic', current_timestamp());";
        if($conn->query($sql) == true)
        {
            $sql1 = "INSERT INTO accounts (`acc_no`, `balance`) VALUES  ('$phone', 0)";
            if($conn->query($sql1) == true)
            {
                $insert = true;
            }
            else
            {
                echo "ERROR: $sql1 <br> $conn->error";
            }
        }
        else
        {
            echo "ERROR: $sql <br> $conn->error";
        }
    }*/
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" type="image/png" href="img/icon.png" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/homepage.css" />

    <title>Connectpay | When Banking meets Minimalist</title>

    <script defer src="../js/openAcc.js"></script>


</head>

<body>

</div>
<div  style="padding:20px">
<a href="../index.html">
<img src="../img/logo1.jpg" alt="Connectpay logo" class="nav__logo" id="logo" designer="Jonas"
                data-version-number="3.0" style="width:80px;" />
</a>
    <h2 class="modal__header">
        Open your bank account <br />
        in just <span class="highlight">5 minutes</span>
    </h2>
    <form class="modal__form" method="POST" action="">
        <label>First name</label>
        <input type="text" required name="fname" />
        <label>Last Name</label>
        <input type="text" required name="lname" />
        <label>Email Address</label>
        <input type="email"  name="email" id="email" />
        <label>CNIC</label>
        <input type="number" required name="cnic" id="cnic" />
        <label>username</label>
        <input type="text" required name="username" id="username" />
        <label>set password</label>
        <input type="text" required name="password" />
        <label>phone number</label>
        <input type="number" required name="phone" id="phone" />

        <input type="submit" class="btn" id="btnId" name="btnId">
        <?php
        if($insertSql == true){
        echo "<br><p><br/><h1>ACCOUNT CREATED</h1></p>";
        }
    ?>
        <button class="btn" id = "btnId" onClick="document.location.href='loginpage.php'">go to login</button>

         <!-- <p id = "successfully" >   </p> -->
    </form>

<!-- <script src="script.js"></script> -->
</body>