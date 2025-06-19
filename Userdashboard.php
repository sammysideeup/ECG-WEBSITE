<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Dashboard</title>
  <link rel="stylesheet" href="FrontPageStyle.css" />
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

  <div class="dashboard-container">
   
    <div class="sidebar">
      <h2><i class='bx bx-grid-alt'></i> Dashboard</h2>
      <a href="#"><i class='bx bx-home'></i> Home</a>
      <a href="#"><i class='bx bx-user'></i> Profile</a>
      <a href="#"><i class='bx bx-cog'></i> Settings</a>
      <a href="website.php" class="btn logout-btn"><i class='bx bx-log-out'></i> Logout</a>
    </div>


    <div class="main-content">
      <h1>Welcome, User!</h1>

      <div class="card">
        <h2>GYM NA IDOL</h2>
      </div>
      <div class="card">
        <h2>WAG PURO KANIN</h2>
      </div>
     

    </div>
  </div>

</body>
</html>
