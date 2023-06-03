<?php session_start();
$loggedUsername=$_SESSION["username"];?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="shortcut icon" type="image/png" href="/icon.png" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../css/customerpage.css" />
    <script defer src="../js/customerpage.js"></script>

    <title>Connectpay</title>
</head>

<body>

<?php require_once('config.php');

$_SESSION['msg1']='';
// transfer to

if(isset($_POST['submit_amount'])){
    $tran_to = $_POST['tran_to'];
    $amount = $_POST['amount'];
    $balance = ['balance'];

    $transferMoneyQuery = mysqli_query($conn, "SELECT acc_no,balance FROM accounts where acc_no = '$tran_to'");
    $checkBalanceQuery=mysqli_query($conn, "SELECT balance from accounts where acc_no=(select acc_no from customers where username='$loggedUsername');");

    $transferAcc = mysqli_fetch_array($transferMoneyQuery);
    $checkBalance= mysqli_fetch_array($checkBalanceQuery);
    

    if($transferAcc != "" && $amount < $checkBalance[0] ){

    $con = mysqli_query($conn,"UPDATE accounts set balance = '$amount'+balance where acc_no = '$tran_to' ");
    $con2= mysqli_query($conn,"UPDATE accounts set balance=balance-'$amount' where acc_no=(SELECT acc_no from customers where username='$loggedUsername');");
    
    $_SESSION['msg1'] = "Money Successfully Transfered";
    }
       
    else if ($amount>$checkBalance[0]){
        $_SESSION['msg1'] = "Sorry, Insufficient Balance";  
    }

    else $_SESSION['msg1']="wrong account number";
// transaction history table
        
    $queryy = mysqli_query($conn, "SELECT acc_no FROM customers where username = '$loggedUsername'");
    $numm = mysqli_fetch_array($queryy);

    $insertSql="INSERT  INTO `transaction` VALUES(NULL,'$numm[0]','$tran_to','$amount',current_timestamp())";
     
    mysqli_query($conn,$insertSql); 
    // else{
    //     echo "ERROR: Sorry $insertSql. "
    //         . mysqli_error($conn);
    // }
 
}

  // request loan

  if(isset($_POST['submit_loan'])){
    $loan_amount = $_POST['loan_amount'];
    
   
     $getAcc = mysqli_query($conn, "SELECT acc_no from customers where username='$loggedUsername'");
     $accForLoan=mysqli_fetch_array($getAcc);

     $checkBalanceQuery=mysqli_query($conn, "SELECT balance from accounts where acc_no=(select acc_no from customers where username='$loggedUsername');");

    $checkBalance = mysqli_fetch_array($checkBalanceQuery); 
  
   if($checkBalance  >= $loan_amount ){
    $insertLoan = mysqli_query($conn, "INSERT into loan values(NULL,'$accForLoan[0]','$loan_amount')");
    $updateAccount = mysqli_query($conn,"UPDATE accounts set balance = balance + '$loan_amount' ");
}  
        // $_SESSION['msg1'] = "Password change";
        // }
        else{
            $_SESSION['msg1'] = "not eligible for loans"; 
    }
        }

   // close account 
   if(isset($_POST['submit_closeAccount'])){
    $confirm_user = $_POST['confirm_user'];
    $confirm_pin = $_POST['confirm_pin'];
    

    $query3 = mysqli_query($conn, "SELECT acc_no, passwords FROM customers 
    where passwords = '$confirm_pin' and acc_no = '$confirm_user'");
    $num3 = mysqli_fetch_array($query3);

   if($num3 != "" ){
    // echo $num3[0];
    $con = mysqli_query($conn,"DELETE FROM customers WHERE 
    passwords = '$confirm_pin' and acc_no = '$confirm_user'");
    header("location: homepage.php");
//    $_SESSION['msg1'] = "Password change";
   }
   else{
       $_SESSION['msg1'] = "Incorrect username or password";
   }
  }

   // change password 
  if(isset($_POST['Submit'])){
    $opwd = $_POST['opwd'];
    $npwd = $_POST['npwd'];
    $cpwd = $_POST['cpwd'];

    $query = mysqli_query($conn, "SELECT passwords FROM customers where passwords = '$opwd'");
    $num = mysqli_fetch_array($query);

    if($num >0 && $npwd == $cpwd){
    $con = mysqli_query($conn,"UPDATE customers set passwords = '$npwd' where username='$loggedUsername' ");
    $_SESSION['msg1'] = "Password Succesfully changed";
    }
    else if($npwd!=$cpwd)
     $_SESSION['msg1']="passwords do not match";
    else{
        $_SESSION['msg1'] = "Old password is incorrect";
    }
  }
  // // Email

  if(isset($_POST['SubmitEmail'])){
    $currEmail = $_POST['currEmail'];
    $newEmail = $_POST['newEmail'];
    

    $checkoldEmail = mysqli_query($conn, "SELECT email FROM customers where email = '$currEmail' AND username='$loggedUsername'");
    $checkemail= mysqli_fetch_array($checkoldEmail);
   
    if($checkemail != "" ){
        $checknewEmail=mysqli_query($conn,"SELECT email FROM customers where email='$newEmail';");
        $check=mysqli_fetch_array($checknewEmail);
        
        if($check==""){
             $con = mysqli_query($conn,"UPDATE customers set email = ' $newEmail' where username='$loggedUsername';");
             $_SESSION['msg1'] = "Email Successfully changed";}

         else $_SESSION['msg1']="New Email entered is already in use";
    }
  
    else if($checkemail ==""){
        $_SESSION['msg1'] = "Old email is incorrect";
    } 
  }

  // change phone number 

  if(isset($_POST['SubmitPhoneNo'])){
    
    $currPhone = $_POST['currPhone'];
    $newPhone = $_POST['newPhone'];


    $query5 = mysqli_query($conn,"SELECT phone FROM customers where phone = '$currPhone' AND username='$loggedUsername'");
    $num5 = mysqli_fetch_array($query5);
    
    if($num5 != ""){

        $checknewPhone=mysqli_query($conn,"SELECT phone from customers where phone=$newPhone;");
        $checkPhone=mysqli_fetch_array($checknewPhone);

        if($checkPhone==""){
        $con = mysqli_query($conn, "UPDATE customers set phone = '$newPhone' where username='$loggedUsername'");
         $_SESSION['msg1'] = "Phone No Suucessfully change";}
        
        else if($checkPhone!="")
         $_SESSION['msg1']="Phone no already in use";
    }
    else{
         $_SESSION['msg1'] = "Phone No doesn't change"; 
    } 
    }
    // transaction history
?>
<div class="errorShow  ">
<p style "background-color:green;" id="errorMessage"><?php echo $_SESSION['msg1'];?><?php $_SESSION['msg1'] = "";?></p>
<button class="btn--close-modal-closeMsg">&times;</button>
</div>
    <!-- TOP NAVIGATION -->
    <!-- <nav>
        <p class="welcome">Log in to get started</p>
        <img src="logo.png" alt="Logo" class="logo" />
        <form class="login">
            <input type="text" placeholder="user" class="login__input login__input--user" />
            In practice, use type="password" -->
    <!-- <input type="text" placeholder="PIN" maxlength="4" class="login__input login__input--pin" />
            <button class="login__btn">&rarr;</button>
        </form>
    </nav> -->
    <div class="logout">
    <a href="logoutAccount.php" id = "logoutAccount" class= "form__btn form__btn--close" >logout</a> 
    <main class="app">
        <!-- BALANCE -->
        <div class="balance">
            <div>
                <p class="balance__label">Current balance</p>
                <p class="balance__date">
                    As of <span class="date">
                        <?php
                        $sql= "SELECT reg_date FROM customers WHERE acc_no=(SELECT acc_no FROM customers WHERE username='$loggedUsername ')";
                        $result= mysqli_query($conn, $sql);
                        while( $rows=$result->fetch_assoc()){
                           ?>
                           <?php echo $rows['reg_date'] ?>
                           <?php
                        }
                        ?>
                    </span>
                </p>
            </div>
            <p class="balance__value">$
            <?php 
            

             $sql= "SELECT balance FROM accounts WHERE acc_no=(SELECT acc_no FROM customers WHERE username='$loggedUsername ')";
             $result= mysqli_query($conn, $sql);
             while( $rows=$result->fetch_assoc()){
                ?>
                <?php echo $rows['balance'] ?>
                <?php
             }
             ?>
            </p>
        </div>

        <!-- MOVEMENTS -->
        <div class="movements">
      <!--   <h2 margin="0px auto" color="Black" >books Table</h2> -->
      <h2 margin="0px auto" color="Black" >Transaction History</h2>
        <table   cellpadding="1" cellspacing="1">
        <tr> <thead><td>acc_no</td><td>transfer_to</td><td>amount</td><td>date_time</td></thead></tr>
        
        <tr>
        <?php
        $sql= "select acc_no,transfer_to,amount,date_time from transaction";
        $result= mysqli_query($conn, $sql);
        //if ($result->num_rows>0){
        while ($rows=$result->fetch_assoc())
        {
         ?>
           
            <td><?php echo $rows['acc_no'] ?></td>
            <td><?php echo $rows['transfer_to'] ?></td>
            <td><?php echo $rows['amount'] ?></td>
            <td><?php echo $rows['date_time'] ?></td>
        </tr>
        <?php
        } ?>

    </table>
            <div class="movements__row">
                <!-- <div class="movements__type movements__type--deposit">2 deposit</div>
                <div class="movements__date">3 days ago</div>
                <div class="movements__value">4 000€</div> -->
            </div>
            <div class="movements__row">
                <!-- div class="movements__type movements__type--withdrawal">
                    1 withdrawal
                </div>
                <div class="movements__date">24/01/2037</div>
                <div class="movements__value">-378€</div>
                <br> -->
            </div>
        </div>

        <!-- SUMMARY -->
        <div class="summary">
            <p class="summary__label"></p>
            <p class="summary__value summary__value--in"></p>
            <p class="summary__label"></p>
            <p class="summary__value summary__value--out"></p>
            <p class="summary__label"></p>
            <p class="summary__value summary__value--interest"></p>
            <button class="btn--sort">&downarrow;</button>
        </div>

        <!-- OPERATION: TRANSFERS -->
        <div class="operation operation--transfer">
            <h2>Transfer money</h2>
            <form method = "post" name= "transfer_money" action = "" class="form form--transfer" onSubmit="return valid();">
                <input type="number" name ="tran_to" id ="tran_to" class="form__input form__input--to" />
                <input type="number" name ="amount" id ="amount" class="form__input form__input--amount" />
<!--                 <button  name = "submit_amount"  id= "submit_amount"  class="form__btn form__btn--transfer">&rarr;</button>
 -->           <input type="submit" name="submit_amount" id = "Submit" class= "Transferbtn" value="Transfer money"/>                
                <label class="form__label">Transfer to</label>
                <label class="form__label">Amount</label>
            </form>
        </div>

        <!-- OPERATION: LOAN -->
        <div class="operation operation--loan">
            <h2>Request loan</h2>
            <form method = "post" name = "loan" action = "" class="form form--loan" onSubmit="return valid();">
                <input type="number" name = "loan_amount" id = "loan_amount" class="form__input form__input--loan-amount" />
                
                <!-- <button class="form__btn form__btn--loan">&rarr;</button> -->
                <input type="submit" name="submit_loan" id = "submit_loan" class= "Loanbtn" value="Request loan"/> 
                <label class="form__label form__label--loan">Amount</label>
            </form>
        </div>

        <!-- OPERATION: CLOSE -->
        <div class="operation operation--close">
            <h2>Close account</h2>
            <form method = "post" name ="close" action = "" class="form form--close" onSubmit="return valid();">
                <input type="number" name = "confirm_user" id = "confirm_user" class="form__input form__input--user" />
                <input type="password" name= "confirm_pin" id = "confirm_pin" maxlength="6" class="form__input form__input--pin" />
                <input type="submit" name="submit_closeAccount" id = "submit_closeAccount" class= "Closebtn" value="close account"/> 
               <!--  <button class="form__btn form__btn--close">&rarr;</button> -->
                <label class="form__label">Confirm user</label>
                <label class="form__label">Confirm PIN</label>
            </form>
        </div>

        <!-- OPERATION: UPDATE DETAILS -->
        <div class="operation operation--updateDetails">
            <h2>Update personal details</details></h2>

                <ul class="buttons">
                  <li class="button_items">
                        <a class = "button_link button_link--btn btn--showChangepassword--modal" href="">Change password</a>
                  </li>
                  <li class="button_items">
                        <a class = "button_link button_link--btn btn--showEmail--modal" href="">Change Email</a>
                  </li>
                  <li class="button_items">
                    <a class = "button_link button_link--btn btn--showPhoneNumber--modal" href="">Change Phone No</a>
              </li>
                </ul>
            </div>
        <!-- LOGOUT TIMER
        <p class="logout-timer">
            You will be logged out in <span class="timer">05:00</span>
        </p> -->


        <!-- <footer>
      &copy; by Jonas Schmedtmann. Don't claim as your own :)
    </footer> -->

        <!-- <script src="script.js"></script> -->

       <!--  <div class="customer_options">
            <ul class="buttons">
                 <li class="button_items">
                    <a class="button_link button_link--btn btn--show-account-modal" href="">Sign up</a>
                </li> 
                <li class="button_items">
                    <a class="button_link button_link--btn btn--show-update-modal" href="">update personal details</a>
                </li>
                <li class="button_items">
                    <a class="button_link button_link--btn btn--show-changePassword-modal" href="">change password</a>
                </li>
                 <li class="button_items">
                    <a class="button_link button_link--btn btn--show-balance-modal" href="">Request loan</a>
                </li> 
            </ul>
        </div>
        <div class="container_options2">
            <ul class="buttons2"> -->
        
        <div class="change_password_modal2 hidden">
            <button class="btn--close-modal-change">&times;</button>
            <h2 class="change_password_modal2_header">
              Change password
            </h2>
            
            <form method="post" name= "chngpwd" class="change_password_modal_form" action = "" >
             <label>Old password</label>
             <input type="password" name= "opwd" id = "opwd"/>
             <label>New password</label>
             <input type="password" name="npwd" id = "npwd"  />
             <label>Confirm password</label>
             <input type="password" name="cpwd" id = "cpwd" />
             <input type="submit" name="Submit" id = "Submit" class= "btn1" value="change password"/> 
              
             </form>
        </div>
        <!-- Email -->

        <div class="changeEmail_modal2 hidden">
            <button class="btn--close-modal-Email">&times;</button>
            <h2 class="change_Email_modal2_header">
              Change Email
            </h2>
            <form method="post" name= "chngEmail" class="change_Email_modal_form" action = "" >
             <label>Current Email</label>
             <input type="text" name= "currEmail" id = "currEmail" required/>
             <label>New Email</label>
             <input type="text" name= "newEmail" id = "newEmail"required />
             <input type="submit" name="SubmitEmail" id = "Submit" class= "btn1" value="change Email"/>

            </form>
        </div>

        <!-- Change phone number -->

        <div class="changePhoneNumber_modal2 hidden">
            <button class="btn--close-modal-PhoneNumber">&times;</button>
            <h2 class="change_PhoneNumber_modal2_header">
              Change Phone number
            </h2>
            <form method="post" name= "chngPhoneNo" class="change_PhoneNumber_modal_form" action = " " onSubmit="return valid();">
             <label>Current Phone number</label>
             <input type="int" name= "currPhone" id = "currPhone"required/>
             <label>New Phone number</label>
             <input type="int" name= "newPhone" id = "newPhone"required/>
             <input type="submit" name="SubmitPhoneNo" id = "SubmitPhoneNo" class= "btn1" value="change Phone number"/>
            </form>
        </div>
        <div class="overlay hidden"></div>
    
    </main>
</body>
</html>