 <?php
    // require_once __DIR__ . '/db.php';
    require_once 'db.php';

 ?>
 
 <section class="latest-news section-padding">
        <div class="container">
            <h2>Latest Blogs</h2>
        </div>
        <!-- End of .container -->

        <div class="news-slider common-slider">
            <div class="carousel-container equalHeightWrapper">
                <?php
                
                $stmt = $pdo->query("SELECT * FROM news WHERE status = 'published' ORDER BY created_at DESC");
                while ($row = $stmt->fetch()) {
                    $newsUrl = 'blog-details.php?id=' . $row['id'];
                    $shareUrl = urlencode('http://' . $_SERVER['HTTP_HOST'] . '/blog-details.php?id=' . $row['id']);
                    echo '<div class="item">';
                    
                    echo '<a href="' . $newsUrl . '" class="news-content-block content-block">';
                    echo '<div class="img-container">';
                    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Webon Blog Image" class="img-fluid">';
                    echo '</div>';
                    echo '<h5 class="equalHeight">';
                    echo '<span class="content-block__sub-title">' . date('j M, Y', strtotime($row['created_at'])) . '</span>';
                    echo htmlspecialchars($row['title']);
                    echo '</h5>';
                    echo '</a>';
                    // View count and share button
                    echo '<div style="margin-top:8px;">';
                    echo '<span class="badge bg-secondary">Views: ' . $row['views'] . '</span> ';
                    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $shareUrl . '" target="_blank" class="btn btn-sm btn-primary" style="margin-left:8px;">Share</a>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>