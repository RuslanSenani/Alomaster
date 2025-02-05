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
                        <form data-url="{{Route("product.refresh-image-list",$product->id)}}"
                              action="{{Route("product.image-upload",$product->id)}}" method="POST"
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
                            {{$product->title}}
                        </div>
                        <div class="card-body">
                            <!-- general form elements -->
                            @include('Front.Product_v.image.render_element.image_list')

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
