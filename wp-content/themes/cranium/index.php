<?php

if (!defined('ABSPATH')) {
    http_response_code(403);
    exit(' ');
}

?><!DOCTYPE html>
<html lang="en-US" class="no-js">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="google-site-verification" content="... google webmaster tools ...">
    <meta name="p:domain_verify" content="... pinterest site verification ...">

    <meta property="og:type" content="... website or article ...">
    <meta property="og:title" content="Lorem Ipsum Page Title">
    <meta property="og:description" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="">
    <meta property="og:image:height" content="">
    <meta property="og:image:alt" content="">
    <meta property="og:site_name" content="">
    <meta property="og:locale" content="en_US">

    <meta name="twitter:url" content="">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="">
    <meta name="twitter:image" content="">
    <meta name="twitter:description" content="Content description less than 200 characters">
    <meta name="twitter:site" content="@site_account">

    <link rel="apple-touch-icon" href="/images/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/images/favicon.png">
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#BADA55">
    <link rel="manifest" href="/images/manifest.json">
    <meta name="msapplication-TileImage" content="/images/mstile-150x150.png">
    <meta name="msapplication-TileColor" content="#C0FFEE">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="">
    <link rel="alternate" href="http://feeds.feedburner.com/example" type="application/rss+xml">
    <link rel="canonical" href="">

    <title>Lorem Ipsum Page Title | Example Site</title>

    <script type='application/ld+json'>{
    "@context": "https:\/\/schema.org",
    "@type": "Website",
    "url": "https://www.example.com",
    "name": "Example Site",
    "logo": "https://www.example.com/images/logo.svg",
    "description": "",
    "sameAs": ["https://www.facebook.com/example/", "https://www.instagram.com/example/", "https://twitter.com/example", "https://www.pinterest.com/example/"]
    }</script>

    <script>
    (function(html, msie) {
        html.className = html.className.replace('no-js','js');
        msie && html.classList.add('msie');
    }(document.documentElement, document.documentMode));
    </script>

    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-XXXXX-Y', 'auto');
    ga('send', 'pageview');
    </script>

    <link rel="stylesheet" href="/build.css?v=<?php echo GIT_COMMIT ?>">

</head>
<body>

<div id="root"></div>

<?php if (isset($data)): ?>
<script type="application/json" id="data"><?php echo json_encode($data) ?></script>
<?php endif; ?>
<script src="/build.js?v=<?php echo GIT_COMMIT ?>"></script>

</body>
</html>