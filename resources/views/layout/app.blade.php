<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="author" content="Developer =AhmedKhaled ">
    <meta name="description" content="منصه    ">
    <!--=============== FAVICON ===============-->
    <!-- <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon"> -->

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">
    <meta name="google-site-verification" content="wKqT9MW4kWF3EaUGuZDIkJed2B3KMJ7V2vnrA6tGl-8" />
    <!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&display=swap" rel="stylesheet">
    <!--=============== CSS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assest/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <title>
        @yield('title')
    </title>
        @livewireStyles

</head>
{{--  --}}
{{-- @yield('content') --}}



<body>
    @yield('content')
        @livewireScripts

</body>

<!--==================== FOOTER ====================-->
  <footer class="footer">
    <div class="footer-bg"></div>
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
                <div class="footer-logo-icon">
                    <i class="fas fa-atom"></i>
                    <div class="logo-pulse"></div>
                </div>
                <h3>أحمد علاء - معلم الفيزياء</h3>
            </div>
            <p>تعليم الفيزياء بأسلوب مبسط ومفصل لضمان فهم وتفوق جميع الطلاب</p>
            <div class="social-links">
                <a href="#" class="social-link">
                    <i class="fab fa-facebook"></i>
                    <span>فيسبوك</span>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-whatsapp"></i>
                    <span>واتساب</span>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-telegram"></i>
                    <span>تليجرام</span>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-youtube"></i>
                    <span>يوتيوب</span>
                </a>
            </div>
            <p class="copyright">© 2024 جميع الحقوق محفوظة - أحمد علاء</p>
<p class="made-with">
    Made with <span style="color:red;">❤</span> by 
    <a href="https://facebook.com/ahmedkhaled" target="_blank" style="color: #6366f1; text-decoration: none;">
        Ahmed Khaled
    </a>
</p>
        </div>
    </div>
</footer>
  

        @livewireScripts

    <script src="index.js"></script>

{{-- <script src="{{ asset('assets/in.js') }}"></script> --}}
{{-- <script src="../assets/main.js"></script> --}}
<!--==================== SWIPER JS ====================-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="{{ asset('assest/index.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
