<!--  BootstraB Code -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<div class="container" dir="ltr" style="text-align: left !important;">

<!-- CODE PHP Ya BASHA -->

<?php

// define variables and set to empty values
$FnameErr = $emailErr =  $passwordError =$SnameErr= "";
$fname = $email = $password = $lname =  "";
$councheck=0;

 if( $_SERVER['REQUEST_METHOD']=="POST" ){

  // Assign Variables to use the in the future and i will use trim function as built below instead of $_POST
  /*
  $fname=test_input($_POST['firstname']);
  $lname=test_input($_POST['lastname']);
  $email=test_input($_POST['email']);
  $password=test_input($_POST['password']) ;
  */
  
  if (empty($_POST["firstname"])) {
    $FnameErr = "First Name is required";
  } else {
    $fname = test_input($_POST["firstname"]);
    if(preg_match('/^(?=.{6,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/i',$fname)==FALSE){
      $FnameErr = "Please Enter charecters and digits Minimum 6 to 20, Don't Start or finish With _ or .  and Don't use _. inside";
      

    }
    else{
      $councheck++;
    }
  }
  if (empty($_POST["lastname"])) {
    $SnameErr = "Last Name is required";
  } else {
    $lname = test_input($_POST["lastname"]);
    if(preg_match('/^(?=.{6,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/i',$lname)==FALSE){
      $SnameErr = "Please Enter charecters and digits Minimum 6 to 20, Don't Start or finish With _ or .  and Don't use _. inside";

    }
    else{
      $councheck++;
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";

    }
    else{
      $councheck++;
    }
    
  }

  if (empty($_POST["password"])) {
    $passwordError = "Password Is required";
  } else {
    $password = test_input($_POST["password"]);
    if (preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/i',$password)==FALSE){
      $passwordError = " a minimum of 8 characters, at least one uppercase letter, at least one number (digit), at least one of the following special characters !@#$%^&*-";
      
      

    }
    else{
    $councheck++;
    }
  }

  
// Withdraw the data from Users and print them in the page as a show, you caan make them a comment
/*
  echo $_POST['firstname'] . "<br>";
  echo $_POST['lastname'] . "<br>";
  echo $_POST['email'] . "<br>";
  echo $_POST['password'] . "<br>"; 
  */
    // This code to connect to the data base and make a table to store data on it
 if (isset($_POST['submit']) and $councheck==4){
  $host = "localhost";
  $username = "root";
  $pass = "";
  $dp ="stp";
  $conn=  mysqli_connect($host, $username, $pass, $dp );
  $councheck=0;
  /* To test If the dataBase work? 
  if ($conn){
    echo "Yes";
  }else{
    echo "No";
  }
  */
// To take the data from the form and store them on the data base
  $insert = $conn->prepare("INSERT INTO stp_members (firstname,lastname,email,password) VALUES('$fname',  '$lname','$email','$password')");
  $insert->execute();
  
}
}
  // This code to delete the backslach from thr inputs data by using trim function
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strip_tags($data);
  
    return $data;
  }
  
/*
if(isset($_POST['submit'])){
  $checkEmail = $db->prepare("SELECT * FROM users WHERE EMAIL = :EMAIL");
  $email = $_POST['email'];
  $checkEmail->bindParam("EMAIL",$email);
  $checkEmail->execute();

  if($checkEmail->rowCount()>0){
      echo '<div class="alert alert-danger" role="alert">
      هذا حساب سابقا مستخدم
    </div>';
  }else{
      $name =$_POST['firstname'] ;
      $password =$_POST['password'] ;
      $email = $_POST['email'];

      $addUser = $database->prepare("INSERT INTO users(firstname,lastname,email,pasword)
       VALUES(:NAME,:AGE,:PASSWORD,:EMAIL)");
      $addUser->bindParam("firstname",$name);
      $addUser->bindParam("secondname",$age);
      $addUser->bindParam("email",$password);
      $addUser->bindParam("password",$email);
    }
  }
  */





?>

<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=email], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}



input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
span{
  color: red;
}
</style>
<body>


<h3>STP TASK</h3>

<div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="fname">First Name</label>
    <input type="text" id="firstname" name="firstname" placeholder="Your name.." value="<?php if (isset($fname)) {echo $fname;}?>">
    <span class="error">* <?php echo $FnameErr;?></span>
    <br>


    <label for="lname">Last Name</label>
    <input type="text" id="lastname" name="lastname" placeholder="Your last name.." value="<?php if (isset($lname)) {echo $lname;}?>">
    <span class="error">* <?php echo $SnameErr;?></span>
    <br>

    <label for="Email">Your Email</label>
    <input type="email" id="email" name="email" placeholder="Your Email.." value="<?php if (isset($email)) {echo $email;}?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br>

    <label for="Password">Your Password</label>
    <input type="password" id="password" name="password" placeholder="Your Password.." value="<?php if (isset($password)) {echo $password;}?>">
    <span class="error">* <?php echo $passwordError;?></span>
    <br>



    <input type="submit" value="Submit" name="submit">
  </form>
</div>




</body>
</html>


