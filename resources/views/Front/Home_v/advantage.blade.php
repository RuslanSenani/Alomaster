<section id="clients" class="clients section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>ÜSTÜNLÜKLƏR</h2>
    </div><!-- End Section Title -->

    <div class="container my-5">
        <div class="row justify-content-center text-start gy-4">

            <!-- 1. Özellik -->
            <div class="col-md-4 d-flex align-items-start gap-3">
                <div class="feature-circle-one bg-blue">
                    <div class="feature-circle-little">1</div>
                </div>

                <div>
                    <h5 class="fw-bold">KEYFİYYƏT</h5>
                    <p class="mb-0">
                        {!!empty(cache('siteData')['settings']) ? " " :cache('siteData')['settings']->quality !!}
                    </p>
                </div>
            </div>

            <!-- 2. Özellik -->
            <div class="col-md-4 d-flex align-items-start gap-3">
                <div class="feature-circle-two bg-green">
                    <div class="feature-circle-little green">2</div>
                </div>

                <div>
                    <h5 class="fw-bold">ZƏMANƏT</h5>
                    <p class="mb-0">
                        {!!empty(cache('siteData')['settings']) ? " " : cache('siteData')['settings']->warranty !!}
                    </p>
                </div>
            </div>

            <!-- 3. Özellik -->
            <div class="col-md-4 d-flex align-items-start gap-3">
                <div class="feature-circle-three bg-blue">
                    <div class="feature-circle-little">3</div>
                </div>

                <div>
                    <h5 class="fw-bold">QİYMƏT</h5>
                    <p class="mb-0">
                        {!! empty(cache('siteData')['settings']) ? " " : cache('siteData')['settings']->price !!}
                    </p>
                </div>
            </div>

        </div>
    </div>

</section>
