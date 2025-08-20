<!DOCTYPE html>

<html class="no-js" lang="zxx">
<!--<![endif]-->
 <?php
    include 'includes/db.php';
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
                <h1>Case Studies</h1>
                <p>Learn how we helped our several clients grow in online business.
                    <br>It will give you an idea of our capabilities.</p>
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .banner -->

        <!-- case-studies starts
    ======================================= -->
        <section class="case-studies-grid-wrapper section-padding">
            <svg class="bg-shape shape-case-study reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_03" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                    </linearGradient>
                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_03)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z" />
            </svg>
            <div class="container">
                <div class="case-study-showcase">
                    <div class="row equalHeightWrapper">
                        <?php
                            $stmt = $pdo->query("SELECT * FROM case_studies ORDER BY id DESC");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="item col-md-6">
                            <a href="case-studies-details.php?id=<?php echo $row['id']; ?>" class="case-study-content-block content-block text-left">
                                <div class="img-container">
                                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="img-fluid">
                                </div>
                                <div class="txt-content equalHeight">
                                    <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                                </div>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
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


<!-- Mirrored from new.axilthemes.com/demo/template/cynic-bs5/trendy-small-digital-agency/case-studies.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Aug 2025 21:39:56 GMT -->
</html>