<?php
session_start();
include("db.php");

// 🔐 Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: signindemo.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #494a4e0c, #545257);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .form-container:hover {
   transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus, textarea:focus {
            border-color: #764ba2;
            outline: none;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        label {
            font-weight: 500;
        }

        .rating {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin: 10px 0;
}

.rating label {
    cursor: pointer;
    font-size: 16px;
}
        .rating input {
            margin: 0 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(45deg, #ee0979,#9c27b0,#7b1fa2);
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 30px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }

        /* Error message */
        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }
        .back-link {
    display: inline-block;
    text-decoration: none;
    color: #9c27b0;
    font-weight: 500;
    transition: 0.3s;
}

.back-link:hover {
    color: #7b1fa2;
    text-decoration: underline;
}

        /* Responsive */
        @media (max-width: 480px) {
            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Give Feedback</h2>
   <?php if(isset($_SESSION['success'])): ?>
    <div id="successMsg" class="alert alert-success text-center">
        <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
        ?>
    </div>
<?php endif; ?>
    <form action="save_feedback.php" method="POST" onsubmit="return validateForm()">

       <input type="text" name="name" id="name" placeholder="Your Name" required>
        <div id="nameError" class="error"></div>

        <textarea name="message" id="message" placeholder="Your Feedback" required></textarea>
        <div id="messageError" class="error"></div>

        <label>Rating:</label>
        <div class="rating">
    <label><input type="radio" name="rating" value="1"> 1</label>
    <label><input type="radio" name="rating" value="2"> 2</label>
    <label><input type="radio" name="rating" value="3"> 3</label>
    <label><input type="radio" name="rating" value="4"> 4</label>
    <label><input type="radio" name="rating" value="5"> 5</label>
</div>
        <div id="ratingError" class="error"></div>

        <button type="submit">Submit</button>
        <div style="text-align:center; margin-top:15px;">
    <a href="dashboard.php" class="back-link">← Go Back</a>
</div>
    </form>
</div>

<script>
function validateForm() {
    let name = document.getElementById("name").value.trim();
    let message = document.getElementById("message").value.trim();
    let rating = document.querySelector('input[name="rating"]:checked');

    let valid = true;

    // Clear errors
    document.getElementById("nameError").innerText = "";
    document.getElementById("messageError").innerText = "";
    document.getElementById("ratingError").innerText = "";

    // Name validation (only letters)
    let namePattern = /^[A-Za-z ]+$/;
    if (!namePattern.test(name)) {
        document.getElementById("nameError").innerText = "Enter a valid name (letters only)";
        valid = false;
    }

    // Message validation (meaningful sentence check)
    let messagePattern = /^[A-Za-z0-9 ,.'!?]+$/;

    if (!messagePattern.test(message) || !message.includes(" ")) {
        document.getElementById("messageError").innerText = "Enter a meaningful sentence";
        valid = false;
    }


    // Rating validation
    if (!rating) {
        document.getElementById("ratingError").innerText = "Please select a rating";
        valid = false;
    }
         

    return valid;
}
</script>
<script>
setTimeout(function() {
    let msg = document.getElementById("successMsg");
    if (msg) {
        msg.style.display = "none";
    }
}, 3000);
</script>

</body>
</html>