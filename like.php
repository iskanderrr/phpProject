<?php
// Database connection settings
$host = '66.94.119.136'; // Update as needed
$dbname = 'blockchain'; // Update as needed
$username = 'swix'; // Update as needed
$password = 'maynO/*69'; // Update as needed

// Start session to get the user ID
session_start();
$userID = $_SESSION['userID'] ?? null; // Adjust the key to match your session setup
$userID = 6967;
// Establish database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postID = $_POST['postID'] ?? null;

    if ($postID && $userID) {
        // Retrieve current likers' IDs for this post
        $stmt = $pdo->prepare('SELECT likersId FROM Posts WHERE postID = ?');
        $stmt->execute([$postID]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $existingLikers = $result['likersId'];
            $likersArray = $existingLikers ? explode(',', $existingLikers) : [];

            // Only add user if not already in the likers list
            if (!in_array($userID, $likersArray)) {
                $likersArray[] = $userID;
                $updatedLikers = implode(',', $likersArray);

                // Update the post with the new list of likers
                $updateStmt = $pdo->prepare('UPDATE Posts SET likersId = ? WHERE postID = ?');
                $updateStmt->execute([$updatedLikers, $postID]);

                echo "Successfully liked post with ID $postID.";
            } else {
                echo "You have already liked this post.";
            }
        } else {
            echo "Post not found.";
        }
    } else {
        echo "Invalid post ID or user not logged in.";
    }
}
?>
