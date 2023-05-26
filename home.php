<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Diffusion</title>
  <link rel="stylesheet" href="home.css">
</head>
<body>
  <?php
  
    // database connection
    $con = new mysqli("localhost", "root", "", "test");

    // check connection
    if ($con->connect_error) {
      die("Failed to connect to database: " . $con->connect_error);
    }

    // get the email of the currently logged in user from the session
    $_SESSION['email'] = $email;

    // fetch the user's details from the database
    $stmt = $con->prepare("SELECT * FROM registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      // user found, display their details
      $user = $result->fetch_assoc();
      
    } else {
      // user not found, show error message
      echo "<h2>Invalid user</h2>";
    }
  ?>
    <div class="container">
      <div class="left">
        <h1 id="wel">Welcome &nbsp;<span><?php echo $user['username']; ?></span></h1>
        <p>We are a leading provider of high-quality products and services. Our mission is to deliver exceptional value to our customers and help them achieve their goals.</p>
        <p>At Company Name, we are committed to innovation, sustainability, and social responsibility. We believe that by working together, we can make a positive impact on the world.</p>
      </div>
      <div class="right">
        <img src="home.png" alt="Website Content Sections">
      </div>
      <div class="button-container">
      <a href="index.html" class="my-button">Log Out</a>
    </div>
    </div>
  </body>
</html>