   <section class="featured-projects section-padding">
            <svg class="bg-shape shape-project reveal-from-left" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="779px" height="759px">
                <defs>
                    <linearGradient id="PSgrad_04" x1="70.711%" x2="0%" y1="70.711%" y2="0%">
                        <stop offset="0%" stop-color="rgb(237,247,255)" stop-opacity="1" />
                        <stop offset="100%" stop-color="rgb(237,247,255)" stop-opacity="0" />
                    </linearGradient>

                </defs>
                <path fill-rule="evenodd" fill="url(#PSgrad_04)" d="M111.652,578.171 L218.141,672.919 C355.910,795.500 568.207,784.561 692.320,648.484 C816.434,512.409 805.362,302.726 667.592,180.144 L561.104,85.396 C423.334,-37.184 211.037,-26.245 86.924,109.832 C-37.189,245.908 -26.118,455.590 111.652,578.171 Z"
                />
            </svg>
            <div class="container">
                <h2 class="text-center">Featured Projects</h2>

                <?php
                    require_once 'includes/featured_fetch.php';
                ?>
                <div class="featured-project-showcase text-center">
                    <div class="row equalHeightWrapper">
                        <?php foreach ($featured as $project): ?>
                        <div class="grid-item col-md-6 col-lg-4">
                            <a href="#" class="featured-content-block content-block" data-bs-toggle="modal" data-bs-target="#featured-project-modal">
                                <div class="img-container">
                                    <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="Project image" class="img-fluid">
                                </div>
                                <!-- End of .img-container -->
                                <h5 class="equalHeight">
                                    <?php echo htmlspecialchars($project['title']); ?>
                                    <span class="content-block__sub-title"><?php echo htmlspecialchars($project['subtitle']); ?></span>
                                </h5>
                            </a>
                            <!-- End of .featured-content-block -->
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- End of .grid -->
                    <a href="contact.php" class="custom-btn btn-big grad-style-ef btn-full">Talk to Us</a>
                </div>
                <!-- End of .template-showcase -->
            </div>
            <!-- End of .container -->
        </section>