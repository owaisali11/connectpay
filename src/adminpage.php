<?php
session_start();
$loggedUsername=$_SESSION["username"];
    require_once "config.php";
    $_SESSION['msg1']="";

    $username=$password=$email=$fname=$lname=$cnic=$phone=$position="";
    $username_error=$password_error=$email_error=$cnic_error=$phone_error=$position_error="";
    //ADD EMPLOYEES
      if(isset($_POST['submit_employee'])){
          //check if username empty
          if(empty(trim($_POST["username"]))){
            $_SESSION['msg1']="cannot be blank";
          }
          else{
              $sql="SELECT username FROM employees WHERE username=?";
              $stmt=mysqli_prepare($conn,$sql);
              if($stmt){
                  mysqli_stmt_bind_param($stmt,"s",$param_username);
  
                  //set the value of username
                  $param_username=trim($_POST['username']);
  
                  //execute
                  if(mysqli_stmt_execute($stmt)){
                      mysqli_stmt_store_result($stmt);
                      if(mysqli_stmt_num_rows($stmt)==1){
                        $_SESSION['msg1']="Sorry, Username already taken";
  
                      }
  
                      else {
                          $username=trim($_POST['username']);
                      }
                  }
  
                  else $_SESSION['msg1']= "Something went wrong";
              }
          }
          //mysqli_stmt_close($stmt);
      
         
          //check email
          if(empty(trim($_POST["email"]))){
            $_SESSION['msg1']="Email cannot be empty";
          }
          else{
              $sql="SELECT email FROM employees WHERE email=?";
              $stmt=mysqli_prepare($conn,$sql);
              if($stmt){
                  mysqli_stmt_bind_param($stmt,"s",$param_email);
  
                  //set the value of username
                  $param_email=trim($_POST['email']);
  
                  //execute
                  if(mysqli_stmt_execute($stmt)){
                      mysqli_stmt_store_result($stmt);
                      if(mysqli_stmt_num_rows($stmt)==1){
                        $_SESSION['msg1']="Sorry, Email already taken";
  
                      }
  
                      else {
                          $email=trim($_POST['email']);
                      }
                  }
  
                  else $_SESSION['msg1']="something went wrong";
              }
          }
         // mysqli_stmt_close($stmt);
      
  
          //check for cnic
          if(empty(trim($_POST["cnic"]))){
            $_SESSION['msg1']="cnic cannot be blank";
          }
          else{
              $sql="SELECT cnic FROM employees WHERE cnic=?";
              $stmt=mysqli_prepare($conn,$sql);
              if($stmt){
                  mysqli_stmt_bind_param($stmt,"s",$param_cnic);
  
                  //set the value of username
                  $param_cnic=trim($_POST['cnic']);
  
                  //execute
                  if(mysqli_stmt_execute($stmt)){
                      mysqli_stmt_store_result($stmt);
                      if(mysqli_stmt_num_rows($stmt)==1){
                        $_SESSION['msg1']="CNIC already taken";
  
                      }
  
                      else {
                          $cnic=trim($_POST['cnic']);
                      }
                  }
  
                  else $_SESSION['msg1']="something went wrong";
              }
          }
     //     mysqli_stmt_close($stmt);
      
          //check for phone no
          if(empty(trim($_POST["phone"]))){
            $_SESSION['msg1']="Phone number cannot be blank";
          }
          else{
              $sql="SELECT phone FROM employees WHERE phone=?";
              $stmt=mysqli_prepare($conn,$sql);
              if($stmt){
                  mysqli_stmt_bind_param($stmt,"s",$param_phone);
  
                  //set the value of username
                  $param_phone=trim($_POST['phone']);
  
                  //execute
                  if(mysqli_stmt_execute($stmt)){
                      mysqli_stmt_store_result($stmt);
                      if(mysqli_stmt_num_rows($stmt)==1){
                        $_SESSION['msg1']="phone number already taken";
  
                      }
  
                      else {
                          $phone=trim($_POST['phone']);
                      }
                  }
  
                  else $_SESSION['msg1']= "something went wrong";
              }
          }
      //    mysqli_stmt_close($stmt);
      
  
      //check for password
      if(empty([$_POST['password']])){
        $_SESSION['msg1']="password cannot be blank";
      }
      else if(strlen(trim($_POST['password'])) <5){
        $_SESSION['msg1']="Password cannot be less than 5 characters";
      }
      else{
          $password=trim($_POST['password']);
      }
    
      //insert in the database
      if(empty($username_error) && empty($password_error) && empty($cnic_error) && empty($phone_error) && empty($position_error) && empty($cnic_error)){
  
          $insertSql="INSERT  INTO employees VALUES(NULL,?,?,?,?,?,?,?,?,now())";
          // $accountSql="INSERT INTO accounts VALUES"
          $stmt=mysqli_prepare($conn,$insertSql);
          if($stmt){
              mysqli_stmt_bind_param($stmt,"ssssssss", $param_username, $param_passwords, $param_fname,$param_lname,$param_positon,$param_phone,$param_email,$param_cnic);
  
              $param_cnic=$cnic;
              $param_username=$username;
              $param_fname=$_POST['fname'];
              $param_lname=$_POST['lname'];
              $param_passwords=$password;
              $param_phone=$phone;
              $param_email=$email;
              $param_positon=$_POST['position'];
  
                if(mysqli_stmt_execute($stmt)){
                  //  header(" location: openAcc.php");
                echo "inserted";}
  
                 }
                // else echo "not inserted";
                
              
          }
          
          // mysqli_stmt_close($stmt);
      }

      //ADD A MANAGER
    if(isset($_POST['submit_manager'])){
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $branch_id = $_POST['branch_id'];
      $emp_id = $_POST['emp_id'];
  
      $check_branch_id = mysqli_query($conn, "SELECT branch_id FROM branches where branch_id = '$branch_id' ");
      $check_emp_id = mysqli_query($conn, "SELECT employee_id FROM employees where employee_id = '$emp_id' ");
      $num1 = mysqli_fetch_array($check_branch_id);
      $num2 = mysqli_fetch_array($check_emp_id);
  
      if($num1 != "" && $num2!="" ){
      $insert_new_manager = mysqli_query($conn,"INSERT into managers values(NULL,'$emp_id','$branch_id','$fname', '$lname')");
      $_SESSION['msg1'] = "Manager inserted";
      }
      else{
          $_SESSION['msg1'] = "employee or branch does not exists";
      }

}

