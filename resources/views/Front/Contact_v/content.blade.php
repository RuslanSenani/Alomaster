<!-- Page Title -->
<div class="page-title accent-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Əlaqə</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="{{route('work-area')}}">Əsas</a></li>
                <li class="current">Əlaqə</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<!-- Contact Section -->
<section id="contact" class="contact section">
    <div class="container" data-aos="fade">
        <div class="mb-5">
            <iframe style="width: 100%; height: 400px;"
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d527.2995955103809!2d50.11804147717923!3d40.50856166456951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1str!2saz!4v1741957322125!5m2!1str!2saz"
                    frameborder="0" allowfullscreen=""></iframe>

        </div><!-- End Google Maps -->
        <div class="row gy-5 gx-lg-5">

            <div class="col-lg-4">

                <div class="info">
                    <h3>Bizimlə Əlaqə</h3>
                    {{--                    <p>Bizimlə əlaqə</p>--}}

                    <div class="info-item d-flex">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                            <h4>Adres:</h4>
                            <p>{{empty(cache('settings')) ? "Adres" : cache('settings')->address}}</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                            <h4>Mail:</h4>
                            <p>{{empty(cache('settings')) ? "Mail"  : cache('settings')->email}}</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex">
                        <i class="bi bi-whatsapp flex-shrink-0"></i>
                        <div>
                            <h4>Telefon / Whatsapp :</h4>
                            <p>{{empty(cache('settings')) ? "Telefon / Whatsapp " : cache('settings')->phone_1}}</p>
                        </div>
                    </div>


                    <!-- End Info Item -->

                </div>

            </div>

            <div class="col-lg-8">

                <form action="{{Route('contact.store')}}" method="POST" class="php-email-forms">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   id="name" value="{{old('name')}}"
                                   placeholder="Adınız"
                                   required="">

                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group">
                            <input type="text" name="phone" value="{{old('phone')}}"
                                   class="form-control @error('phone') is-invalid @enderror" id="phone"
                                   placeholder="Telofonunuz"
                                   required="">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{old('email')}}" id="email"
                                   placeholder="Email Adresiniz"
                                   required="">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control @error('subject') is-invalid @enderror"
                               value="{{old('subject')}}" name="subject" id="subject"
                               placeholder="Mövzu"
                               required="">
                        @error('subject')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <textarea class="form-control @error('message') is-invalid @enderror" name="message"
                                  placeholder="Mesaj"
                                  required="">{{old('message')}}</textarea>
                        @error('message')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    @if(session('success'))
                        <div class="alert alert-success success-message">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <button type="submit">Mesaj Göndər</button>
                    </div>
                </form>

            </div><!-- End Contact Form -->

        </div>

    </div>

</section><!-- /Contact Section -->
