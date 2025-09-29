<?php
// includes/config.php
// Central configuration for the site - update SITE_URL to match your production domain

if (!defined('SITE_URL')) {
    define('SITE_URL', 'https://www.webontechhub.com');
}

// Backwards-compat: also provide $SITE_URL variable
if (!isset($SITE_URL)) {
    $SITE_URL = SITE_URL;
}
