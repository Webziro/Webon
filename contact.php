<!DOCTYPE html>

<html class="no-js" lang="zxx">
<!--<![endif]-->

<?php
    // Head 
    include 'includes/head.php'; 
?>


<body class="body-bg-style-3 inner-page">
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
                <h1>Contact</h1>
                <p>Get in touch with us to see how our company can help you
                    <br>grow your business online.</p>
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .banner -->

        <!-- Contact-form-wrapper starts
    ======================================= -->
        <div class="contact-form-wrapper section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-wrapper contact-page-form-wrapper">
                            <div class="form-wrapper">
                                <h3>Send Us a Message</h3>
                                <div id="formMsg"></div>
                                <form class="contact-form" id="quoteForm">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6">
                                            <input type="text" name="fname" placeholder="Full Name">
                                        </div>

                                        <div class="col-md-12 col-lg-6">
                                            <input type="email" name="email" placeholder="Email">
                                        </div>

                                        <div class="col-md-12 col-lg-6">
                                            <input type="text" name="phone" placeholder="Phone">
                                        </div>

                                        <div class="col-md-12 col-lg-6">
                                            <input type="text" name="website" placeholder="Purpose">
                                        </div>

                                        <div class="col-md-12">
                                            <textarea name="message" placeholder="Message"></textarea>
                                        </div>
                                        <div class="btn-wrapper">
                                            <button type="submit" class="custom-btn btn-big grad-style-ef">CONTACT US NOW</button>
                                        </div>
                                    </div>
                                    <!-- End of .row -->
                                </form>
                                
                                            <!-- Ajax Script running the send message -->
                                            <script>
                                            document.getElementById('quoteForm').onsubmit = function(e) {
                                                e.preventDefault();
                                                var form = e.target;
                                                var data = new FormData(form);
                                                fetch('email/email.php', {
                                                    method: 'POST',
                                                    body: data
                                                })
                                                .then(res => res.json())
                                                .then(res => {
                                                    document.getElementById('formMsg').innerHTML =
                                                        '<div class="alert ' + (res.success ? 'alert-success' : 'alert-danger') + '">' + res.message + '</div>';
                                                    if (res.success) form.reset();
                                                });
                                            };
                                            </script>
                                <!-- End of .contact-form -->
                            </div>
                            <!-- End of .form-wrapper -->
                        </div>
                        <!-- End of .contact-form -->
                    </div>
                    <!-- End of .col-lg-7 -->

                    <div class="col-lg-6">
                        <div class="contact-info floating-contact-info">
                            <h5>What’s Next?</h5>

                            <div class="whats-next-wrapper">
                                <p>
                                    <i class="ml-symone-68-arrow-left-right-up-down-increase-decrease"></i>An email and phone call from one of our representatives.</p>
                                <p>
                                    <i class="ml-symone-68-arrow-left-right-up-down-increase-decrease"></i>A time &amp; cost estimation.</p>
                                <p>
                                    <i class="ml-symone-68-arrow-left-right-up-down-increase-decrease"></i>An in-person meeting.</p>
                            </div>
                            <!-- End of .whats-next-wrapper -->

                            <p class="address">
                                Give us a call
                                <a href="tel:7021231478">(702) 123-1478</a>
                            </p>
                            <!-- End of .address -->

                            <p class="address">
                                Send us an email
                                <a href="mailto:info@company.com">info@company.com</a>
                            </p>
                            <!-- End of .address -->

                            <div class="social-icons-wrapper">
                                <p>Follow us on</p>
                                <ul class="social-icons">
                                    <li>
                                        <a href="http://www.behance.net/" target="_blank" rel="noopener">
                                            <i class="fab fa-behance"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://twitter.com/" target="_blank" rel="noopener">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://plus.google.com/discover" target="_blank" rel="noopener">
                                            <i class="fab fa-google-plus-g"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://dribbble.com/" target="_blank" rel="noopener">
                                            <i class="fab fa-dribbble"></i>
                                        </a>
                                    </li>
                                </ul>
                                <!-- End of .social-icons -->
                            </div>
                        </div>
                        <!-- End of .contact-info -->
                    </div>
                    <!-- End of .col-lg-5 -->
                </div>
                <!-- End of .row -->
            </div>
            <!-- End of .container -->
        </div>
        <!-- End of .contact-form-wrapper -->

        <!-- work-places
    ======================================= -->
        <section class="work-places section-padding">
            <svg class="bg-shape shape-work-places reveal-from-right" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_045" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_045)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>
            <div class="container">
                <h2 class="text-center">Visit Our Work Places</h2>

                <div class="location-process-tab">
                    <ul class="nav nav-tabs location-tab-nav" id="location-tab-nav" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="process-nav-1" data-bs-toggle="tab" href="#process-tab-1" role="tab" aria-controls="process-tab-1"
                                aria-selected="true">
                                <img src="images/icon/map-1.png" alt="New York Map">
                                <span>New York</span>
                                <p>Theodore Lowe, Ap #867-859
                                    <br>Sit Rd, Azusa New York </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="process-nav-2" data-bs-toggle="tab" href="#process-tab-2" role="tab" aria-controls="process-tab-2" aria-selected="true">
                                <img src="images/icon/map-2.png" alt="Dhaka Map">
                                <span>Dhaka</span>
                                <p>Theodore Lowe, Ap #867-859
                                    <br>Sit Rd, Azusa New York </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="process-nav-3" data-bs-toggle="tab" href="#process-tab-3" role="tab" aria-controls="process-tab-3" aria-selected="true">
                                <img src="images/icon/map-3.png" alt="Dehli Map">
                                <span>Delhi</span>
                                <p>Theodore Lowe, Ap #867-859
                                    <br>Sit Rd, Azusa New York </p>
                            </a>
                        </li>
                    </ul>
                    <!-- End of .service-tab-nav -->
                 
                </div>
                <!-- End of .location-process-tab -->
            </div>
            <!-- End of .container -->
        </section>
        <!-- End of .work-places -->


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


<!-- Mirrored from new.axilthemes.com/demo/template/cynic-bs5/trendy-small-digital-agency/contact.php by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Aug 2025 21:40:00 GMT -->
</html>