<!DOCTYPE html>

<html class="no-js" lang="zxx">
<!--<![endif]-->
 <?php
    // Head 
    include 'includes/head.php'; 
    require_once 'includes/db.php';
?>
<body class="inner-page">
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
                <linearGradient id="PSgrad_02" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                    <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                    <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                </linearGradient>
            </defs>
            <path fill-rule="evenodd" fill="url(#PSgrad_02)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
            />
        </svg>

        <!-- navbar starts
    ======================================= -->
    <?php 
        include 'includes/nav.php';
    ?>
        <!-- End of .navbar -->

        <!-- Header starts
    ======================================= -->
        <div class="inner-page-banner">
            <div class="container text-center">
                <h1>Blog</h1>
                <p>We use strategic approaches to provide our clients with high-end.
                    <br>services that ensure superior customer satisfaction.</p>
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .banner -->

        <!-- featured-projects
    ======================================= -->
        <section class="blog">
            <div class="trigger-project"></div>
            <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_03)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>
<!-- Blog Category -->
 
 <section class="latest-news section-padding">
        <div class="container">
            <h2>Latest Blogs</h2>
        </div>
        <!-- End of .container -->

    <div class="news-slider common-slider">
        <div class="carousel-container equalHeightWrapper">
            <?php
                $stmt = $pdo->query("SELECT * FROM news WHERE status = 'published' AND category = 'blog' ORDER BY created_at DESC");
                while ($row = $stmt->fetch()) {
                    $newsUrl = 'blog-details.php?id=' . $row['id'];
                    $share_url = 'https://' . $_SERVER['HTTP_HOST'] . '/blog-details.php?id=' . $row['id'];
                    $shareUrl = urlencode($share_url);
                    $excerpt = trim(strip_tags($row['content']));
                    if (strlen($excerpt) > 200) $excerpt = substr($excerpt, 0, 197) . '...';
                    $share_text = urlencode($row['title'] . ' - ' . $excerpt);
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
                    // View count and share buttons
                    echo '<div style="margin-top:8px;">';
                    echo '<span class="badge bg-secondary">Views: ' . $row['views'] . '</span> ';
                    echo '<a href="#" onclick="openShareWindow(\'https://www.facebook.com/sharer/sharer.php?u=' . $shareUrl . '&quote=' . $share_text . '\'); return false;" class="btn btn-sm btn-primary" style="margin-left:8px;">';
                    echo 'Share</a>';
                    echo ' <a href="#" onclick="openShareWindow(\'https://twitter.com/intent/tweet?text=' . $share_text . '&url=' . $shareUrl . '\'); return false;" class="btn btn-sm btn-info" style="margin-left:8px;">';
                    echo '<i class="fab fa-twitter"></i></a>';
                    echo ' <a href="https://wa.me/?text=' . $share_text . '%20' . $shareUrl . '" onclick="return openShareWindow(\'https://wa.me/?text=' . $share_text . '%20' . $shareUrl . '\');" class="btn btn-sm btn-success" style="margin-left:8px;">';
                    echo '<i class="fab fa-whatsapp"></i></a>';
                    echo ' <a href="#" onclick="copyToClipboard(\'' . $share_url . '\'); return false;" class="btn btn-sm btn-secondary" style="margin-left:8px;">Copy</a>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
    </section>

        <!-- End of .news-slider -->

        <!-- End of .blog -->

        <!-- Press Releases Category -->
            <!-- Press Releases Category -->
            <div class="container">
                <div class="blog-by-category section-padding">
                    <h2 class="text-center">Press Releases</h2>
                    <div class="blog-grid text-center equalHeightWrapper">
                        <div class="row">
                           <?php
                            $stmt = $pdo->query("SELECT * FROM news WHERE status = 'published' AND category = 'press' ORDER BY created_at DESC");
                            while ($row = $stmt->fetch()) {
                                $newsUrl = 'blog-details.php?id=' . $row['id'];
                                echo '<div class="item col-md-6 col-lg-4">';
                                echo '<a href="' . $newsUrl . '" class="news-content-block content-block">';
                                echo '<div class="img-container">';
                                echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Webon Blog Image" class="img-fluid">';
                                echo '</div>';
                                echo '<h5 class="equalHeight">';
                                echo '<span class="content-block__sub-title">' . date('j M, Y', strtotime($row['created_at'])) . '</span>';
                                echo htmlspecialchars($row['title']);
                                echo '</h5>';
                                echo '</a>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <!-- End of .row -->
                        <!-- <a href="#" class="custom-btn btn-big grad-style-ef btn-full">LOAD MORE</a> -->
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
    <script>
    function openShareWindow(url) {
        try {
            var width = 600, height = 450;
            var left = (screen.width / 2) - (width / 2);
            var top = (screen.height / 2) - (height / 2);
            var win = window.open(url, 'shareWindow', 'toolbar=0,status=0,width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
            if (win) { win.focus(); return false; }
        } catch (e) { window.open(url, '_blank'); return false; }
        return false;
    }
    function copyToClipboard(text) {
        if (!navigator.clipboard) {
            var input = document.createElement('input');
            document.body.appendChild(input);
            input.value = text;
            input.select();
            try { document.execCommand('copy'); alert('Link copied to clipboard'); } catch (e) { prompt('Copy this link:', text); }
            document.body.removeChild(input);
            return false;
        }
        navigator.clipboard.writeText(text).then(function() { alert('Link copied to clipboard'); }, function() { prompt('Copy this link:', text); });
        return false;
    }
    </script>
</body>

</html>