<?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $gender = $_POST['gender'];

    // Check if passwords match
    if ($password != $cpassword) {
        echo "<h2>Passwords do not match</h2>";
    } else {
        // Database connection
        $con = new mysqli("localhost", "root", "", "test");
        if ($con->connect_error) {
            die("Failed to connect : " . $con->connect_error);
        } else {
            // Prepare and execute the SQL statement to insert data into the table
            $stmt = $con->prepare("INSERT INTO registration (username, email, password, gender) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $password, $gender);
            $stmt->execute();

            // Check if data is inserted successfully
            if ($stmt->affected_rows > 0) {
                session_start();
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                $message = "Login created successfully";
                echo "<style>
                          #message {
                              background-color: #4CAF50;
                              color: white;
                              padding: 10px;
                              position: fixed;
                              top: 0;
                              width: 100%;
                              z-index: 9999;
                          }
                      </style>";
                echo "<div id='message'>$message</div>";
                echo "<script>setTimeout(function() { document.getElementById('message').style.display = 'none'; }, 3000);</script>";
                include("index.html");
            } else {
                echo "<h2>Error inserting data</h2>";
            }
            
        }            
    }
}
?>
