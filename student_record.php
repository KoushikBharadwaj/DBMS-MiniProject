<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Information System</title>
<link rel="stylesheet" href="style.css">
<style>
    /* Basic styling for demonstration purposes */
    .error { color: red; }
</style>
</head>
<body>

<div class="form-container">
<h1>STUDENT INFORMATION SYSTEM</h1>

<!-- Form for adding/editing students -->
<form id="studentForm" action="process.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" required><br><br>
    <label for="contact_number">Contact Number:</label>
    <input type="text" id="contact_number" name="contact_number"><br><br>
    <label for="father_name">Father's Name:</label>
    <input type="text" id="father_name" name="father_name"><br><br>
    <label for="mother_name">Mother's Name:</label>
    <input type="text" id="mother_name" name="mother_name"><br><br>
    <label for="place_of_birth">Place of Birth:</label>
    <input type="text" id="place_of_birth" name="place_of_birth"><br><br>
    <label for="date_of_birth">Date of Birth:</label>
    <input type="date" id="date_of_birth" name="date_of_birth"><br><br>
    <input type="hidden" id="studentId" name="studentId">
    <input type="submit" name="submit" value="Add Student" id="submitButton">
    <input type="button" value="Clear Form" onclick="clearForm()">
</form>

<hr>

<!-- PHP code for database operations -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Display all students
// Display all students
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='students-list'>";
    echo "<h2>Students List:</h2>";
    echo "<table class='student-table'>";
    echo "<tr><th>Name</th><th>Email</th><th>Age</th><th>Contact Number</th><th>Father's Name</th><th>Mother's Name</th><th>Place of Birth</th><th>Date of Birth</th><th>Actions</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["age"] . " years old</td>";
        echo "<td>" . $row["contact_number"] . "</td>";
        echo "<td>" . $row["father_name"] . "</td>";
        echo "<td>" . $row["mother_name"] . "</td>";
        echo "<td>" . $row["place_of_birth"] . "</td>";
        echo "<td>" . $row["date_of_birth"] . "</td>";
        echo "<td><a href='process.php?delete=" . $row["id"] . "' class='delete-btn'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<div class='no-results'>No students found</div>";
}

$conn->close();
?>
</div>
<script>
    function clearForm() {
        document.getElementById("studentForm").reset();
    }
</script>

</body>
</html>
