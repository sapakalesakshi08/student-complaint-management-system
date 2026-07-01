<?php
include("db.php");

$sql = "SELECT * FROM feedback ORDER BY id DESC LIMIT 6";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Management System</title>
    <link rel="stylesheet" href="hstyle.css">

    
</head>

<body>
    <div class="container">
        <div class="hero-section">
            <!-- Replace src with your image path -->
            <img src="images/img1.jpg" alt="Complaint Management System">

            <div class="hero-content">
                <h1>Complaint Management System</h1>
                <p class="subtitle">
                    Efficiently track, manage, and resolve all your complaints
                    with our comprehensive, user-friendly system.
                </p>
                <button onclick="window.location.href='regs.php'" class="hero-btn">
                   
                    <i class="bi bi-arrow-right-circle"></i>
                  Sign In
                
                </button>
            </div>
        </div>
              <!-- ABOUT SYSTEM -->
        <div class="about-section">
            <h2>About Our System</h2>
            <p>
                Our Student Complaint Management System is specially designed to help students easily raise their
                concerns
                related to academics, facilities, or any campus issues. It provides a simple and user-friendly platform
                where
                students can submit complaints without any hassle.
            </p>

            <p>
                The system allows students to track the status of their complaints and ensures that issues are addressed
                in a
                timely and transparent manner. It helps improve communication between students and the administration,
                leading
                to a better and more supportive learning environment.
            </p>
        </div>
        <!-- FEATURES SECTION -->
        <div class="features-section">

            <div class="feature-item">
                <i class="bi bi-pencil-square"></i>
                <h3>Submit Complaint</h3>
                <p>Easily register your complaint in just a few steps.</p>
            </div>

            <div class="feature-item">
                <i class="bi bi-search"></i>
                <h3>Track Complaint</h3>
                <p>Check the status of your complaint anytime.</p>
            </div>

            <div class="feature-item">
                <i class="bi bi-star-fill"></i>
                <h3>Give Feedback</h3>
                <p>Share your experience and help us improve.</p>
            </div>

        </div>
        <div class="feedback-display">
            <h2>User Feedback</h2>

            <div class="feedback-container">

                <?php while($row = $result->fetch_assoc()) { ?>

                <div class="feedback-card">
                    <h4>
                        <?php echo $row['name']; ?>
                    </h4>

                    <!-- Stars -->
                    <div class="stars">
                        <?php 
                        for($i=1; $i<=5; $i++){
                            if($i <= $row['rating']){
                                echo "★";
                            } else {
                                echo "☆";
                            }
                        }
                    ?>
                    </div>

                    <p>
                        <?php echo $row['message']; ?>
                    </p>
                </div>

                <?php } ?>

            </div>
            <div style="text-align:center; margin-top:20px;">
    <a href="all-feedback.php" class="show-more-link">Show More →</a>
</div>
            
        </div>
        <!-- footer section-->
     <footer class="footer">

    <!-- Quick Access Top -->
    <div class="quick-access">
        <h3>Quick Access</h3>
        <div class="quick-links">
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
            <a href="feedback.php">Feedback</a>
            <a href="regs.php">Register</a>
            <a href="signindemo.php">Sign In</a>
        </div>
    </div>

    <!-- Bottom Text -->
    <div class="footer-bottom">
        <p>© 2026 Complaint Management System | All Rights Reserved</p>
    </div>

</footer>
    </div>


    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<script>
function openModal() {
  document.getElementById("authModal").style.display = "block";
}

function closeModal() {
  document.getElementById("authModal").style.display = "none";
}

function showTab(tab) {
  document.querySelectorAll(".form-box").forEach(f => f.classList.remove("active"));
  document.querySelectorAll(".tab").forEach(t => t.classList.remove("active"));

  document.getElementById(tab).classList.add("active");
  event.target.classList.add("active");
}

function togglePassword(id) {
  let field = document.getElementById(id);
  field.type = (field.type === "password") ? "text" : "password";
}
</script>
</body>

</html>