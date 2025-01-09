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
                        <form method="POST" action="{{Route("stock-out.update",$stockOutList->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="from-group col-md-12">
                                    <div class="row">


                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="product">Məhsul Adı:</label>
                                                <select name="product" id="stockOut" class="form-control select2bs4">
                                                    <option value="" selected="selected"> --Məhsul Seç--
                                                    </option>
                                                    @foreach($stockInList as $stock)
                                                        <option
                                                            value="{{$stock->id}}" {{ old('product', $stockOutList->stock_in_id ?? '') == $stock->id ? 'selected' : '' }}>
                                                            {{$stock->product->product_name}}
                                                            - {{$stock->product->product_code}}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="warehouse">Anbar Adı:</label>
                                                <input type="text" value="{{old('warehouse',$stockOutList->warehouse_name)}}" name="warehouse"
                                                       class="form-control " id="warehouse"
                                                       placeholder="Anbar Adı" readonly>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="code">Məhsul Kodu:</label>
                                                <input type="text" value="{{old('code',$stockOutList->product_code)}}" name="code"
                                                       class="form-control " id="code"
                                                       placeholder="Məhsul Kodu" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="model">Məhsul Modeli:</label>
                                                <input type="text" value="{{old('model',$stockOutList->model_name)}}" name="model"
                                                       class="form-control " id="model"
                                                       placeholder="Məhsul Modeli" readonly>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="category">Məhsul Kateqoriyası:</label>
                                                <input type="text" value="{{old('category',$stockOutList->category_name)}}" name="category"
                                                       class="form-control " id="category"
                                                       placeholder="Məhsul Kateqoriası" readonly>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-3">

                                            <div class="form-group">
                                                <label for="unit">Məhsul Vahidi:</label>
                                                <input type="text" value="{{old('unit',$stockOutList->product_unit)}}" name="unit"
                                                       class="form-control " id="unit"
                                                       placeholder="Məhsul Vahidi" readonly>

                                            </div>

                                        </div>
                                        <div class="form-group col-md-3">

                                            <div class="form-group">
                                                <label for="salesPrice">Mehsul Satış Qiyməti:</label>
                                                <input type="text" value="{{old('salesPrice',$stockOutList->product_unit_sale_price)}}" name="salesPrice"
                                                       class="form-control" id="salesPrice"
                                                       placeholder="Mehsul Satış Qiyməti">
                                            </div>

                                        </div>

                                        <div class="form-group col-md-3">
                                            <div class="form-group">
                                                <label for="exitCount">Mehsul Çıxış Sayı:</label>
                                                <input type="text" value="{{old('exitCount',$stockOutList->qty)}}" name="exitCount"
                                                       class="form-control" id="exitCount"
                                                       placeholder="Mehsul Çıxış Sayı">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="row">

                                            <div class="col">
                                                <div class="form-group col-md-12">
                                                    <div class="form-group">
                                                        <label for="enterCount">Müştəri:</label>
                                                        <select name="customer" class="form-control select2bs4">
                                                            <option value="" selected="selected"> --Müştəri Seç--
                                                            </option>
                                                            @foreach($customerList as $customer)
                                                                <option
                                                                    value="{{$customer->id}}" {{ old('customer', $stockOutList->customer->id ?? '') == $customer->id ? 'selected' : '' }}>
                                                                    {{$customer->name}}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Mehsul Çıxış Tarixi:</label>
                                                    <div class="input-group date" id="reservationdate"
                                                         data-target-input="nearest">
                                                        <input name="date" value="{{\Carbon\Carbon::parse($stockOutList->exit_date)->format('m-d-Y')}}" type="text"
                                                               class="form-control datetimepicker-input"
                                                               data-target="#reservationdate"/>
                                                        <div class="input-group-append" data-target="#reservationdate"
                                                             data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="description">Məhsul Məlumati</label>
                                                <textarea id="description" class="form-control" name="description"
                                                          rows="8"
                                                          placeholder="Məhsul Məlumatlarını daxil edin"
                                                          readonly>{{old('description',$stockOutList->product_description)}}</textarea>
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="image">Məhsul Şəkli:</label>
                                                <img id="image"
                                                     alt="Seçilmiş Şəkli"
                                                     src="{{old('image',asset($stockOutList->product_img))}}"
                                                     class="img-thumbnail rounded mx-auto d-block"
                                                     style="width: 100%;height: 209px; display: none;">
                                                <input type="hidden" name="image" id="imagePath"
                                                       value="">
                                            </div>


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
                                        <a href="{{Route("stock-out.index")}}" type="submit"
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

