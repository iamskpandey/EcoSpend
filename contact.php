<?php
$host = 'localhost';
$dbname = 'expense_tracker';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$formSubmitted = false;
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            $formSubmitted = true;
        } else {
            $errorMessage = "Something went wrong. Please try again.";
        }
    } else {
        $errorMessage = "Please fill in all fields correctly.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EcoSpend</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .contact-section {
            background-color: #1c1c1c;
            color: #ffffff;
            padding: 50px 0;
        }

        .form-control,
        .btn {
            border-radius: 0;
        }
    </style>
</head>

<body class="bg-dark text-white">
    <?php include 'navbar.php'; ?>

    <section class="contact-section">
        <div class="container">
            <h1 class="text-center display-4 mb-5">Get in Touch</h1>

            <?php if ($formSubmitted): ?>
                <div class="alert alert-success text-center">Thank you for contacting us! We'll get back to you soon.</div>
            <?php elseif ($errorMessage): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($errorMessage); ?></div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="contact-info">
                        <h5>Contact Information</h5>
                        <hr>
                        <p><strong>Email:</strong> contact@expensetracker.com</p>
                        <p><strong>Phone:</strong> +91 123456789</p>
                        <p><strong>Address:</strong>Phagwara, Punjab, India</p>
                        <hr>
                        <h5>Follow Us</h5>
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</body>

</html>