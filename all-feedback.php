<?php
session_start();
include("db.php");





$result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            padding: 30px;
        }

        .feature-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(156, 39, 176, 0.2);
}
/* FEEDBACK DISPLAY */
.feedback-display {
    padding: 40px 20px;
    background: #f8f9ff;
    text-align: center;
}

.feedback-display h2 {
    margin-bottom: 25px;
    font-size: 28px;
}

/* CONTAINER */
.feedback-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

/* CARD */
.feedback-card {
    background: white;
    padding: 20px;
    width: 280px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transition: 0.3s;
}
.feedback-card:hover {
    transform: translateY(-5px);
}

/* NAME */
.feedback-card h4 {
    margin-bottom: 10px;
    color: #333;
}

/* STARS */
.stars {
    color: gold;
    font-size: 20px;
    margin-bottom: 10px;
}

/* MESSAGE */
.feedback-card p {
    font-size: 14px;
    color: #555;
}
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #9c27b0;
            font-weight: 500;
        }
    </style>
</head>

<body>

<a href="javascript:history.back()" class="back-link">← Go Back</a>

<div class="container">
    <div class="row">

        <?php while($row = $result->fetch_assoc()) { ?>

        <div class="col-md-4 mb-4"> <!-- 3 cards per row -->

            <div class="feedback-card">
                <h5><?php echo $row['name']; ?></h5>

                <div class="stars">
                    <?php 
                    for($i=1; $i<=5; $i++){
                        echo ($i <= $row['rating']) ? "★" : "☆";
                    }
                    ?>
                </div>

                <p><?php echo $row['message']; ?></p>
            </div>

        </div>

        <?php } ?>

    </div>
</div>

</body>
</html>