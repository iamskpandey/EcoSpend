<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'expense_tracker';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM expenses";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql .= " WHERE description LIKE '%$search%' OR category LIKE '%$search%'";
}

$sql .= " ORDER BY date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['description']) . "</td>
                <td>Rs. " . htmlspecialchars($row['amount']) . "</td>
                <td>" . htmlspecialchars($row['date']) . "</td>
                <td>" . htmlspecialchars($row['category']) . "</td>
                <td>
                    <a href='delete_expense.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5' class='text-center'>No expenses found.</td></tr>";
}

$conn->close();
