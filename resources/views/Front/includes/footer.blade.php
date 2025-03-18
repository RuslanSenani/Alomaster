<footer id="footer" class="footer dark-background">


    <div class="container copyright text-center mt-4">
        ©{{date('Y')}} <strong><span>Alo Master</span></strong>. All Rights Reserved
    </div>

</footer>
<!-- Scroll Top -->

<a href="https://api.whatsapp.com/send?phone={{empty(cache('siteData')['settings']) ? " " : cache('siteData')['settings']->phone_1}}&text=Salam"
   class="whatsapp-float"
   target="_blank">
    <i class="bi bi-whatsapp big-whatsapp"></i>
</a>


<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{asset("assets")}}/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset("assets")}}/front/vendor/php-email-form/validate.js"></script>
<script src="{{asset("assets")}}/front/vendor/aos/aos.js"></script>
<script src="{{asset("assets")}}/front/vendor/glightbox/js/glightbox.min.js"></script>
<script src="{{asset("assets")}}/front/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="{{asset("assets")}}/front/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{asset("assets")}}/front/vendor/waypoints/noframework.waypoints.js"></script>
<script src="{{asset("assets")}}/front/vendor/swiper/swiper-bundle.min.js"></script>


<!-- Main JS File -->
<script src="{{asset("assets")}}/front/js/main.js"></script>

