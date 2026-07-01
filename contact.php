<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #494a4e0c, #545257);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .info-box {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            background: #f8f9ff;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .icon {
            font-size: 24px;
        }

        .info-text {
            font-size: 15px;
            color: #444;
        }

        .highlight {
            font-weight: 600;
            color: #9c27b0;
        }

        .emergency {
            background: #ffe5e5;
            border-left: 5px solid red;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #9c27b0;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="contact-card">

    <h2>Contact Us</h2>

    <!-- Address -->
    <div class="info-box">
        <div class="icon">📍</div>
        <div class="info-text">
            <span class="highlight">Address:</span><br>
            ABC College, Kolhapur, Maharashtra, India
        </div>
    </div>

    <!-- Phone -->
    <div class="info-box">
        <div class="icon">📞</div>
        <div class="info-text">
            <span class="highlight">Phone:</span><br>
            +91 98765 43210<br>
            +91 91234 56789
        </div>
    </div>

    <!-- Email -->
    <div class="info-box">
        <div class="icon">📧</div>
        <div class="info-text">
            <span class="highlight">Email:</span><br>
            support@abccollege.com<br>
            complaint@abccollege.com
        </div>
    </div>

    <!-- Office Hours -->
    <div class="info-box">
        <div class="icon">⏰</div>
        <div class="info-text">
            <span class="highlight">Office Hours:</span><br>
            Monday – Saturday: 9:00 AM – 5:00 PM
        </div>
    </div>

    <!-- Emergency -->
    <div class="info-box emergency">
        <div class="icon">🚨</div>
        <div class="info-text">
            <span class="highlight">Emergency Contact:</span><br>
            Security Office: +91 90000 11111<br>
            Hostel Warden: +91 90000 22222
        </div>
    </div>

    <!-- Back -->
    <a href="javascript:history.back()" class="back-link">← Go Back</a>

</div>

</body>
</html>