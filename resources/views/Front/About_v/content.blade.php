<!-- Page Title -->
<div class="page-title accent-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Hakkımızda</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{route('work-area')}}">Əsas</a></li>
                <li class="current">Hakkımızda</li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<section id="service-details" class="service-details section">

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                {!!  empty(cache('siteData')['settings']) ? " " : cache('siteData')['settings']->about_us !!}
            </div>

            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                <img src="{{asset($portfoliosImages ?? 'assets/dist/img/alomasterLogo.svg')}}" alt="" class="img-fluid services-img">
            </div>

        </div>

    </div>

</section>
