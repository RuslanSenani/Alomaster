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
