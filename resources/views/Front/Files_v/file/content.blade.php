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
                        <form data-url="{{route("files.refresh-file-list",$gallery->id)}}"
                              action="{{route("files.store")}}" method="POST"
                              enctype="multipart/form-data" class="dropzone" id="fileUpload">
                            <input value="{{$gallery->id}}" name="gallery_id" type="hidden">
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
                            {{"Qalerya Adı | ".$gallery->title}}

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 text-center">
                                <a href="{{route('galleries.index')}}" class="btn btn-warning btn-block">
                                    <b>Geri</b>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- general form elements -->
                            @include('Front.Files_v.file.render_element.image_list')

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
