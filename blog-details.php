<!DOCTYPE html>

<html class="no-js" lang="zxx">
<?php
    // Fetch news and prepare meta tags before including head
    require_once 'includes/db.php';
    $id = $_GET['id'] ?? null;
    $news = null;
    if ($id) {
        // Increment view count
        $pdo->prepare("UPDATE news SET views = views + 1 WHERE id = ?")->execute([$id]);
        // Fetch news
        $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ? AND status = 'published'");
        $stmt->execute([$id]);
        $news = $stmt->fetch();
    }

    // Default meta values
    $meta_title = isset($news['title']) ? $news['title'] : 'Webon Tech Hub || Best Website and App Development Services';
    $meta_description = isset($news['content']) ? substr(strip_tags($news['content']), 0, 160) : 'Webon Tech Hub || Best Website and App Development Services';
    $meta_image = isset($news['image']) && $news['image'] ? ('https://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($news['image'], '/')) : 'https://www.webontechhub.com/images/brand-logo.png';
    $meta_url = isset($id) ? ('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) : 'https://' . $_SERVER['HTTP_HOST'] . '/';

    include 'includes/head.php';
?>

<body class="body-bg-style-2 inner-page">
    <div class="page-wrapper">
        <svg class="bg-shape inner-page-shape-banner-right reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            width="779px" height="759px">
            <defs>
                <linearGradient id="PSgrad_01" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                </linearGradient>
            </defs>
            <path fill-rule="evenodd" fill="url(#PSgrad_01)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
            />
        </svg>

        <svg class="bg-shape inner-page-shape-banner-left reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
            width="779px" height="759px">
            <defs>
                <linearGradient id="PSgrad_09" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                </linearGradient>
            </defs>
            <path fill-rule="evenodd" fill="url(#PSgrad_09)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
            />
        </svg>

   
      <!-- blog-post-details starts -->
        <a href="#">
        <?php
        require_once 'includes/db.php';
        $id = $_GET['id'] ?? null;
        $news = null;
        if ($id) {
            // Increment view count
            $pdo->prepare("UPDATE news SET views = views + 1 WHERE id = ?")->execute([$id]);
            // Fetch news
            $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ? AND status = 'published'");
            $stmt->execute([$id]);
            $news = $stmt->fetch();
        }
        ?>
        <div class="blog-post-details">
            <div class="container">
                <svg class="bg-shape shape-blog-details reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="779px" height="759px">
                    <defs>
                        <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                            <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                            <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <path fill-rule="evenodd" fill="url(#PSgrad_03)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z" />
                </svg>
                <div class="row">
                    <div class="col-md-12">
                        <div class="article-wrapper">
                            <?php if ($news): ?>
                            <article class="blog-details">
                                <h2>
                                    <span><?php echo ucfirst($news['category']); ?> Category</span>
                                    <?php echo htmlspecialchars($news['title']); ?>
                                </h2>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="post-info">
                                            <a href="#">
                                                <i class="ml-fac-21-man-male-avatar-fac-e"></i>Admin</a>
                                            <a href="#">
                                                <i class="ml-tim-35-calander-date-schedule-clock-time-alarm-watch"></i><?php echo date('j M, Y', strtotime($news['created_at'])); ?></a>
                                            <span class="badge bg-secondary">Views: <?php echo (int)$news['views']; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <ul class="social-icons text-md-right">
                                            <li>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" rel="noopener">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" rel="noopener">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php if ($news['image']): ?>
                                <img src="<?php echo htmlspecialchars($news['image']); ?>" alt="Webon blog details image" class="img-fluid blog-details-img">
                                <?php endif; ?>
                                <div class="tags mb-2">
                                    <?php
                                    if (!empty($news['tags'])) {
                                        $tagsArr = array_map('trim', explode(',', $news['tags']));
                                        foreach ($tagsArr as $tag) {
                                            if ($tag) {
                                                echo '<a href="news_tag.php?tag=' . urlencode($tag) . '" class="badge bg-info text-dark me-1" style="text-decoration:none;">' . htmlspecialchars($tag) . '</a>';
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>
                            </article>
                            <?php else: ?>
                                <div class="alert alert-warning">News not found or not published.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
            // Get previous and next published news IDs
            $prevId = $nextId = null;
            if ($news) {
                // Previous
                $stmtPrev = $pdo->prepare("SELECT id FROM news WHERE id < ? AND status = 'published' ORDER BY id DESC LIMIT 1");
                $stmtPrev->execute([$news['id']]);
                $prevId = $stmtPrev->fetchColumn();
                // Next
                $stmtNext = $pdo->prepare("SELECT id FROM news WHERE id > ? AND status = 'published' ORDER BY id ASC LIMIT 1");
                $stmtNext->execute([$news['id']]);
                $nextId = $stmtNext->fetchColumn();
            }
            ?>
            <a href="<?php echo $prevId ? 'blog-details.php?id=' . $prevId : '#'; ?>" <?php if (!$prevId) echo 'class="disabled"'; ?>>
                <i class="ml-symone-67-arrow-left-right-up-down-increase-decrease"></i>Prev</a>
            <a href="<?php echo $nextId ? 'blog-details.php?id=' . $nextId : '#'; ?>" <?php if (!$nextId) echo 'class="disabled"'; ?>>Next
                <i class="ml-symone-68-arrow-left-right-up-down-increase-decrease"></i>
            </a>
        </div>
        <!-- End of .blog-details-prev-next -->
    </div>
    <!-- End of .article-wrapper -->
</div>
<!-- End of .col-md-12 -->
</div>
                <!-- End of .row -->
</div>
<!-- End of .container -->
</div>
        <!-- End of .blog-post-details -->

        <!-- !-- related-post starts
    =======================================  -->
        <section class="related-post blog-details-related-post section-padding">
            <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_033" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_033)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>

            <!-- Related Posts -->
            <div class="container">
                <div class="blog-by-category single-cat">
                    <h2 class="text-center">Related Posts</h2>
                    <div class="blog-grid text-center">
                        <div class="row equalHeightWrapper">
                            <?php
                            $related = [];
                            if ($news) {
                                // Find related by category and tags
                                $params = [$news['category'], $news['id']];
                                $tagSql = '';
                                if (!empty($news['tags'])) {
                                    $tagsArr = array_map('trim', explode(',', $news['tags']));
                                    $tagLike = [];
                                    foreach ($tagsArr as $tag) {
                                        $tagLike[] = "tags LIKE ?";
                                        $params[] = "%$tag%";
                                    }
                                    $tagSql = ' OR (' . implode(' OR ', $tagLike) . ')';
                                }
                                $sql = "SELECT * FROM news WHERE status = 'published' AND (category = ?$tagSql) AND id != ? ORDER BY created_at DESC LIMIT 3";
                                $stmtRel = $pdo->prepare($sql);
                                $stmtRel->execute($params);
                                $related = $stmtRel->fetchAll();
                            }
                            if ($related) {
                                foreach ($related as $rel) {
                                    echo '<div class="item col-md-6 col-lg-4">';
                                    echo '<a href="blog-details.php?id=' . $rel['id'] . '" class="news-content-block content-block">';
                                    echo '<div class="img-container">';
                                    echo '<img src="' . htmlspecialchars($rel['image']) . '" alt="Project image" class="img-fluid">';
                                    echo '</div>';
                                    echo '<h5 class="equalHeight">';
                                    echo '<span class="content-block__sub-title">' . date('j M, Y', strtotime($rel['created_at'])) . '</span>';
                                    echo htmlspecialchars($rel['title']);
                                    echo '</h5>';
                                    echo '</a>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="col-12"><div class="alert alert-info">No related posts found.</div></div>';
                            }
                            ?>
                        </div>
                        <!-- End of .row -->
                    </div>
                    <!-- End of .blog-grid -->
                </div>
                <!-- End of .blog-by-category -->
            </div>
            <!-- End of .container -->
        </section>
        <!-- End of .featured-projects -->

     

        <!-- Footer starts
    ======================================= -->
    <?php
        include 'includes/footer.php';
    ?>
        <!-- End of footer -->
    </div>
    <!-- End of .page-wrapper -->

    <!-- Featured-designs modal -->
   <?php
        include 'includes/featured-modal.php';
    ?>
    <!-- End of .modal -->

    <!-- Get a quote Modal Starts -->
    <?php
        include 'includes/qoute.php';
    ?>
    <!-- End of .get-a-quote-modal -->


    <!-- Javascripts
    ======================================= -->
    <!-- jQuery -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/vendor/jquery-migrate.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/vendor/bootstrap.bundle.min.js"></script>
    <!-- font awesome -->
    <script src="js/vendor/fontawesome-all.min.js"></script>
    <!-- jQuery Easing Plugin -->
    <script src="js/vendor/easing-1.3.js"></script>
    <!-- jQuery progressbar plugin -->
    <script src="js/vendor/jquery.waypoints.min.js"></script>
    <script src="js/vendor/jquery.counterup.min.js"></script>
    <!-- Bootstrap Progressbar -->
    <script src="js/vendor/bootstrap-progressbar.min.js"></script>
    <!-- ImagesLoaded js -->
    <script src="js/vendor/imagesloaded.pkgd.min.js"></script>
    <!-- Slick carousel js -->
    <script src="js/vendor/slick.min.js"></script>
    <!-- Magnific popup -->
    <script src="js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="js/vendor/isotope.pkgd.min.js"></script>
    <!-- scroll magic -->
    <script src="js/vendor/jquery.ScrollMagic.min.js"></script>
    <script src="js/vendor/debug.addIndicators.min.js"></script>
    <script src="js/vendor/jquery.TweenMax.min.js"></script>
    <script src="js/vendor/animation.gsap.min.js"></script>
    <script src="js/vendor/scrollReveal.js"></script>
    <!-- Custom js -->
    <script src="js/main.js"></script>
</body>

</html>