<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description"
          content="Aria is a business focused HTML landing page template built with Bootstrap to help you create lead generation websites for companies and their services.">
    <meta name="author" content="Inovatik">

    <title>欢迎光临</title>

    @include('home.public.styles')

    <!-- Favicon  -->
    <link rel="icon" href="">
    <style>
        .container{width: auto }
        .merchant_cats .content{height: 500px;}
        #nav .nav_main a.current, #nav .nav_main a:hover{
            background-color: black;
        }
        #search .search_area {
            height: 36px;}
        .index_recommend { height:510px}
        .sidebar_per{ height:510px}

        .footer {   padding-top: 2rem;}
    </style>
</head>
<body data-spy="scroll" data-target=".fixed-top">

<!-- Preloader -->
<div class="spinner-wrapper">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!-- end of preloader -->
<!-- Navbar -->
@include('home.public.nav')
<!-- Header -->
@include('home.public.header')
<!-- end of header -->
{{--middler banner start --}}
@include('home.public.banner')
{{--middler banner end --}}

<!-- Intro  main-->
@yield('main_content')
<!-- end of intro main-->
<!-- Footer -->
@include('home.public.footer')
<!-- end of footer -->
<!-- Copyright -->

<!-- end of copyright -->
@include('home.public.script')
</body>
</html>