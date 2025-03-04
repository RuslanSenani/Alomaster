<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">

                        </div>
                        <!-- Dropzone Form -->
                        <form data-url="{{Route("portfolio.refresh-image-list",$portfolio->id)}}"
                              action="{{Route("portfolio.image-upload",$portfolio->id)}}" method="POST"
                              enctype="multipart/form-data" class="dropzone" id="fileUpload">
                            @csrf
                            <div class="dz-message">
                                <h5>{{$dropzoneMessage}}</h5>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            {{$portfolio->title}}
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 text-center">
                                <a href="{{route('portfolios.index')}}" class="btn btn-warning btn-block">
                                    <b>Geri</b>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- general form elements -->
                            @include('Front.Portfolios_v.image.render_element.image_list')

                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
