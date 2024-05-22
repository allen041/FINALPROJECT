<?php
session_start();
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'dbparking';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $con = mysqli_connect($server, $user, $pass, $db);
} catch (Exception $ex) {
    echo 'Error';
}

if (isset($_POST['register_btn'])) {
    $dbFname = mysqli_real_escape_string($con, $_POST['fname']);
    $dbLname = mysqli_real_escape_string($con, $_POST['lname']);
    $dbpassword = mysqli_real_escape_string($con, $_POST['pwd']);
    $dbemail = mysqli_real_escape_string($con, $_POST['email']);

    $insert = "INSERT INTO tb_parker(fname, lname, pwd, email)
                VALUES ('$dbFname', '$dbLname', '$dbpassword', '$dbemail')";

    try {
        $insert_result = mysqli_query($con, $insert);

        if ($insert_result) {
            if (mysqli_affected_rows($con) > 0) {
                Print '<script>alert("Successful!");</script>';
            } else {
                echo 'Data not inserted!';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert' . $ex->getMessage();
    }
}
?>


<script>
    const form = document.getElementById('registration-form');
    form.addEventListener('submit', (e) => {
        const emailInput = document.getElementById('email');
        const emailValue = emailInput.value;
        const specificDomain = 'ub.edu.ph';

        if (!emailValue.endsWith('@' + specificDomain)) {
            alert('Only ' + specificDomain + ' email addresses are allowed');
            e.preventDefault();
        }
    });
</script>

</body>
</html>