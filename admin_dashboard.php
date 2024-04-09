<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, Admin!</h2>
        <a href="logout.php">Logout</a>

        <h3>Upload New Product:</h3>
        <form action="upload_product.php" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" required></textarea><br><br>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>
            
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required><br><br>
            
            <input type="submit" value="Upload Product">
        </form>

        <hr>

        <h3>Appointments:</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                    <th>Actions</th> <!-- New column for Edit button -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Establish database connection
                $conn = new mysqli("localhost", "root", "", "Mayiani");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM appointments";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $appointment_date = $row["appointment_date"];
                        $status_class = "";

                        // Determine appointment status based on date
                        if ($appointment_date < date("Y-m-d")) {
                            $status_class = "overdue";
                        } elseif ($appointment_date == date("Y-m-d")) {
                            $status_class = "today";
                        } else {
                            $status_class = "future";
                        }

                        echo '<tr class="' . $status_class . '">';
                        echo '<td>' . $row["name"] . '</td>';
                        echo '<td>' . $row["email"] . '</td>';
                        echo '<td>' . $row["phone"] . '</td>';
                        echo '<td>' . $appointment_date . '</td>';
                        echo '<td>' . ucfirst($status_class) . '</td>';
                        echo '<td><a href="edit_appointment.php?id=' . $row["id"] . '">Edit</a></td>'; // Edit button
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="6">No appointments found.</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
