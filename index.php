<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'expense_tracker';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $conn->real_escape_string($_POST['description']);
    $amount = $conn->real_escape_string($_POST['amount']);
    $date = $conn->real_escape_string($_POST['date']);
    $category = $conn->real_escape_string($_POST['category']);

    $sql = "INSERT INTO expenses (description, amount, date, category) VALUES ('$description', '$amount', '$date', '$category')";
    if ($conn->query($sql) === TRUE) {
        $message = "<div class='alert alert-success text-center'>Expense added successfully.</div>";
    } else {
        $message = "<div class='alert alert-danger text-center'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSpend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            overflow-x: hidden;
        }

        .main-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .left-panel {
            background-color: #1e1e1e;
            padding: 30px;
            width: 30%;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.5);
            position: fixed;
            height: 100%;
        }

        .right-panel {
            margin-left: 30%;
            padding: 20px;
            width: 70%;
            overflow-y: auto;
            height: 100vh;
        }

        .form-control,
        .btn {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #00b4d8;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0096c7;
        }

        .table {
            color: #ffffff;
        }

        .table th {
            background-color: #323232;
            color: #ffffff;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #2b2b2b;
        }

        .total-expense {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="left-panel">
            <div class="mb-3">
                <a class="btn btn-secondary" href="homepage.php">Back</a>
            </div>
            <h1 class="mb-4 text-center">Add Expense</h1>

            <form method="POST" action="index.php">
                <div class="mb-3">
                    <input type="text" class="form-control" name="description" placeholder="Description" required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="amount" step="0.01" placeholder="Amount" required>
                </div>
                <div class="mb-3">
                    <input type="date" class="form-control" name="date" required>
                </div>
                <div class="mb-3">
                    <select class="form-control" name="category" required>
                        <option value="" disabled selected>Choose Category</option>
                        <option value="Food">Food</option>
                        <option value="Transport">Transport</option>
                        <option value="Utilities">Utilities</option>
                        <option value="Entertainment">Entertainment</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Add Expense</button>
            </form>
            <br>
            <?php if (!empty($message)): ?>
                <?php echo $message; ?>
                <script>
                    setTimeout(function() {
                        var alert = document.querySelector('.alert');
                        if (alert) {
                            alert.style.transition = "opacity 1s ease-out";
                            alert.style.opacity = "0";
                            setTimeout(function() {
                                alert.remove();
                            }, 1000); 
                        }
                    }, 3000);
                </script>
            <?php endif; ?>
        </div>

        <div class="right-panel">
            <div class="mb-4">
                <form method="GET" action="index.php">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search expenses..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>

            <div class="total-expense">
                <?php
                $result = $conn->query("SELECT SUM(amount) AS total FROM expenses");
                $row = $result->fetch_assoc();
                echo "Total Expenses: Rs. " . number_format($row['total'], 2);
                ?>
            </div>

            <h2 class="mt-5 text-center">Expense List</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Amount (Rs.)</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include 'read_expenses.php'; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>