<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli("localhost", "root", "9087", "training_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize messages
$sqli_message = "";
$xss_message = "";

// Combined Handling for SQL Injection and XSS
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_day']) && isset($_POST['birth_month']) && isset($_POST['birth_year'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name']; // XSS vulnerability target for first name
    $last_name = $_POST['last_name'];   // XSS vulnerability target for last name
    $birth_day = $_POST['birth_day'];
    $birth_month = $_POST['birth_month'];
    $birth_year = $_POST['birth_year'];

    // SQL Injection Handling
    // Remove simple WAF-like filtering to make it vulnerable
    // Blind SQL Injection vulnerability with a boolean-based challenge
    $sql = "SELECT * FROM users WHERE username = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $sqli_message = "SQLi: Valid user!";
    } else {
        sleep(2); // Introduce a delay for failed attempts
        $sqli_message = "SQLi: Invalid credentials.";
    }

    // XSS Handling for both first and last names
    $xss_message = "XSS: Welcome, " . $first_name . " " . $last_name . " born on " . $birth_day . " " . $birth_month . " " . $birth_year . "!";
}

// File Upload Handling
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Less secure: Bypassing proper checks for educational purposes
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<p>File Upload: The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.</p>";
    } else {
        echo "<p>File Upload: Sorry, there was an error uploading your file.</p>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Our Site</title>
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
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        select,
        input[type="file"] {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
            width: 100%;
        }
        input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .birthdate-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }
        .birthdate-group select {
            flex: 1;
        }
        .message {
            margin-top: 20px;
            text-align: center;
            color: #d9534f;
        }
        .password-container {
            position: relative;
        }
        .password-container input[type="password"] {
            width: calc(100% - 30px); /* Adjust for the icon space */
        }
        .password-container .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <script>
        function validateForm() {
            // Removed the field validation to allow empty fields
            return true;
        }

        function togglePasswordVisibility() {
            let passwordField = document.getElementById("password");
            let toggleIcon = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.textContent = "🙈";
            } else {
                passwordField.type = "password";
                toggleIcon.textContent = "👁️";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Site</h1>

        <!-- Combined Form for SQL Injection and XSS -->
        <h2>Sign In or Register</h2>

        <!-- XSS Input Fields First -->
        <form name="userForm" method="POST" action="" onsubmit="return validateForm();">
            <!-- First Name and Last Name for XSS -->
            <label for="first_name">Enter First Name:</label>
            <input type="text" id="first_name" name="first_name" placeholder="First Name"><br>
            <label for="last_name">Enter Last Name:</label>
            <input type="text" id="last_name" name="last_name" placeholder="Last Name"><br>

            <!-- Birth Date Fields -->
            <div class="birthdate-group">
                <select id="birth_day" name="birth_day">
                    <option value="">Day</option>
                    <?php for ($day = 1; $day <= 31; $day++): ?>
                        <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
                    <?php endfor; ?>
                </select>

                <select id="birth_month" name="birth_month">
                    <option value="">Month</option>
                    <?php
                    $months = [
                        'January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'
                    ];
                    foreach ($months as $month): ?>
                        <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                    <?php endforeach; ?>
                </select>

                <select id="birth_year" name="birth_year">
                    <option value="">Year</option>
                    <?php for ($year = 1900; $year <= date("Y"); $year++): ?>
                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Email and Password for SQLi -->
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Email Address"><br>
            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" id="password" name="password" placeholder="Password">
                <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
            </div><br>

            <input type="submit" value="Submit">
        </form>

        <!-- File Upload Section -->
        <form name="uploadForm" action="" method="POST" enctype="multipart/form-data">
            <label for="fileToUpload">Upload Your Picture:</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload File" name="submit">
        </form>

        <!-- Display messages -->
        <div class="message">
            <?php echo $sqli_message; ?><br>
            <?php echo $xss_message; ?>
        </div>
    </div>
</body>
</html>
