<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>

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

        .about-card {
            background: #fff;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 700px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .about-card:hover {
            transform: translateY(-5px);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            color: #555;
            font-size: 15px;
            line-height: 1.7;
        }

        .section {
            margin-top: 20px;
        }

        .highlight {
            color: #9c27b0;
            font-weight: 600;
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

<div class="about-card">

    <h2>About Us</h2>

    <p>
        Welcome to the <span class="highlight">Student Complaint Management System</span>.  
        This platform is designed to provide an easy, transparent, and efficient way for students to raise their concerns and track complaint status online.
    </p>

    <div class="section">
        <p>
            In traditional systems, complaints are often handled manually, which can lead to delays and lack of proper communication.  
            Our system solves this problem by allowing students to submit complaints digitally and receive updates in real-time.
        </p>
    </div>

    <div class="section">
        <p>
            Each complaint is automatically assigned to the respective department such as 
            <span class="highlight">Technical, Infrastructure, Canteen, Hygiene, Security, Hostel, Discipline, Transport, and Academic</span>.  
            This ensures faster resolution and proper handling of issues.
        </p>
    </div>

    <div class="section">
        <p>
            The system also allows staff members to manage complaints, update status, and monitor pending and resolved issues.  
            Admin users can oversee the entire system to ensure smooth functioning.
        </p>
    </div>

    <div class="section">
        <p>
            Our goal is to improve communication between students and college departments, enhance transparency, and provide a better campus experience for everyone.
        </p>
    </div>

    <a href="javascript:history.back()" class="back-link">← Go Back</a>

</div>

</body>
</html>