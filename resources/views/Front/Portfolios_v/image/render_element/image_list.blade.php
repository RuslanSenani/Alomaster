<table class="table table-bordered table-striped image-list-container">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <thead>
    <tr>
        <th><i class="fa-solid fa-list-ol"></i></th>
        <th>#id</th>
        <th>Şəkil</th>
        <th>Şəkil Adı</th>
        <th>Status</th>
        <th>Əməliyyatlar</th>
    </tr>
    </thead>
    <tbody class="sortable">
    @foreach($portfolioImage as $image)
        <tr id="ord-{{$image->id}}" data-url="{{route('ajax-rankSetter-portfolio-image')}}">
            <th><i class="fa-solid fa-list-ol"></i></th>
            <th class="col-md-1">{{$image->id}}</th>
            <th class="col-md-1">
                <img width="50"
                     src="{{asset($directoryPath."/".$image->img_url)}}"
                     alt="" class="img-responsive">
            </th>
            <th class="col-md-8">{{basename($image->img_url)}}</th>
            <td class="col-md-1" style="text-align: center">
                <label class="toggle">
                    <input type="checkbox" class="isActive"
                           data-url="{{route('ajax.is-active-setter-portfolio-image',$image->id)}}"
                           name="isActive" {{ $image->isActive ? 'checked' : '' }}/>

                    <span class="slider"></span>
                </label>
            </td>
            <td class="col-md-1" style="text-align: center">
                <button type="submit" id="delete-button"
                        data-url="{{route('portfolioImages.destroy',$image->id)}}"
                        class="btn btn-outline-danger btn-md remove-btn">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach

    </tbody>


</table>

