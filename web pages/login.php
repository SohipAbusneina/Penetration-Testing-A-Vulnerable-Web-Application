<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
        }
        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
            font-size: 18px;
        }
        input[type="text"],
        input[type="password"] {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"] {
            padding: 15px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login">
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

       
        $conn = new mysqli('localhost', 'root', '9087', 'training_db');

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            
            if (isset($_POST['is_csrf']) && $_POST['is_csrf'] == '1') {
                echo "<script>alert('The attack was successful');</script>";
            } else {
                
                if (strpos($username, "'") !== false || strpos($password, "'") !== false) {
                    
                    echo "<h3>Fetched Users:</h3><ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>Username: " . $row['username'] . " - Password: " . $row['password'] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<script>alert('Login successful');</script>"; 
                }
            }
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
