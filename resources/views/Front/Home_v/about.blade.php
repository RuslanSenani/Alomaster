<section id="about" class="about section">


    <div class="container">

        <div class="row position-relative">


            <div class="col-lg-7 about-img" data-aos="zoom-out" data-aos-delay="200">

                @foreach($sliders as $slide)
                    <img src="{{asset($slide->img_url)}}" alt="">
                @endforeach

            </div>


            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="100">
                <div class="our-story">
                    {!! empty(cache('siteData')['settings']) ? " " :cache('siteData')['settings']->about_us !!}
                </div>
            </div>

        </div>

    </div>

</section>

