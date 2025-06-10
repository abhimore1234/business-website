<?php
$servername = "localhost";
$username = "root";
$password = "DON@1234rocky";
$dbname = "customer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Contact Us form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form_type"]) && $_POST["form_type"] === "contact") {
    if (isset($_POST["name"], $_POST["email"], $_POST["message"])) {
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $message = $conn->real_escape_string($_POST["message"]);
        $sql = "INSERT INTO contact_us (name, email, message) VALUES ('$name', '$email', '$message')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Thank you for contacting us!');
                window.location.href = 'index.html';
            </script>";
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Handle Sign Up form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form_type"]) && $_POST["form_type"] === "signup") {
    if (isset($_POST["name"], $_POST["email"], $_POST["password"])) {
        $name = $conn->real_escape_string($_POST["name"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $sql = "INSERT INTO sign_up (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Sign up successful!');
                window.location.href = 'index.html';
            </script>";
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Handle Login form (use sign_up table)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["form_type"]) && $_POST["form_type"] === "login") {
    if (isset($_POST["email"], $_POST["password"])) {
        $email = $conn->real_escape_string($_POST["email"]);
        $password = $_POST["password"];
        $sql = "SELECT password FROM sign_up WHERE email='$email'";
        $result = $conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            if (password_verify($password, $row["password"])) {
                echo "<script>
                    alert('Login successful!');
                    window.location.href = 'index.html';
                </script>";
                exit;
            } else {
                echo "<script>alert('Invalid credentials.');window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Invalid credentials.');window.history.back();</script>";
        }
    }
}

$conn->close();
?>