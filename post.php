<?php
// Database connection settings
$host = '66.94.119.136'; // Update as needed
$dbname = 'blockchain'; // Update as needed
$username = 'swix'; // Update as needed
$password = 'maynO/*69'; // Update as needed

// Establish database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $text = $_POST['text'] ?? '';
    $attachment = null;

    // Process file attachment if it exists
    if (!empty($_FILES['attachment']['name'])) {
        $targetDirectory = 'uploads/';
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }

        // Generate a unique name using timestamp and original extension
        $originalName = pathinfo($_FILES['attachment']['name'], PATHINFO_FILENAME);
        $extension = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
        $uniqueFileName = $originalName . '_' . uniqid() . '.' . $extension;
        $targetFile = $targetDirectory . $uniqueFileName;

        if (move_uploaded_file($_FILES['attachment']['tmp_name'], $targetFile)) {
            $attachment = $targetFile;
        }
    }

    // Prepare SQL insert statement
    $stmt = $pdo->prepare('INSERT INTO Posts (postTitle, postText, postFile, postTime) VALUES (?, ?, ?, NOW())');
    $stmt->execute([$title, $text, $attachment]);

    // Redirect to avoid resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Content</title>
</head>
<body>
    <h1>Create a New Post</h1>
    <form action="post.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br><br>
        
        <label for="text">Text:</label>
        <textarea name="text" id="text" rows="5" cols="30" required></textarea>
        <br><br>

        <label for="attachment">Attachment:</label>
        <input type="file" name="attachment" id="attachment">
        <br><br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
