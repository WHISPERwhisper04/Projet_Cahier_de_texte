<?php 
$errorMsg = "";
$firstnameValue = "";
$lastnameValue = "";
$emailValue = "";
$phoneValue = "";
$passwordValue = "";
$roleValue="";
$successMsg="";
if (isset($_POST['submit'])) {
    $firstnameValue = $_POST['firstname'];
    $lastnameValue = $_POST['lastname'];
    $emailValue = $_POST['emailname'];
    $phoneValue = $_POST['phonenumber'];
    $passwordValue = $_POST['passwordname'];
    $confirmPasswordValue = $_POST['confirmPassword'];
    $roleValue = $_POST['role']; 
    if (empty($firstnameValue) || empty($lastnameValue) || empty($emailValue) || empty($phoneValue) || empty($passwordValue) || empty($confirmPasswordValue)|| empty($roleValue)) {
        $errorMsg = "All fields are required!";
    }else if (preg_match("/\w+(@emsi.ma){1}$/", $emailValue) == 0) {
        $errorMsg = "Please enter a valid EMSI email";}
    else if(strlen($passwordValue)<8){
        $errorMsg = "Password must contain at least 8 characters!";
    }else if(preg_match('/[A-Z]+/',$passwordValue)==0){
        $errorMsg = "Password must contain at least one capital letter!";
    }elseif ($passwordValue !== $confirmPasswordValue) {
        $errorMsg = "Passwords do not match!";
    }else{
        //include connection file
        include('connection.php');
        //create an instance of class Connection
        $connection= new Connection();
        //call the selectDatabase method
        $connection->SelectDatabase('cahierDeTexte');
        //include the client file
        include('user.php');
        //create new instance of client class with the values of the inputs
        $user= new User($firstnameValue,$lastnameValue,$emailValue,$phoneValue,$passwordValue,$roleValue);
        //call the insertClient method
        $user->insertUser('user',$connection->conn);
        //give the $successMesage the value of the static $successMsg of the class
        $successMsg=User::$successMsg;
        //give the $errorMesage the value of the static $errorMsg of the class
        $errorMsg=User::$errorMsg;

}}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/SignUp.css">
    <title>Cahier de texte |Sign up</title>
</head>
<body>
    <div class="register">
        <form id="registeration-form" action="" method="post" >
            <h1>Registration</h1>
            <?php
            if(!empty($errorMsg)){
                echo "<span style='color:red'> $errorMsg </span>";
            }
            ?>
            <div class="input-box">
                <div class="input-field">
                <input value="<?php if (isset($firstnameValue)) echo $firstnameValue; ?>" type="text" placeholder="Firstname" id="firstName" name="firstname">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-field">
                    <input value="<?php if (isset($lastnameValue)) echo $lastnameValue; ?>" type="text" placeholder="Lastname"  id="lastname" name="lastname">
                    <i class='bx bxs-user'></i>
                </div>
            </div>
            <div class="input-box">
                <div  class="input-field">
                    <input value="<?php if (isset($emailValue)) echo $emailValue; ?>" type="email" placeholder="Email" id="email" name="emailname">
                    <i class='bx bxs-envelope'></i></div>
                <div  class="input-field">
                    <input value="<?php if (isset($phoneValue)) echo $phoneValue; ?>" type="number" placeholder="Phone number" id="phone" name="phonenumber">
                    <i class='bx bxs-phone'></i>
                </div>
            </div>
            <div class="input-box">
                <div  class="input-field">
                    <input name="passwordname" id="password" type="password" placeholder="password" >
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div   class="input-field">
                    <input name="confirmPassword" id="confirm_password" type="password" placeholder="Confirm password" >
                    <i class='bx bxs-lock-alt'></i>
                </div>
            </div>
            <div class="input-field">
                <select name="role" id="role">
                    <option value="">Sélectionnez votre rôle</option>
                    <option value="professeur">Professeur</option>
                    <option value="administrateur">Administrateur</option>
                </select>
            </div><br>
            <button type="submit" name="submit" class="btn">Register</button>
            <div class="login-link"><p>You already have an account ?<a href="Login.php">Sign in</a></p></div>
            <?php
            if(!empty($successMsg)){
                echo "<span style='color:rgba(255, 255, 255, .1)'> $successMsg </span>";
            }
            ?>
        </form>
    </div>
    
</body>
</html>
