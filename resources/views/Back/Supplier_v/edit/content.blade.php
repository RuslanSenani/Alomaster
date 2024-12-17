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
                        <form method="POST" action="{{Route("suppliers.update",$supplierList->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="row">


                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="name">Tədarükçü Adı:</label>
                                                <input type="text" value="{{old('name',$supplierList->name)}}" name="name"
                                                       class="form-control" id="name"
                                                       placeholder="Tədarükçü Adı">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="code">Tədarükçü Kodu:</label>
                                                <input type="text" value="{{old('code',$supplierList->code)}}" name="code"
                                                       class="form-control" id="code"
                                                       placeholder="Tədarükçü Kodu">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">


                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="email">Tədarükçü Email-i:</label>
                                                <input type="email" value="{{old('email',$supplierList->email)}}" name="email"
                                                       class="form-control" id="email"
                                                       placeholder="example@domain.com"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Tədarükçü Telefonu:</label>
                                                <input type="tel" value="{{old('phone',$supplierList->phone)}}" name="phone"
                                                       class="form-control" id="phone"
                                                       placeholder="(050) 822-07-22">
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
                                            <a href="{{Route("suppliers.index")}}" type="submit"
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
