<?php
require_once 'includes/db.php';
$tag = $_GET['tag'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>   
    <?php include 'includes/head.php'; ?>
    <link rel="stylesheet" href="css/main.css">
</head>

<body >
    
    <div class="news-list" style="margin: 20px">
    <h6>See all News tagged: <span style="color: green; text-decoration: underline">
        <?php echo htmlspecialchars($tag);?></span></h6>
    
        <?php
        if ($tag) {
            $stmt = $pdo->prepare("SELECT * FROM news WHERE status = 'published' AND tags LIKE ?");
            $stmt->execute(['%' . $tag . '%']);
            while ($row = $stmt->fetch()) {
                echo '<div class="news-item">';
                echo '<a href="blog-details.php?id=' . $row['id'] . '">';
                echo '<h4>' . htmlspecialchars($row['title']) . '</h4>';
                echo '</a>';
                echo '<p>' . htmlspecialchars($row['content']) . '</p>';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-warning">No such tags yet! Check other tags.</div>';
        }
        ?>
    </div>

    <?php
        include 'includes/footer.php';
    ?>
</body>
</html>