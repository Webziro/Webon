<?php
// Load central config (defines SITE_URL and $SITE_URL)
if (file_exists(__DIR__ . '/config.php')) {
  include __DIR__ . '/config.php';
} else {
  // Fallback
  if (!isset($SITE_URL)) $SITE_URL = 'https://www.webontechhub.com';
}
// Debug: log included files and create_slug presence when head is included
error_log("[head.php] Included files count: " . count(get_included_files()));
foreach (get_included_files() as $f) {
    error_log("[head.php] included: " . $f);
}
if (function_exists('create_slug')) {
    $rf = new ReflectionFunction('create_slug');
    error_log('[head.php] create_slug defined in ' . $rf->getFileName() . ' on line ' . $rf->getStartLine());
} else {
    error_log('[head.php] create_slug is NOT defined at head include time');
}
?>
<head>

    <!-- Basic metas
    ======================================== -->
    <meta charset="utf-8">
  <meta name="author" content="Webon Tech Hub || Best Website and App Development Services">
  <meta name="description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'Webon Tech Hub || Best Website and App Development Services'; ?>">
  <meta name="keywords" content="Webon Tech Hub || Best Website and App Development Services">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://www.webontechhub.com/" />

    <!-- Robots -->
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="<?php echo isset($meta_title) ? htmlspecialchars($meta_title) : 'Webon Tech Hub || Best Website and App Development Services'; ?>" />
  <meta property="og:description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'Webon Tech Hub || Best Website and App Development Services'; ?>" />
  <meta property="og:type" content="<?php echo isset($meta_type) ? htmlspecialchars($meta_type) : 'website'; ?>" />
  <meta property="og:url" content="<?php echo isset($meta_url) ? htmlspecialchars($meta_url) : 'https://www.webontechhub.com/'; ?>" />
  <meta property="og:image" content="<?php echo isset($meta_image) ? htmlspecialchars($meta_image) : 'https://www.webontechhub.com/images/brand-logo.png'; ?>" />

    <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?php echo isset($meta_title) ? htmlspecialchars($meta_title) : 'Webon Tech Hub || Best Website and App Development Services'; ?>" />
  <meta name="twitter:description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'Webon Tech Hub || Best Website and App Development Services'; ?>" />
  <meta name="twitter:image" content="<?php echo isset($meta_image) ? htmlspecialchars($meta_image) : 'https://www.webontechhub.com/images/brand-logo.png'; ?>" />

    <!-- Structured Data: Organization Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Webon Tech Hub",
      "url": "https://www.webontechhub.com/",
      "logo": "https://www.webontechhub.com/images/brand-logo.png",
      "sameAs": [
        "https://www.facebook.com/webontechhub",
        "https://twitter.com/webontechhub",
        "https://www.linkedin.com/in/webontechhub"
      ]
    }
    </script>

    <!-- Mobile specific metas
    ======================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Page Title
    ======================================== -->
    <title>Webon Tech Hub || Best Website and App Development Services</title>

    <!-- links for favicon
    ======================================== -->
    <link rel="apple-touch-icon" sizes="57x57" href="favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/favicon-96x96.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-96x96.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/favicon-96x96.png">
    <meta name="theme-color" content="#ffffff">


    <!-- Icon fonts
    ======================================== -->
    <link rel="stylesheet" type="text/css" href="css/miniline.css">

    <!-- css links
    ======================================== -->
    <!-- Bootstrap link -->
    <link rel="stylesheet" type="text/css" href="css/vendor/bootstrap.min.css">

    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="css/vendor/slick.css">
    <link rel="stylesheet" type="text/css" href="css/vendor/slick-theme.css">

    <!-- Magnific popup -->
    <link rel="stylesheet" type="text/css" href="css/vendor/magnific-popup.css">

    <!-- Custom styles -->
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <!-- Responsive styling -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

    <!-- W3 Schools -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>