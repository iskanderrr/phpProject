<?php
$host = '66.94.119.136'; 
$dbname = 'blockchain'; 
$username = 'swix'; 
$password = 'maynO/*69'; 

session_start();
$userID = $_SESSION['userID'] ?? null; 
$userID = 6969;
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}


$postID = $_GET['postID'] ?? null;
$post = null;
$isLikedByUser = false;

if ($postID) {
    // Prepare and execute query to fetch the post data
    $stmt = $pdo->prepare('SELECT * FROM Posts WHERE postID = ?');
    $stmt->execute([$postID]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the current user has already liked this post
    if ($post && !empty($post['likersId']) && $userID) {
        $likersArray = explode(',', $post['likersId']);
        $isLikedByUser = in_array($userID, $likersArray);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Details</title>
    <style>
        .like-button {
            background-color: lightgray;
            color: black;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
        }

        .liked {
            background-color: blue;
            color: white;
        }
    </style>
    <script>
        // Function to handle like button click
        function likePost(postID) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'like.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Display response or update UI after liking post
                    alert(xhr.responseText);
                    location.reload(); // Reload page to reflect changes
                }
            };
            xhr.send('postId=' + encodeURIComponent(postID));
        }
    </script>
</head>
<body>
    <?php if ($post): ?>
        <h1><?php echo htmlspecialchars($post['postTitle'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($post['postText'], ENT_QUOTES, 'UTF-8')); ?></p>
        <?php if ($post['postFile']): ?>
            <a href="<?php echo htmlspecialchars($post['postFile'], ENT_QUOTES, 'UTF-8'); ?>" download>Download Attachment</a>
        <?php endif; ?>
        <button
            class="like-button <?php echo $isLikedByUser ? 'liked' : ''; ?>"
            onclick="likePost(<?php echo $post['postId'] ?>)">
            Like
        </button>
    <?php else: ?>
        <p>Post not found.</p>
    <?php endif; ?>
</body>
</html>
