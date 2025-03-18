<!-- Page Title -->
<div class="page-title accent-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Xidmətlər</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{route('work-area')}}">Əsas</a></li>
                <li class="current">Xidmətlər</li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->


<!-- Services Section -->
<section id="services" class="services section light-background">


    <div class="container section-title" data-aos="fade-up">
        <h2>Xidmətlər</h2>
    </div>
    <div class="container">

        <div class="row gy-4">

            @foreach($services as $service)

                <div class="col-lg-4 col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item item-cyan position-relative">
                        <div class="icon">
                            <img src="{{asset($service->img_url)}}" alt="Icon">

                        </div>
                        <a class="stretched-link">
                            <h3>{{$service->title}}</h3>
                        </a>
                        <p class="elementor-image-box-description">{!! $service->description !!}</p>
                    </div>
                </div>

            @endforeach

        </div>

    </div>

</section>

<!-- /Services Section -->


<section id="clients" class="clients section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Müştərilər</h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0 clients-wrap">
            @foreach($references as $reference)
                <div class="col-xl-3 col-md-4 client-logo">
                    <img
                        src="{{asset($reference->img_url)}}"
                        class="img-fluid" alt="">
                </div><!-- End Client Item -->
            @endforeach
        </div>


    </div>

</section>