//ADD BANK BRANCH
    if(isset($_POST['submit_add_branch'])){
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $branch_id = $_POST['branch_id'];
      
      $check_branch_id = mysqli_query($conn, "SELECT branch_id FROM branches where branch_id = '$branch_id' ");
      $num = mysqli_fetch_array($check_branch_id);
  
      if($num == "" ){
      $insert_new_manager = mysqli_query($conn,"INSERT into branches values('$branch_id','$phone', '$address')");
      $_SESSION['msg1'] = "Branch inserted";
      }
      else{
          $_SESSION['msg1'] = "Branch already exists";
      }

}

//UPDATE MANAGER
    if(isset($_POST['submit_updateManager'])){
      $up_fname = $_POST['fname'];
      $up_lname = $_POST['lname'];
      $up_branch_id = $_POST['branch_id'];
      $up_emp_id = $_POST['emp_id'];
   
      $check_branch_id = mysqli_query($conn, "SELECT branch_id FROM branches where branch_id = '$up_branch_id' ");
      $check_manager_id=mysqli_query($conn,"SELECT employee_id from managers where employee_id='$up_emp_id'");
      $num = mysqli_fetch_array($check_branch_id);
      $num2=mysqli_fetch_array($check_manager_id);
  
      if($num != ""  && $num2==""){
      $update_manager = mysqli_query($conn,"UPDATE managers set first_name = '$up_fname' ,last_name = '$up_lname', employee_id='$up_emp_id' where branch_id = '$up_branch_id' ");
      $_SESSION['msg1'] = "Manager updated";
      }
      else{
          $_SESSION['msg1'] = "Branch does not exists";
      }

}
//UPDATE BANK BRANCH
    if(isset($_POST['submit_update_branch'])){
      $address = $_POST['update_address'];
      $phone = $_POST['update_phone'];
      $branch_id = $_POST['branch_id'];
      
      $check_branch_id = mysqli_query($conn, "SELECT branch_id FROM branches where branch_id = '$branch_id' ");
      $num = mysqli_fetch_array($check_branch_id);
  
      if($num != "" ){
      $update_branch = mysqli_query($conn,"UPDATE branches set address = '$address' ,phone = '$phone' where branch_id = '$branch_id' ");
      $_SESSION['msg1'] = "Branch updated";
      }
      else{
          $_SESSION['msg1'] = "Branch does not exists";
      }

}
//DELETE MANAGER
if(isset($_POST['submit_deleteManager'])){
  $up_fname = $_POST['fname'];
  $up_lname = $_POST['lname'];
  $up_emp_id = $_POST['emp_id'];

  $check_employee_id=mysqli_query($conn,"SELECT employee_id from managers where employee_id='$up_emp_id'");
  $num2=mysqli_fetch_array($check_employee_id);

  if($num2!=""){
  $update_manager = mysqli_query($conn,"DELETE from managers where employee_id='$up_emp_id' ");
  $_SESSION['msg1'] = "Manager Deleted";
  }
  else{
      $_SESSION['msg1'] = "Manager does not exists";
  }

}

