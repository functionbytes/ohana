<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DSAThemes">
    <meta name="description" content="">

    <!-- FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">


    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@publisher_handle">


    @yield('head')

    <!-- BOOTSTRAP pages/css/ -->
    <link href="/pages/css//bootstrap.min.css" rel="stylesheet">

    <!-- FONT ICONS -->
    <link href="/pages/css//flaticon.css" rel="stylesheet">

    <!-- PLUGINS STYLESHEET -->
    <link href="/pages/css//menu.css" rel="stylesheet">
    <link id="effect" href="/pages/css//dropdown-effects/fade-down.css" media="all" rel="stylesheet">
    <link href="/pages/css//magnific-popup.css" rel="stylesheet">
    <link href="/pages/css//owl.carousel.min.css" rel="stylesheet">
    <link href="/pages/css//owl.theme.default.min.css" rel="stylesheet">
    <link href="/pages/css//lunar.css" rel="stylesheet">

    <!-- ON SCROLL ANIMATION -->
    <link href="/pages/css//animate.css" rel="stylesheet">

    <!-- TEMPLATE pages/css/ -->
    <link href="/pages/css//blue-theme.css" rel="stylesheet">

    <!-- Style Switcher pages/css/ -->
    <link href="/pages/css//crocus-theme.css" rel="alternate stylesheet" title="crocus-theme">
    <link href="/pages/css//green-theme.css" rel="alternate stylesheet" title="green-theme">
    <link href="/pages/css//magenta-theme.css" rel="alternate stylesheet" title="magenta-theme">
    <link href="/pages/css//pink-theme.css" rel="alternate stylesheet" title="pink-theme">
    <link href="/pages/css//purple-theme.css" rel="alternate stylesheet" title="purple-theme">
    <link href="/pages/css//skyblue-theme.css" rel="alternate stylesheet" title="skyblue-theme">
    <link href="/pages/css//red-theme.css" rel="alternate stylesheet" title="red-theme">
    <link href="/pages/css//violet-theme.css" rel="alternate stylesheet" title="violet-theme">

    <!-- RESPONSIVE pages/css/ -->
    <link href="/pages/css//responsive.css" rel="stylesheet">

    @stack('css')


</head>

<body>


<div id="page" class="page font--jakarta">

    @yield('content')

</div>

<!-- EXTERNAL SCRIPTS
============================================= -->
<script src="/pages/js/jquery-3.7.0.min.js"></script>
<script src="/pages/js/bootstrap.min.js"></script>
<script src="/pages/js/modernizr.custom.js"></script>
<script src="/pages/js/jquery.easing.js"></script>
<script src="/pages/js/jquery.appear.js"></script>
<script src="/pages/js/menu.js"></script>
<script src="/pages/js/owl.carousel.min.js"></script>
<script src="/pages/js/pricing-toggle.js"></script>
<script src="/pages/js/jquery.magnific-popup.min.js"></script>
<script src="/pages/js/request-form.js"></script>
<script src="/pages/js/jquery.validate.min.js"></script>
<script src="/pages/js/jquery.ajaxchimp.min.js"></script>
<script src="/pages/js/popper.min.js"></script>
<script src="/pages/js/lunar.js"></script>
<script src="/pages/js/wow.js"></script>

<!-- Custom Script -->
<script src="/pages/js/custom.js"></script>

<script src="/pages/js/changer.js"></script>
<script defer src="/pages/js/styleswitch.js"></script>


@if(setting('google_analytics_enable') == 'true' )

    <script>
        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', '{{ setting('google_analytics') }}', 'auto');
        ga('send', 'pageview');
    </script>
@endif

@if(setting('fb_pixel_enable') == 'true' )
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{setting('fb_pixel_enable')}}');
        fbq('track', 'PageView');
    </script>

    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id={{setting('fb_pixel_enable')}}&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endif

@stack('scripts')

</body>

</html>
