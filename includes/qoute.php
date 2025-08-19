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
                                            <!-- All form handling is now via AJAX to email/email.php -->
                                            <div id="formMsg"></div>
                                            <form id="quoteForm" class="contact-form">
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