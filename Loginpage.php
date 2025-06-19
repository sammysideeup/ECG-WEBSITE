<?php

 include "connection.php";

$conn = new mysqli("localhost", "root", "", "ecg_fitness");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // You can also set a session here if needed
            header("Location: Loginpage.php");
            exit(); // Always use exit after header redirect
        } else {
            echo "<script>alert('Incorrect password');</script>";
        }
    } else {
        echo "<script>alert('Email not found');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginPage</title>
     <link rel="stylesheet" href="Loginstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<main>
    
<section>
<div class="wrapper"> 
        <form method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name = "email"
                required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" 
                placeholder="Password" name = "password" required>
                <i class='bx bxs-lock-alt' ></i>
            </div>

    <div class="remember-forgot">
        <label><input type="checkbox"> Remember me
        </label>
        <button><a href="Forgotpass.php">Forgot password?</button>  <!-- Forgot pass button-->
        
    </div>

    <form action="">
    <a href="website.php" class="back-icon"><i class='bx bx-arrow-back'></i></a>
</form>

    <button type="submit" class="btn" >Login</button>
    

    <div class="register-link">
        
        <button><a href="Register.php">Don't have account?</button> <!-- Register button -->
        
    </div>
    
    </form>
</section>   


</main>

</body>
</html>