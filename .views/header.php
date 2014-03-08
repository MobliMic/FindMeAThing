<?php
if (isset($viewSettings['pageName'])) {
    $pageName = SITE_NAME . ' - ' . $viewSettings['pageName'];
} else {
    $pageName = SITE_NAME;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $pageName; ?></title>
    <meta name="description" content="Location services for tourists in Bournemouth. Made for NHTG 2014">
    <meta name="keywords" content="HydraCore, hydra, core, php, development, framework, system core"/>
    <meta name="author" content="WeHasCode (https://github.com/orgs/WeHasCode/)">

    <link rel="shortcut icon" href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/favicon.ico" type="image/icon">
    <link rel="icon" href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/favicon.ico" type="image/icon">

    <!-- MS -->
    <meta name="application-name" content="HydraCore"/>
    <meta name="msapplication-TileColor" content="#3297b3"/>
    <meta name="msapplication-square70x70logo"
          content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/tiny.png"/>
    <meta name="msapplication-square150x150logo"
          content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/square.png"/>
    <meta name="msapplication-wide310x150logo"
          content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/wide.png"/>
    <meta name="msapplication-square310x310logo"
          content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/large.png"/>

    <!-- Apple -->
    <link rel="apple-touch-icon"
          href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/apple-touch-icon.png"/>
    <link rel="apple-touch-icon" sizes="57x57"
          href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon" sizes="72x72"
          href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon" sizes="76x76"
          href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon" sizes="114x114"
          href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon" sizes="120x120"
          href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon" sizes="144x144"
          href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon" sizes="152x152"
          href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/resources/images/logo/apple-touch-icon-152x152.png"/>

    <meta name="revisit-after" content="15 days">
    <meta name="rating" content="Safe For Kids">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, user-scalable=no, target-densitydpi=device-dpi">
    <?php
    echo '<link rel="stylesheet" type="text/css" href="' . PROTOCOL . '://' . SITE_DOMAIN . '/components/bootstrap/css/bootstrap.min.css">' . PHP_EOL;
    echo '<link rel="stylesheet" type="text/css" href="' . PROTOCOL . '://' . SITE_DOMAIN . '/components/bootstrap/css/bootstrap-theme.min.css">' . PHP_EOL;
    echo '<link rel="stylesheet" type="text/css" href="' . PROTOCOL . '://' . SITE_DOMAIN . '/resources/scss/glyphs.scss.css">' . PHP_EOL;


    // If this page uses sass
    if (isset($viewSettings['sass'])) {
        // Link the resoucres
        foreach ($viewSettings['sass'] as $row => $value) {
            echo '<link rel="stylesheet" type="text/css" href="' . PROTOCOL . '://' . SITE_DOMAIN . '/resources/scss/' . $row . '.scss.css">' . PHP_EOL;
        }
    }
    // If this page uses less
    if (isset($viewSettings['less'])) {
        // Link the resoucres
        foreach ($viewSettings['less'] as $row => $value) {
            echo '<link rel="stylesheet" type="text/css" href="' . PROTOCOL . '://' . SITE_DOMAIN . '/resources/less/' . $row . '.less.css">' . PHP_EOL;
        }
    }
    echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . '/components/jquery/jquery-1.11.0.min.js"></script>' . PHP_EOL;
    echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . '/components/bootstrap/js/bootstrap.min.js"></script>' . PHP_EOL;
    echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . '/components/modernizr/modernizr.custom.17895.js"></script>' . PHP_EOL;
    echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . '/components/webshims/polyfiller.js"></script>' . PHP_EOL;
    echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . '/components/geo/geo-min.js"></script>' . PHP_EOL;

    // If this page uses js
    if (isset($viewSettings['js'])) {
        // Link the resoucres
        foreach ($viewSettings['js'] as $row => $value) {
            echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . '/resources/js/' . $row . '.closure.js"></script>' . PHP_EOL;
        }
    }
    // If this page uses dart
    if (isset($viewSettings['dart'])) {
        // Link the resoucres
        foreach ($viewSettings['dart'] as $row => $value) {
            echo '<script src="' . PROTOCOL . '://' . SITE_DOMAIN . '/resources/dart/' . $row . '.dart.js"></script>' . PHP_EOL;
        }
    }
    ?>
    <meta property="og:title" content="<?php echo $pageName; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>">
    <meta property="og:image" content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/favicon.png">
    <meta property="fb:app_id" content="489547091155432">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>">
    <meta name="twitter:title" content="<?php echo $pageName; ?>">
    <meta name="twitter:description"
          content="A modern PHP framework core, designed from scratch to be a refreshing coding experience.">
    <meta name="twitter:image" content="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/favicon.png">
    <meta name="twitter:site" content="@HydraCoreIO">
    <link rel="publisher" href="https://plus.google.com/101420792682409929479">
    <!--[if lt IE 9]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="https://raw2.github.com/scottjehl/Respond/master/src/respond.js"></script>
    <![endif]-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-47069574-1', 'hydracore.io');
        ga('send', 'pageview');
    </script>
</head>
<body>
<div id="fb-root"></div>
<script>
    $(document).ready(function () {
        window.fbAsyncInit = function () {
            FB.init({
                appId: 489547091155432,
                status: true,
                cookie: true,
                xfbml: true
            });
        };
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/all.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (!d.getElementById(id)) {
                js = d.createElement(s);
                js.id = id;
                js.src = "https://platform.twitter.com/widgets.js";
                fjs.parentNode.insertBefore(js, fjs);
            }
        }(document, "script", "twitter-wjs"));
        (function () {
            var po = document.createElement("script");
            po.type = "text/javascript";
            po.async = true;
            po.src = "https://apis.google.com/js/plusone.js";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(po, s);
        })();
    });
</script>
<header>
    <div class="nav" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" title="HydraCore">FMAT</a>
        </div>
        <nav class="navbar-collapse collapse">
            <ul class="nav navbar-nav" role="list">
                <li role="listitem"><a href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>">Home</a></li>
                <li role="listitem"><a href="<?php echo PROTOCOL . '://' . SITE_DOMAIN; ?>/about">About</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="clear"></div>
<section id="page">
<div class="row">
    <span class="col-md-12"><h1><?php echo $viewSettings['pageName']; ?></h1></span>
</div>
<div class="container">
