<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        {{$pageName}}
                    </h3>
                </div>
                <form action="{{route("settings.update",$setting->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-site-info-tab" data-toggle="pill"
                                   href="#custom-content-below-site-info" role="tab"
                                   aria-controls="custom-content-below-site-info"
                                   aria-selected="true">Sayt Məlumatları</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-address-tab" data-toggle="pill"
                                   href="#custom-content-below-address" role="tab"
                                   aria-controls="custom-content-below-address"
                                   aria-selected="true">Adres Məlumatları</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-about-us-tab" data-toggle="pill"
                                   href="#custom-content-below-about-us" role="tab"
                                   aria-controls="custom-content-blow-about-us"
                                   aria-selected="true"> Hakkimizda </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-mission-tab" data-toggle="pill"
                                   href="#custom-content-below-mission" role="tab"
                                   aria-controls="custom-content-blow-mission"
                                   aria-selected="true"> Missyamız </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-vision-tab" data-toggle="pill"
                                   href="#custom-content-below-vision" role="tab"
                                   aria-controls="custom-content-blow-vision"
                                   aria-selected="true"> Vizyonumuz </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-price-tab" data-toggle="pill"
                                   href="#custom-content-below-price" role="tab"
                                   aria-controls="custom-content-blow-price"
                                   aria-selected="true"> Qiymet Melumati </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-quality-tab" data-toggle="pill"
                                   href="#custom-content-below-quality" role="tab"
                                   aria-controls="custom-content-blow-quality"
                                   aria-selected="true"> Keyfiyyət Məlumatı </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-warranty-tab" data-toggle="pill"
                                   href="#custom-content-below-warranty" role="tab"
                                   aria-controls="custom-content-blow-warranty"
                                   aria-selected="true"> Zəmanət Məlumatı </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-social-tab" data-toggle="pill"
                                   href="#custom-content-below-social" role="tab"
                                   aria-controls="custom-content-blow-social"
                                   aria-selected="true"> Sosyal Medya </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-logo-tab" data-toggle="pill"
                                   href="#custom-content-below-logo" role="tab"
                                   aria-controls="custom-content-blow-logo"
                                   aria-selected="true"> Logo </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">

                            @include('Back.FSettings_v.edit.tabs.site_info')

                            @include('Back.FSettings_v.edit.tabs.address')

                            @include('Back.FSettings_v.edit.tabs.about_us')

                            @include('Back.FSettings_v.edit.tabs.mission')

                            @include('Back.FSettings_v.edit.tabs.vision')

                            @include('Back.FSettings_v.edit.tabs.price')

                            @include('Back.FSettings_v.edit.tabs.quality')

                            @include('Back.FSettings_v.edit.tabs.warranty')

                            @include('Back.FSettings_v.edit.tabs.social')

                            @include('Back.FSettings_v.edit.tabs.logo')


                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Yenilə</button>
                    </div>
                </form>
                <!-- /.card -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
