<?php
include 'includes/db.php';
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
$conn->query($sql);
$conn->close();
header('Location: contact.php?success=true');
?>
