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
