<!-- Content Wrapper. Contains page content -->
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
                        <form method="POST" action="{{Route("models.update",$model->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="row">



                                        <div class="form-group col-md-12">
                                            <div class="form-group">
                                                <label for="modelName">Model Adı:</label>
                                                <input type="text" value="{{$model->name}}" name="modelName" class="form-control" id="modelName"
                                                       placeholder="Model Adı">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <button type="submit" class="btn  btn-outline-primary btn-md">Yenilə</button>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="{{Route("models.index")}}" type="submit" class="btn  btn-outline-danger btn-md">Ləğv Et</a>
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
