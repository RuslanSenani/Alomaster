<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description"
          content="{{ empty(cache('siteData')['settings']) ? " " : cache('siteData')['settings']->company_name}}">
    <meta name="keywords" content="{{ empty(cache('siteData')['settings']) ? " " : cache('siteData')['settings']->company_name}}">
    <title>{{ empty(cache('siteData')['settings']) ? " " : cache('siteData')['settings']->company_name}}</title>

    <!-- Favicons -->
    <link href="{{empty(cache('siteData')['settings']) ? " ":asset(cache('siteData')['settings']->logo)}}" rel="icon">
    <link href="{{empty(cache('siteData')['settings']) ? " " :asset(cache('siteData')['settings']->logo)}}" rel="apple-touch-icon">

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset("assets")}}/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset("assets")}}/front/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{asset("assets")}}/front/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{asset("assets")}}/front/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{asset("assets")}}/front/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{asset("assets")}}/front/css/main.css" rel="stylesheet">

</head>


