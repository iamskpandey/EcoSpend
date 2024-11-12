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
    $featureRequest = trim($_POST['feature_request']);

    if (!empty($name) && !empty($email) && !empty($featureRequest) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "INSERT INTO feature_requests (name, email, feature_request) VALUES (:name, :email, :feature_request)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':feature_request', $featureRequest);

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
    <title>Feature Request - Expense Tracker</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .feature-request-section {
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

    <section class="feature-request-section">
        <div class="container">
            <h1 class="text-center display-4 mb-5">Request a Feature</h1>

            <?php if ($formSubmitted): ?>
                <div class="alert alert-success text-center">Thank you for your feature request! We appreciate your input.</div>
            <?php elseif ($errorMessage): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($errorMessage); ?></div>
            <?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-md-8">
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
                            <label for="feature_request" class="form-label">Feature Request</label>
                            <textarea class="form-control" id="feature_request" name="feature_request" rows="5" placeholder="Describe the feature you'd like to see" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>