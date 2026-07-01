
<?php
include("db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['send']))
{
    $email = $_POST['email'];

    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check)>0)
    {
        $otp = rand(100000,999999);

mysqli_query($conn,"
UPDATE users
SET otp='$otp'
WHERE email='$email'
");

     $mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    $mail->Username   = 'your_email_id';
    $mail->Password   = 'your_app_password';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('your_mail_id', 'Complaint System');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset OTP';

    $mail->Body = "
        <h3>Password Reset Request</h3>
        <p>Your OTP is:</p>
        <h2>$otp</h2>
        <p>This OTP is valid for 5 minutes.</p>
    ";

    $mail->send();

    header("Location: verify-otp.php?email=$email");
    exit();

} catch (Exception $e) {

    echo "Mail Error: " . $mail->ErrorInfo;
}

    }
    else
    {
        echo "<script>alert('Email not found');</script>";
    }
}
?>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Same Theme Style -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #494a4e0c, #545257);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .update-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .update-card:hover {
            transform: translateY(-5px);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 2px solid #ddd;
            margin-bottom: 20px;
        }

        select:focus {
            border-color: #9c27b0;
            outline: none;
        }
        .form-control {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 16px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
}

.form-control:focus {
    border-color: #9c27b0;
    box-shadow: 0 0 0 0.2rem rgba(156, 39, 176, 0.15);
    background: white;
}

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(45deg, #9c27b0, #e91e63);
            color: white;
            font-weight: bold;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #9c27b0;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
    </head>
    <body>
        <div class="update-card">

<form method="post">
    <h3>Forgot Password</h3>

    <input type="email" name="email" placeholder="Enter Email" class="form-control" required><br><br>

    <button type="submit" name="send">
        Send OTP
    </button>
</form>
</div>
</body>
</html>