<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $fullname, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert(Registration successful!);</script>";
    } else {
        echo "Error: " . $conn-> error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <link rel="stylesheet" href="Registerstyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    
 <div class="wrapper">
        <form action="">
            
            <h1>Register</h1>

            <div class="input-box">
                <input type="text" placeholder="Full Name" name = "fullname" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="email" placeholder="Email"  name = "email"required>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name = "password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Confirm Password" required>
                <i class='bx bxs-lock'></i>
            </div>

            <button type="submit" class="btn">Register</button>

            <div class="register-link">
                <p>Already have an account? <a href="Loginpage.php">Login</a></p>
                
            </div>
        </form>

    </div>

</body>
</html>