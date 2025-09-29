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
                                            (function() {
                                                var form = document.getElementById('quoteForm');
                                                var formMsg = document.getElementById('formMsg');
                                                var submitBtn = form.querySelector('button[type="submit"]');

                                                function setButtonLoading(loading) {
                                                    if (!submitBtn) return;
                                                    submitBtn.disabled = loading;
                                                    submitBtn.classList.toggle('disabled', loading);
                                                    submitBtn.setAttribute('aria-busy', loading ? 'true' : 'false');
                                                    if (loading) {
                                                        submitBtn.dataset.origText = submitBtn.innerHTML;
                                                        submitBtn.innerHTML = 'Sending...';
                                                    } else if (submitBtn.dataset.origText) {
                                                        submitBtn.innerHTML = submitBtn.dataset.origText;
                                                        delete submitBtn.dataset.origText;
                                                    }
                                                }

                                                function showMessage(message, success) {
                                                    formMsg.innerHTML = '<div class="alert ' + (success ? 'alert-success' : 'alert-danger') + '">' + message + '</div>';
                                                }

                                                form.onsubmit = function(e) {
                                                    e.preventDefault();
                                                    var data = new FormData(form);
                                                    setButtonLoading(true);
                                                    fetch('email/email.php', {
                                                        method: 'POST',
                                                        body: data
                                                    })
                                                    .then(function(res) {
                                                        // Ensure we always try to parse JSON
                                                        return res.json().catch(function() { return { success: false, message: 'Unexpected server response' }; });
                                                    })
                                                    .then(function(res) {
                                                        setButtonLoading(false);
                                                        showMessage(res.message || (res.success ? 'Message sent.' : 'An error occurred.'), !!res.success);
                                                        if (res.success) {
                                                            form.reset();
                                                            // Auto-close modal after a short delay to let user read message
                                                            try {
                                                                var modalEl = document.getElementById('get-a-quote-modal');
                                                                var bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                                                                setTimeout(function() { bsModal.hide(); }, 2200);
                                                            } catch (e) {
                                                                // ignore if bootstrap isn't available
                                                            }
                                                        }
                                                    })
                                                    .catch(function(err) {
                                                        setButtonLoading(false);
                                                        showMessage('Network error: could not send your message. Please try again later.', false);
                                                    });
                                                };
                                            })();
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
                                            <a href="tel:23483792208">(234) 837-92208</a>
                                        </p>
                                        <!-- End of .address -->

                                        <p class="address">
                                            Send us an email
                                            <a href="mailto:info@company.com">info@usewebon.com</a>
                                        </p>
                                        <!-- End of .address -->

                                        <div class="social-icons-wrapper">
                                            <p>Follow us on</p>
                                            <ul class="social-icons">
                                                <li>
                                                    <a href="http://www.linkedin.com/in/webontechhub" target="_blank" rel="noopener">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="http://twitter.com/webontechhub" target="_blank" rel="noopener">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="http://facebook.com/webontechhub" target="_blank" rel="noopener">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>
                                                </li>
                                            </ul>          <ul class="social-icons">
                                                <li>
                                                    <a href="http://www.linkedin.com/in/webontechhub" target="_blank" rel="noopener">
                                                        <i class="fab fa-linkedin"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="http://twitter.com/webontechhub" target="_blank" rel="noopener">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="http://facebook.com/webontechhub" target="_blank" rel="noopener">
                                                        <i class="fab fa-facebook"></i>
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