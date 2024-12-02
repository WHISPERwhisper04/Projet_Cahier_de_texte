<?php
$emailErrorMsg = "";
$passwordErrorMsg = "";

if (isset($_POST["submit"])) {
    $emailValue = $_POST["email"];
    $passwordValue = $_POST["password"];

    // Validate email and password
    if ($emailValue == "") {
        $emailErrorMsg = "Email must be filled out";
    } else if (preg_match("/\w+(@emsi.ma){1}$/", $emailValue) == 0) {
        $emailErrorMsg = "Please enter a valid EMSI email";
    } else if ($passwordValue == "") {
        $passwordErrorMsg = "Password must be filled out";
    } else {
        // Include the database connection
        include('connection.php');
        $connection = new Connection();
        $connection->selectDatabase('cahierDeTexte');
        
        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($connection->conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $emailValue); // Bind email parameter
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if the query was successful
        if (!$result) {
            die("Error executing query: " . mysqli_error($connection->conn));
        }

        // Check if a user was found
        if (mysqli_num_rows($result) == 1) {
            // Fetch user details
            $user = mysqli_fetch_assoc($result);

            // Verify the password using password_verify
            if (password_verify($passwordValue, $user['password'])) {
                // Start session and store user details in session
                session_start();
                $_SESSION["emailS"] = $emailValue;
                $_SESSION["roleS"] = $user['role']; // Store user role in session

                // Redirect based on user role
                if ($user['role'] == 'administrateur') {
                    header("Location: admin_dashboard.php"); // Admin dashboard
                    exit();
                } else if ($user['role'] == 'professeur') {
                    header("Location: prof_dashboard.php"); // Professor dashboard
                    exit();
                } else {
                    $emailErrorMsg = "Invalid user role.";
                }
            } else {
                $emailErrorMsg = "Invalid email or password.";
            }
        } else {
            $emailErrorMsg = "Invalid email or password.";
        }
    }
}
?>
