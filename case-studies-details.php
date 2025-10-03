<!DOCTYPE html>

<html class="no-js" lang="eng">

 <?php
    include 'includes/head.php';
    require_once 'includes/db.php';

    // Prevent direct/manual visits without an id parameter.
    // This page should only be reached by clicking a case study item which provides an id.
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id <= 0) {
        // Redirect back to case studies listing
        header('Location: case-studies.php');
        exit;
    }
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

    <?php    
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $stmt = $pdo->prepare("SELECT * FROM case_studies WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row): 
    ?>
        <div class="inner-page-banner inner-banner-with-btn">
            <div class="container text-center">
                <h1><?php echo htmlspecialchars($row['title']); ?></h1>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
            </div>
        </div>
        <!-- End of .banner -->

        <!-- image-with-description starts
    ======================================= -->
        <section class="image-with-description">
            <svg class="bg-shape image-with-description-shape-bg reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
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

            <div class="container">
                <div class="row align-items-center image-with-description-block">
                    <div class="col-lg-6">
                <h3 class="align-text-center">Problem</h3>
                        <h2><?php echo htmlspecialchars($row['challenges_title']); ?></h2>
                        <p><?php echo nl2br(htmlspecialchars($row['challenges_description'])); ?></p>
                        <?php
                        if (!empty($row['challenges_points'])) {
                            $challenges_points = trim($row['challenges_points']);
                            $challenges_points = str_replace(["\r\n", "\r"], "\n", $challenges_points);
                            $lines = explode("\n", $challenges_points);
                            $all_points = [];
                            foreach ($lines as $line) {
                                $subpoints = explode(',', $line);
                                foreach ($subpoints as $subpoint) {
                                    $subpoint = trim($subpoint);
                                    if ($subpoint !== '') {
                                        $all_points[] = $subpoint;
                                    }
                                }
                            }
                            if (count($all_points)) {
                                echo '<ul class="common-list-items">';
                                foreach ($all_points as $point) {
                                    echo '<li>' . htmlspecialchars($point) . '</li>';
                                }
                                echo '</ul>';
                            }
                        }
                        ?>
                    </div>
                    <div class="col-lg-6 text-lg-right">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="service description image" class="img-fluid">
                    </div>
                </div>
                <!-- End of .row -->

                <div class="row align-items-center image-with-description-block">
                    <div class="col-lg-6 order-lg-2">
                    <h3 class="text-left">Solution</h3>
                        <p><?php echo htmlspecialchars($row['solution_title']); ?></p>
                        <p ><?php echo nl2br(htmlspecialchars($row['solution_description'])); ?></p>
                        <?php
                        if (!empty($row['solution_points'])) {
                            $solution_points = trim($row['solution_points']);
                            $solution_points = str_replace(["\r\n", "\r"], "\n", $solution_points);
                            $lines = explode("\n", $solution_points);
                            $all_points = [];
                            foreach ($lines as $line) {
                                $subpoints = explode(',', $line);
                                foreach ($subpoints as $subpoint) {
                                    $subpoint = trim($subpoint);
                                    if ($subpoint !== '') {
                                        $all_points[] = $subpoint;
                                    }
                                }
                            }
                            if (count($all_points)) {
                                echo '<ul class="common-list-items">';
                                foreach ($all_points as $point) {
                                    echo '<li>' . htmlspecialchars($point) . '</li>';
                                }
                                echo '</ul>';
                            }
                        }
                        ?>
                    </div>
                    <div class="col-lg-6 text-lg-left">
                        <img src="<?php echo htmlspecialchars($row['solution_image']); ?>" alt="solution image" class="img-fluid">
                    </div>
                </div>
                <!-- End of .row -->
            </div>
            <!-- End of .container -->
        </section>
        <!-- End of .image-with-description -->

        <!-- scroreboard
    ======================================= -->
        <section class="scroreboard section-padding">
            <div class="container">
                <h2 class="text-center">Scoreboard</h2>
                <div class="scroreboard-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="scoreboard-content">
                                <?php
                                $score_points = trim($row['score_points']);
                                if (!empty($score_points)) {
                                    // Normalize all line breaks to \n
                                    $score_points = str_replace(["\r\n", "\r"], "\n", $score_points);
                                    // Split by newline first
                                    $lines = explode("\n", $score_points);
                                    $all_points = [];
                                    foreach ($lines as $line) {
                                        // Now split each line by comma
                                        $subpoints = explode('.', $line);
                                        foreach ($subpoints as $subpoint) {
                                            $subpoint = trim($subpoint);
                                            if ($subpoint !== '') {
                                                $all_points[] = $subpoint;
                                            }
                                        }
                                    }
                                    if (count($all_points)) {
                                        echo '<ul class="common-list-items">';
                                        foreach ($all_points as $point) {
                                            echo '<li><i class="ml-symtwo-23-check-mark"></i> ' . htmlspecialchars($point) . '</li>';
                                        }
                                        echo '</ul>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of .container -->
        </section>
        <!-- End of .our-process -->

        <!-- featured-projects
    ======================================= -->
        <!-- You can add related case studies or other content here if needed -->

  

        <!-- Footer starts
    ======================================= -->
    <?php
        include 'includes/footer.php';
    ?>
        <!-- End of footer -->
    </div>
    <!-- End of .page-wrapper -->
    <?php endif; ?>


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