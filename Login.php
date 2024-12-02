<?php
session_start();
session_destroy();
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/Login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cahier de texte |Login</title>
</head>
<body>
    <div class="login1">
        <form action="" method="post">
            <h1>Login</h1>
            <div class="inputbox">
                <input  value="<?php if(isset($emailValue))echo $emailValue ?>" name="email" type="text" placeholder="Email" id="email">
                <i class='bx bxs-envelope'></i>
                <span style='color:red'><?php echo $emailErrorMsg ?></span>
            </div>
            <div class="inputbox">
                <input name="password" type="password" placeholder="password"  id="password">
                <i class='bx bxs-lock-alt'></i>
                <span style='color:red'><?php echo $passwordErrorMsg ?></span>
            </div>
            <div class="showpass">
                <label ><input type="checkbox" onclick="showPass()">show password</label>
            </div>
            <button name="submit" type="submit" class="btn">Login</button>
            <div class="register-link"><p>Don't have an account ?<a href="SignUp.php">Register</a></p></div>
        </form>
    </div>
    <script>
        function showPass(){
            var passInput=document.getElementById('password');
            if(passInput.type=='password'){
                passInput.type='text';
            }else if(passInput.type='text'){
                passInput.type='password';
            }
        }
        

    </script>
</body>
</html>