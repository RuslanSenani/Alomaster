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
                <form action="">
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

                            @include('Front.Settings_v.edit.tabs.site_info')

                            @include('Front.Settings_v.edit.tabs.address')

                            @include('Front.Settings_v.edit.tabs.about_us')

                            @include('Front.Settings_v.edit.tabs.mission')

                            @include('Front.Settings_v.edit.tabs.vision')

                            @include('Front.Settings_v.edit.tabs.social')

                            @include('Front.Settings_v.edit.tabs.logo')

                        </div>
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
