<!-- Page Title -->
<div class="page-title accent-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Üstünlüklərimiz</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{route('work-area')}}">Əsas</a></li>
                <li class="current">Üstünlüklərimiz</li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->


<!-- Services Section -->
<section id="services" class="services section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>ÜSTÜNLÜKLƏR</h2>
    </div>

    <div class="container my-5 d-flex flex-column gap-5">

        <!-- 1. Blok -->
        <div class="row align-items-center">
            <div class="col-md-2 d-flex justify-content-center">
                <div class="feature-circle-one bg-blue">
                    <div class="feature-circle-little">1</div>
                </div>
            </div>
            <div class="col-md-10">
                <h5 class="fw-bold">KEYFİYYƏT</h5>
                <p class="mb-0">
                    {!! empty(cache('siteData')) ? " " : cache('siteData')['settings']->quality !!}
                </p>
            </div>
        </div>

        <!-- 2. Blok (Ters sıralama sağda daire olacak şekilde) -->
        <div class="row align-items-center flex-md-row-reverse">
            <div class="col-md-2 d-flex justify-content-center">
                <div class="feature-circle-two bg-green">
                    <div class="feature-circle-little green">2</div>
                </div>
            </div>
            <div class="col-md-10 text-md-end text-start">
                <h5 class="fw-bold">ZƏMANƏT</h5>
                <p class="mb-0">
                    {!! empty(cache('siteData')) ? " " :cache('siteData')['settings']->warranty !!}
                </p>
            </div>
        </div>

        <!-- 3. Blok -->
        <div class="row align-items-center">
            <div class="col-md-2 d-flex justify-content-center">
                <div class="feature-circle-three bg-blue">
                    <div class="feature-circle-little">3</div>
                </div>
            </div>
            <div class="col-md-10">
                <h5 class="fw-bold">QİYMƏT</h5>
                <p class="mb-0">
                    {!! empty(cache('siteData')) ? " " : cache('siteData')['settings']->price !!}
                </p>
            </div>
        </div>

    </div>
</section>


<!-- /Services Section -->


