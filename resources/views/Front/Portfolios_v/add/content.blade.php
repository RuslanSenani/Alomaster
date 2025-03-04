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
                        <form method="POST" action="{{Route("portfolios.store")}}">
                            @csrf
                            <div class="card-body">

                                <div class="from-group col-md-12">

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <div class="form-group">
                                                <label for="title">Başlıq:</label>
                                                <input type="text" value="{{old('title')}}"
                                                       name="title"
                                                       class="form-control" id="title"
                                                       placeholder="Başlıq">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="enterCount">Kateqoriya:</label>
                                            <select name="category_id" class="form-control select2bs4">
                                                <option value="" selected> --Kateqoriya Seç--
                                                </option>
                                                @foreach($portfoliosCategories as $portfoliosCategory)
                                                    <option value="{{ $portfoliosCategory->id }}"
                                                        {{ (old('supplier', $portfolioList->category_id ?? '') == $portfoliosCategory->id) ? 'selected' : '' }}>
                                                        {{ $portfoliosCategory->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>Bitirmə Tarixi:</label>
                                            <div class="input-group date" id="reservationdate"
                                                 data-target-input="nearest">
                                                <input name="finishedAt" type="text"
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

                                        <div class="col-md-8">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Müştəri:</label>
                                                        <input type="text" value="{{old('client')}}"
                                                               name="client"
                                                               class="form-control" id="client"
                                                               placeholder="Müştəri">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="place">Yer/Məkan:</label>
                                                        <input type="text" value="{{old('place')}}"
                                                               name="place"
                                                               class="form-control" id="place"
                                                               placeholder="Yer/Məkan">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label for="portfolio_url">Görülən işin linki (URL):</label>
                                                            <input type="text" value="{{old('portfolio_url')}}"
                                                                   name="portfolio_url"
                                                                   class="form-control" id="url"
                                                                   placeholder="İnternetdə görülən işə keçid.">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label for="description">Açıqlama:</label>
                                        <textarea id="description" name="description" placeholder="Açıqlama">               {{old('description')}}
                                                </textarea>

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
                                            <a href="{{Route("portfolios.index")}}" type="submit"
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
