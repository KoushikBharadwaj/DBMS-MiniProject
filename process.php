<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission for adding new student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $contact_number = $_POST["contact_number"];
    $father_name = $_POST["father_name"];
    $mother_name = $_POST["mother_name"];
    $place_of_birth = $_POST["place_of_birth"];
    $date_of_birth = $_POST["date_of_birth"];

    // Add new student
    $sql = "INSERT INTO students 
                (name, email, age, contact_number, father_name, mother_name, place_of_birth, date_of_birth) 
            VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssss", $name, $email, $age, $contact_number, $father_name, $mother_name, $place_of_birth, $date_of_birth);

    // Execute prepared statement
    if ($stmt->execute()) {
        $stmt->close();
        echo "<script>alert('Record saved successfully');</script>"; // Display JavaScript alert
        echo "<script>window.location.href = 'student_record.php';</script>"; // Redirect after alert
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Delete student
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["delete"])) {
    $delete_id = $_GET["delete"];
    $delete_sql = "DELETE FROM students WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $stmt->close();
        echo "<script>alert('Student deleted successfully');</script>"; // Display JavaScript alert
        echo "<script>window.location.href = 'student_record.php';</script>"; // Redirect after alert
        exit(); // Make sure to exit to prevent further execution
    } else {
        echo "Error deleting student: " . $stmt->error;
    }
}
$conn->close();
?>
