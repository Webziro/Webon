<div class="modal fade get-a-quote-modal" id="get-a-quote-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ml-symtwo-24-multiply-cross-math"></i>
                    </button>
                    <!-- End of .close -->
                </div>
                <!-- End of .modal-header -->

                <div class="modal-body">
                    <div class="contact-form-wrapper">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="contact-wrapper contact-page-form-wrapper">
                                        <div class="form-wrapper">
                                            <h3>Send Us a Message</h3>
                                            <?php
                                            $successMsg = $errorMsg = '';
                                            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fname'])) {
                                                require_once __DIR__ . '/db.php'; 
                                                $fname = trim($_POST['fname'] ?? '');
                                                $email = trim($_POST['email'] ?? '');
                                                $phone = trim($_POST['phone'] ?? '');
                                                $website = trim($_POST['website'] ?? '');
                                                $message = trim($_POST['message'] ?? '');
                                                if ($fname && $email && $message) {
                                                    // Save to DB (create table contact_messages if not exists)
                                                    $stmt = $pdo->prepare("INSERT INTO contact_messages (fname, email, phone, website, message) VALUES (?, ?, ?, ?, ?)");
                                                    $stmt->execute([$fname, $email, $phone, $website, $message]);
                                                    $successMsg = 'Thank you for contacting us! We will get back to you soon.';
                                                } else {
                                                    $errorMsg = 'Please fill in your name, email, and message.';
                                                }
                                            }
                                            ?>
                                            <?php if ($successMsg): ?>
                                                <div class="alert alert-success"><?php echo $successMsg; ?></div>
                                            <?php endif; ?>
                                            <?php if ($errorMsg): ?>
                                                <div class="alert alert-danger"><?php echo $errorMsg; ?></div>
                                            <?php endif; ?>
                                            <form class="contact-form" method="post">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-6">
                                                        <input type="text" name="fname" placeholder="Full Name" value="<?php echo htmlspecialchars($_POST['fname'] ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-12 col-lg-6">
                                                        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-12 col-lg-6">
                                                        <input type="text" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-12 col-lg-6">
                                                        <input type="text" name="website" placeholder="Website" value="<?php echo htmlspecialchars($_POST['website'] ?? ''); ?>">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <textarea name="message" placeholder="Message"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                                                    </div>
                                                    <div class="btn-wrapper">
                                                        <button type="submit" class="custom-btn btn-big grad-style-ef">CONTACT US NOW</button>
                                                    </div>
                                                </div>
                                                <!-- End of .row -->
                                            </form>
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
                </div>
                <!-- End of .modal-body -->
            </div>
            <!-- End of .modal-content -->
        </div>
        <!-- End of .modal-dialog -->
    </div>