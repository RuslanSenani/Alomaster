<!-- Content Wrapper. Contains edit content -->
<hr>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{Route("product.update",$product->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="col">


                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="url">Url:</label>
                                                    <input type="text" value="{{$product->url}}"
                                                           name="url"
                                                           class="form-control" id="url"
                                                           placeholder="Url">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="title">Başlıq:</label>
                                                    <input type="text" value="{{$product->title}}"
                                                           name="title"
                                                           class="form-control" id="title"
                                                           placeholder="Başlıq">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="description">Açıqlama:</label>
                                                <input type="text" value="{{$product->description}}" name="description"
                                                       class="form-control" id="description"
                                                       placeholder="Açıqlama">
                                            </div>
                                        </div>


                                    </div>
                                </div>


                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <button type="submit" class="btn  btn-outline-primary btn-md"><i
                                                    class="fa fa-check" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="{{Route("product.index")}}" type="submit"
                                               class="btn  btn-outline-danger btn-md"><i class="fa fa-window-close"
                                                                                         aria-hidden="true"></i>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