//UPDATE EMPLOYEE
if(isset($_POST['submit_updateEmployee'])){
  $emp_username = $_POST['emp_username'];
  $emp_position = $_POST['emp_position'];
  $emp_phone= $_POST['emp_phone'];
  $emp_email= $_POST['emp_email'];

  $check_employee_username=mysqli_query($conn,"SELECT username from employees where username='$emp_username'");
  $num2=mysqli_fetch_array($check_employee_username);

  if($num2!=""){
  $update_employee = mysqli_query($conn,"UPDATE employees SET position='$emp_position', phone='$emp_phone', email='$emp_email' where username='$username' ");
  $_SESSION['msg1'] = "Employee updated";
  }
  else{
      $_SESSION['msg1'] = "Employee does not exists";
  }
}

//DELETE EMPLOYEE
if(isset($_POST['submit_deleteEmployee'])){
  $emp_username = $_POST['emp_username'];
  $emp_password = $_POST['emp_password'];
  
  $check_employee_username=mysqli_query($conn,"SELECT username from employees where username='$emp_username' AND password='$emp_password'");
  $num2=mysqli_fetch_array($check_employee_username);

  if($num2!=""){
  $delete_employee = mysqli_query($conn,"DELETE FROM employees where username='$emp_username'; ");
  $_SESSION['msg1'] = "Employee deleted";
  }
  else{
      $_SESSION['msg1'] = "Employee does not exists";
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/adminpage.css" />
  <script defer src="../js/adminpage.js"></script>
  <script src="https://kit.fontawesome.com/37fa3fa880.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="errorShow  ">
<p style "background-color:green;" id="errorMessage"><?php echo $_SESSION['msg1'];?><?php $_SESSION['msg1'] = "";?></p>
<button class="btn--close-modal-closeMsg">&times;</button>
</div>
  <header class="header">
    <nav class="nav">

      <img src="../img/logo1.jpg" alt="Connectpay logo" class="nav__logo" id="logo" designer="Jonas"
        data-version-number="3.0" width="200" height="200" />
        
      <div class="centre">
        <h1>ADMIN DASHBOARD</h1>
        </div>
        <div class="logout">
    <a href="logoutAccount.php" id = "logoutAccount" class= "form__btn form__btn--close" ><h1>logout</h1></a> 
    </div>
        <!-- <ul class="nav__links">
          <li class="nav__item">
            <a class="nav__link" href="#section--1">About Us</a>
          </li>
          <li class="nav__item">
            <a class="nav__link" href="#section--2">Operations</a>
          </li>
          <li class="nav__item">
            <a class="nav__link" href="#section--2">Accounts</a>
          </li>
          <li class="nav__item">
            <a class="nav__link" href="#section--3">Loans</a>
          </li>
        </ul>
      </div>
      <div class="end">
        <ul class="nav__links">
          <li class="nav__item">
            <a class="nav__link  nav__link--btn btn--show-login-modal" href="#">Login</a>
          </li>
          <li class="nav__item">
            <a class="nav__link  nav__link--btn btn--show-account-modal" href="#">Open account</a>
          </li>
        </ul> -->
      </div>
      <!-- </nav> -->
  </header>
  <!-- <div class="balance">
      <div>
          <p class="balance__label">Current balance</p>
          <p class="balance__date">
              As of <span class="date">05/03/2037</span>
          </p>
      </div>
      <p class="balance__value">0000€</p>
  </div> -->
  <div class="admin_buttons">
  <div class="customer_options">
    <ul class="buttons">
      <li class="button_itemsManager" class="button_itemsManager">
        <a class="button_link button_link--btn btn--show-update-modal" href="">View Manager Details</a>
      </li>
      <li class="button_itemsViewCustomer">
        <a class="button_link button_link--btn btn--show-changePassword-modal" href="">View Customer Details</a>
      </li>
      <li class="button_itemsAddEmployees">
        <a class="button_link button_link--btn btn--show-addEmployees-modal" href="">Add Employees</a>
      </li>
    </ul>
  </div>
  <div class="container_options2">
    <ul class="buttons">
      
      <li class="button_itemsChangeManager">
        <a class="button_link button_link--btn btn--show-withdraw-modal" href="">Add Manager Details</a>
      </li>
      <li class="button_itemsAddBankBranch">
        <a class="button_link button_link--btn btn--show-submitCash-modal" href="">Add Bank Branch Details</a>
      </li>

      <li class="button_itemsUpdateBankBranch">
        <a class="button_link button_link--btn btn--show-submitBank-modal" href="">Update Bank Branch Details</a>
      </li>
    </ul>
  </div>
  <div class="container_options">
      <ul class="buttons">
        <li class="button_itemsUpdatemanager">
       
          <a class="button_link button_link--btn btn--show-updateManager-modal" href="">Update manager </details></a>
        </li>
        <li class="button_itemsDeleteManager">
          <a class="button_link button_link--btn btn--show-deleteManager-modal" href="">Delete Manager</a>
        </li>
  
        <li class="button_itemsUpdateEmployee">
          <a class="button_link button_link--btn btn--show-updateEmployee-modal" href="">Update Employee</a>
        </li>
      </ul>
    </div>

    <div class="container_options2">
      <ul class="buttons">
        <li class="button_itemsDeleteEmployee">
       
          <a class="button_link button_link--btn btn--show-deleteEmployee-modal" href="">Delete Employee</details></a>
        </li>
        <li class="button_itemsViewEmployee">
          <a class="button_link button_link--btn btn--show-viewEmployee-modal" href="">View Employee</a>
        </li>
       
        <li class="button_items">
<!--           <a class="button_link button_link--btn btn--show-viewEmployee-modal" href="">View Employee</a>
 -->        </li>
      </ul>
    </div>
    </div>
  <!-- update manager -->
  <div class="updateManager  hidden">
      <button class="btn--close-modal-updateManager">&times;</button>
      <h2 class="updateManager_modal2_header">
        Update Manager
      </h2>
      <form class="updateManager_modal_form" method="POST">
      <label>branch id</label>
      <input type="number" name="branch_id" required />
      <label>employee id</label>
      <input type="number" name="emp_id" required />
      <label>First name</label>
      <input type="text" name="fname"required />
      <label>Last name</label>
       <input type="text" name="lname"required />
       <input type="submit" class="btn" name="submit_updateManager"/>
      </form>
    </div>

<!-- Delete Manager -->

<div class="deleteManager  hidden" >
  <button class="btn--close-modal-deleteManager">&times;</button>
  <h2 class="deleteManager_modal2_header">
    Delete Manager
  </h2>
  <form class="deleteManager_modal_form" method="POST">
  <label>employee id</label>
      <input type="number" name="emp_id" required />
      <label>First name</label>
      <input type="text" name="fname"required />
      <label>Last name</label>
       <input type="text" name="lname"required />
       <input type="submit" class="btn" value="Delete" name="submit_deleteManager"/>
  </form>
</div>

<!-- update Empolyee -->

<div class="updateEmployee hidden">
  <button class="btn--close-modal-updateEmployee ">&times;</button>
  <h2 class="updateEmployee_modal2_header">
    Update Employee
  </h2>
  <form class="updateEmployee_modal_form" method="POST">
      <label>username</label>
      <input type="text" name="emp_username" required />
      <label>Position</label>
      <input type="text" name="emp_position"required />
      <label>phone number</label>
      <input type="number" name="emp_phone"required />
      <label>email</label>
      <input type="text" name="emp_email"required />
      <input type="submit" class="btn" value="Update" name="submit_updateEmployee"/>
  </form>
</div>

<!-- delete empoloyee -->

<div class="deleteEmployee  hidden">
  <button class="btn--close-modal-deleteEmployee ">&times;</button>
  <h2 class="deleteEmployee_modal2_header">
    Delete Employee
  </h2>
  <form class="deleteEmployee_modal_form" method="POST">
      <label>username</label>
      <input type="text" name="emp_username" required />
      <label>password</label>
      <input type="text" name="emp_password"required />
    
      <input type="submit" class="btn" value="Delete" name="submit_deleteEmployee"/>
  </form>
</div>
<!-- ADD MANAGER -->

<div class="AddManager  hidden">
  <button class="btn--close-modal-AddManager ">&times;</button>
  <h2 class="AddManager_modal2_header">
    Delete Employee
  </h2>
  <form class="deleteEmployee_modal_form" method="POST">
      <label>username</label>
      <input type="text" name="emp_username" required />
      <label>password</label>
      <input type="text" name="emp_password"required />
    
      <input type="submit" class="btn" value="Delete" name="submit_deleteEmployee"/>
  </form>
</div>

<!-- View Employee -->

<div class="viewEmployee  hidden">
  <button class="btn--close-modal-viewEmployee ">&times;</button>
  <h2 class="viewEmployee_modal2_header">
   View Employee Details
  </h2>
  <table cellpadding="1" cellspacing="1">
        <tr> <thead><td>employee_id</td><td>username</td><td>password</td><td>First_Name</td>
        <td>Last_name</td><td>position</td><td>phone</td><td>email</td><td>cnic</td><td>hiring_date</td></thead></tr>
        <tr>
        <?php
        $sql= "select * from employees";
        $result= mysqli_query($conn, $sql);
        //if ($result->num_rows>0){
        while ($rows=$result->fetch_assoc())
        {
         ?>
           
            <td><?php echo $rows['employee_id']; ?></td>
            <td><?php echo $rows['username']; ?></td>
            <td><?php echo $rows['password']; ?></td>
            <td><?php echo $rows['First_Name'] ?></td>
            <td><?php echo $rows['Last_Name'] ?></td>
            <td><?php echo $rows['position']; ?></td>
            <td><?php echo $rows['phone']; ?></td>
            <td><?php echo $rows['email']; ?></td>
            <td><?php echo $rows['cnic']; ?></td>
            <td><?php echo $rows['hiring_date'] ?></td>
        </tr>
        <?php
        } ?>

    </table>
</div>


<!-- view customer details -->

  <div class="change_password_modal2 hidden">
    <button class="btn--close-modal-change">&times;</button>
    <h2 class="change_password_modal2_header">
      Customer Details
    </h2>
    <table cellpadding="1" cellspacing="1">
        <tr> <thead><td>customer_id</td><td>username</td><td>passwords</td><td>first_name</td>
        <td>last_name</td><td>phone</td><td>email</td><td>acc_no</td><td>cnic</td><td>reg_date</td></thead></tr>
        <tr>
        <?php
        $sql= "select * from customers";
        $result= mysqli_query($conn, $sql);
        //if ($result->num_rows>0){
        while ($rows=$result->fetch_assoc())
        {
         ?>
           
            <td><?php echo $rows['customer_id'] ?></td>
            <td><?php echo $rows['username'] ?></td>
            <td><?php echo $rows['passwords'] ?></td>
            <td><?php echo $rows['first_name'] ?></td>
            <td><?php echo $rows['last_name'] ?></td>
            <td><?php echo $rows['phone'] ?></td>
            <td><?php echo $rows['email'] ?></td>
            <td><?php echo $rows['acc_no'] ?></td>
            <td><?php echo $rows['cnic'] ?></td>
            <td><?php echo $rows['reg_date'] ?></td>
        </tr>
        <?php
        } ?>

    </table>
   
  </div>


  <!-- ADD EMPLOYEES -->
  <div class="addEmployees hidden">
    <button class="btn--close-modal-addEmployees">&times;</button>
    <h2 class="addEmployees_modal2_header">
      Add Employees
    </h2>
    <form class="addEmployees_modal_form" method="POST">
    <label>First Name</label>
      <input type="text" required name="fname" />
      <label>Last Name</label>
      <input type="text" required name="lname"/>
      <label>Position</label>
      <input type="text" required name="position"/>
      <label>email</label>
      <input type="email" required name="email"/>
      
      <label>Phone Number</label>
      <input type="integer" required name="phone"/>
      <label>Username</label>
      <input type="text" required name="username"/>
      <label>Password</label>
      <input type="text" required name="password"/>
      <label>cnic</label>
      <input type="integer" required name="cnic"/>
      <input type="submit" class="btn" name="submit_employee"/>
  </div>
  <div class="transfer_money_modal hidden">
    <button class="btn--close-modal-transferMoney">&times;</button>
    <h2 class="TransferMoney_modal2_header">
      Add Employees
    </h2>
    <button class="btn">Transfer Money</button>
    </form>
  </div>

  <div class="withdraw_money_modal hidden">
    <button class="btn--close-modal-withdrawMoney">&times;</button>
    <h2 class="withdrawMoney_modal2_header">
      Add Manager Details
    </h2>
    <form class="withdrawMoney_modal_form" method="POST">
    <label>Employee id</label>
      <input type="number" name="emp_id" required />
      <label>First Name</label>
      <input type="text" name="fname" required />
      <label>Last Name</label>
      <input type="text" name="lname" required />
      <label>Branch_id</label>
      <input type="integer" name="branch_id" required />
      <input type="submit" name="submit_manager"class="btn"  />
    </form>
  </div>

  <div class="withdraw_successful hidden">

    <i class="fa-solid fa-square-check"></i>
    <h2 class="withdrawSuccesfull_modal2_header">
      Manager's info Updated Successfully
    </h2>
  </div>

  <div class="withdraw_unsuccessful hidden">
    <i class="fa-solid fa-square-check"></i>
    <h2 class="withdrawUnsuccesfull_modal2_header">
      Withdrawl request Unsuccessful
    </h2>
  </div>

  <div class="submitCash hidden">
    <button class="btn--close-modal-submitCash">&times;</button>
    <h2 class="submitCash_modal2_header">
      Add Bank Branch
    </h2>
    <form class="submitCash_modal_form" method="POST">
    <label>Address</label>
      <input type="text" name="address"  required />
      <label>Branch ID</label>
      <input type="integer" name="branch_id" required />
      <label>Phone No</label>
      <input type="integer" name="phone" required />
      <input type="submit" name="submit_add_branch"class="btn"  />
    </form>
  </div>


  <div class="submitBank hidden">
    <button class="btn--close-modal-submitBank">&times;</button>
    <h2 class="submitBank_modal2_header">
      Update Bank Branch
    </h2>
    <form class="submitBank_modal_form" method="POST">
    <label>Address</label>
      <input type="text" name="update_address" required />
      <label>Branch ID</label>
      <input type="integer" name="branch_id" required />
      <label>Phone No</label>
      <input type="integer" name="update_phone" required />
      <input type="submit" name="submit_update_branch"class="btn"  />
    </form>
  </div>

<!--  updateDetailsModal -->

  <div class="updateDetailsModal hidden">
    <button class="btn--close-modal-updateDetails">&times;</button>
    <h2 class="updateDetails_modal2_header">
       Manager Details
    </h2>
    <table   cellpadding="1" cellspacing="1">
        <tr> <thead><td>manager_id</td><td>employee_id</td><td>branch_id</td><td>first_name</td><td>last_name</td></thead></tr>
        <tr>
        <?php
        $sql= "select * from managers";
        $result= mysqli_query($conn, $sql);
        //if ($result->num_rows>0){
        while ($rows=$result->fetch_assoc())
        {
         ?>
           
            <td><?php echo $rows['manager_id'] ?></td>
            <td><?php echo $rows['employee_id'] ?></td>
            <td><?php echo $rows['branch_id'] ?></td>
            <td><?php echo $rows['first_name'] ?></td>
            <td><?php echo $rows['last_name'] ?></td>
        </tr>
        <?php
        } ?>

    </table>
    

  </div>

  <!-- MOVEMENTS -->
  <div class="movements hidden">
    <div class="movements__row">
      <div class="movements__type movements__type--deposit">2 deposit</div>
      <div class="movements__date">3 days ago</div>
      <div class="movements__value">4 000€</div>
    </div>
    <div class="movements__row">
      <div class="movements__type movements__type--withdrawal">
        1 withdrawal
      </div>
      <div class="movements__date">24/01/2037</div>
      <div class="movements__value">-378€</div>
    </div>
  </div>
  <div class="overlay hidden"></div>




</body>

</html>