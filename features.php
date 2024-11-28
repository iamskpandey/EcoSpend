<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - EcoSpend</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .feature-card {
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>

<body class="bg-dark text-white">
    <?php include 'navbar.php'; ?>

    <section class="py-5">
        <div class="container text-center">
            <h1 class="display-4 mb-5">Our Features</h1>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card feature-card bg-secondary text-white p-4 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Easy Expense Tracking</h5>
                            <hr>
                            <p class="card-text">Add your expenses in a few simple clicks and stay on top of your finances without hassle.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card bg-secondary text-white p-4 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Search Your Expenses</h5>
                            <hr>
                            <p class="card-text">You can easily search the expenses using the search bar by description of the expense like food, rent etc.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card bg-secondary text-white p-4 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Budget Management</h5>
                            <hr>
                            <p class="card-text">Set budgets and manage your money wisely.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <div class="card feature-card bg-secondary text-white p-4 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Secure and Private</h5>
                            <hr>
                            <p class="card-text">Your financial data is securely stored and remains private, ensuring peace of mind for all users.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card bg-secondary text-white p-4 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Mobile-Friendly</h5>
                            <hr>
                            <p class="card-text">Access your EcoSpend on the go with a fully responsive design optimized for mobile devices.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card bg-secondary text-white p-4 h-100">
                        <div class="card-body">
                            <h5 class="card-title">Customizable Categories</h5>
                            <hr>
                            <p class="card-text">Create and customize categories that suit your needs, making expense tracking tailored to your lifestyle.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>