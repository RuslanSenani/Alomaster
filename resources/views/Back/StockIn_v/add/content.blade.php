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
                            <h3 class="card-title">{{$pageName}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{Route("stock-in.store")}}">
                            @csrf
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="row">

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label>Anbar Adı:</label>
                                                <select name="warehouse" class="form-control select2bs4">
                                                    <option value="" selected="selected"> --Anbar Seç--</option>
                                                    @foreach($warehouseList as $warehouse)
                                                        <option
                                                            value="{{$warehouse->id}}" {{ old('warehouse', $stockList->warehouse_id ?? '') == $warehouse->id ? 'selected' : '' }}>{{$warehouse->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="product">Məhsul Adı:</label>
                                                <select id="product" name="product" class="form-control select2bs4">
                                                    <option value="" selected="selected"> --Məhsul Seç--</option>
                                                    @foreach($productList as $product)
                                                        <option
                                                            value="{{$product->id}}" {{ old('product', $stockList->product_id ?? '') == $product->id ? 'selected' : '' }}>{{$product->product_name}}
                                                            - {{$product->product_code}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="code">Məhsul Kodu:</label>
                                                <input type="text" value="{{old('code')}}" name="code"
                                                       class="form-control " id="code"
                                                       placeholder="Məhsul Kodu" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label>Məhsul Modeli:</label>
                                                <select name="model" class="form-control select2bs4">
                                                    <option value="" selected="selected"> --Model Seç--</option>
                                                    @foreach($modelList as $model)
                                                        <option
                                                            value="{{$model->id}}" {{ old('model', $stockList->model_id ?? '') == $model->id ? 'selected' : '' }}> {{$model->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label>Məhsul Kateqoriyası:</label>
                                                <select name="category" class="form-control select2bs4">
                                                    <option value="" selected="selected"> --Kateqoriya Seç--</option>
                                                    @foreach($categoryList as $category)
                                                        <option
                                                            value="{{$category->id}}" {{ old('category', $stockList->category_id ?? '') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">

                                            <div class="form-group">
                                                <label for="unit">Məhsul Vahidi:</label>
                                                <input type="text" value="{{old('unit')}}" name="unit"
                                                       class="form-control " id="unit"
                                                       placeholder="Məhsul Vahidi" readonly>

                                            </div>

                                        </div>

                                        <div class="form-group col-md-3">

                                            <div class="form-group">
                                                <label for="unitPrice">Məhsul Vahid Qiyməti:</label>
                                                <input type="text" value="{{old('unitPrice')}}" name="unitPrice"
                                                       class="form-control" id="unitPrice"
                                                       placeholder="Məhsul Vahid Qiyməti">
                                            </div>

                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="enterCount">Məhsul Giriş Sayı:</label>
                                                <input type="text" value="{{old('enterCount')}}" name="enterCount"
                                                       class="form-control" id="enterCount"
                                                       placeholder="Məhsul Giriş Sayı">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="enterCount">Tədarükçü:</label>
                                                <select name="supplier" class="form-control select2bs4">
                                                    <option value="" selected> --Tədarükçü Seç--
                                                    </option>
                                                    @foreach($supplierList as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            {{ (old('supplier', $stockList->supplier_id ?? '') == $supplier->id) ? 'selected' : '' }}>
                                                            {{ $supplier->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Məhsul Giriş Tarixi:</label>
                                            <div class="input-group date" id="reservationdate"
                                                 data-target-input="nearest">
                                                <input name="date" type="text"
                                                       class="form-control datetimepicker-input"
                                                       data-target="#reservationdate"/>
                                                <div class="input-group-append"
                                                     data-target="#reservationdate"
                                                     data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i
                                                            class="fa fa-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="description">Məhsul Məlumati</label>
                                            <textarea id="descr" class="form-control"
                                                      name="description"
                                                      rows="8"
                                                      placeholder="Məhsul Məlumatı"
                                                      readonly>{{old('description')}}</textarea>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="image">Məhsul Şəkli:</label>
                                            <img id="image"
                                                 alt="Seçilmiş Şəkli"
                                                 src="{{old('image',asset("assets/dist/img/chosePhoto.png"))}}"
                                                 class="img-thumbnail rounded mx-auto d-block"
                                                 style="width: 100%;height: 209px; display: none;">
                                            <input type="hidden" name="image" id="imagePath"
                                                   value="">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!-- /.card-body -->

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-1">
                                        <button type="submit" class="btn  btn-outline-primary btn-md">Saxla</button>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{Route("stock-in.index")}}" type="submit"
                                           class="btn  btn-outline-danger btn-md">Ləğv Et</a>
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

