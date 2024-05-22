<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    $con = new mysqli("localhost", "root", "", "dbparking");
    
    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM tb_parker WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if (!empty($data) && isset($data['pwd']) && $data['pwd'] === $pwd) {
                echo "<h2>Login successfully</h2>";
                header("Location: index.html");
            } else {
                Print '<script>alert("Invalid Email or Password!");</script>';
            }
        } else {
            echo "<h2>Invalid Email or Password</h2>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en"></html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <img src="parkubian_logo-removebg-preview.png" class="logo">
    <div class="wrapper">

        <form action="login.php" method="post">

            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="UBmail: " name="email" required>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password: " name="password" required>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#">Forgot password?</a>
            </div>
			
			
            <a><button type="submit" class="button">Login</a></button>
			

            <div class="register-link">
                <p>Have not registered yet? Click this to <a href="register.html">register</a></p>
            </div>

        </form>
    </div>
</body>

</html>
    



