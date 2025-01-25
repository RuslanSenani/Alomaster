<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->


            <div class="card d-flex justify-content-between">

                <div class="card-header row">
                    <div class="col-md-10">

                    </div>
                    <div class="col-md-2 ">
                        <a href="{{Route("product.create")}}" type="button"
                           class="btn btn-block btn-outline-primary btn-sm">
                            <i class="fa fa-plus"></i> Giriş Et
                        </a>
                    </div>
                </div>


                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th><i class="fa-solid fa-list-ol"></i></th>
                            <th>#id</th>
                            <th>Başlıq</th>
                            <th>Url</th>
                            <th>Açıqlama</th>
                            <th>Status</th>
                            <th>Əməliyyatlar</th>
                        </tr>
                        </thead>
                        <tbody class="sortable">


                        @foreach($products as $product)
                            <meta name="csrf-token" content="{{ csrf_token() }}">

                            <tr id="ord-{{$product->id}}" data-url="{{url('product')}}">
                                <th><i class="fa-solid fa-list-ol"></i></th>
                                <td class="col-md-1">#{{$product->id}}</td>
                                <td class="col-md-3">{{$product->title}}</td>
                                <td class="col-md-3">{{$product->url}}</td>
                                <td class="col-md-3">{{$product->description}}</td>
                                <td class="col-md-2">
                                    <label class="toggle">
                                        <input type="checkbox" id="btnToggle"
                                               name="isActive" {{ $product->isActive ? 'checked' : '' }} />
                                        <span class="slider"></span>
                                    </label>
                                </td>
                                <td class="col-md-1">

                                    <form id="delete-form" action="{{ Route('product.destroy', $product->id) }}"
                                          method="POST">
                                        <div class="d-flex justify-content-between" role="group">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete-button"
                                                    class="btn btn-outline-danger btn-md"><i class="fa fa-trash"></i>
                                            </button>
                                            <a href="{{Route('product.edit',$product->id)}}"
                                               class="btn btn-outline-primary btn-md"> <i class="fa fa-edit"></i> </a>
                                        </div>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
