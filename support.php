<?php 

include 'db.php'; 


$msg = "";
if(isset($_POST['submit_query'])){
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO support_queries (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    if(mysqli_query($conn, $sql)){
        $msg = "✅ Your message has been sent. We will contact you soon!";
    } else {
        $msg = "❌ Something went wrong. Please try again.";
    }
}


include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Support - The Grocery</title>
    <link rel="stylesheet" href="style/support.css">
</head>
<body>

    <main class="container">
        <div class="support-container">
            <h2>How can we help? 🍎</h2>
            
            <?php if($msg != ""): ?>
                <div class="alert alert-success">
                    <?php echo $msg; ?>
                </div>
            <?php endif; ?>

            <form action="support.php" method="POST">
                <div class="form-group">
                    <label>Your Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="example@mail.com" required>
                </div>
                <div class="form-group">
                    <label>Subject</label>
                    <input type="text" name="subject" placeholder="What is this regarding?">
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" rows="5" placeholder="Write your message here..." required></textarea>
                </div>
                <button type="submit" name="submit_query" class="btn-submit">Send Message</button>
            </form>
        </div>
    </main>

    <footer class="glass-footer">
        <p>&copy; 2026 The Grocery - We are here for you 24/7</p>
    </footer>

</body>
</html>