<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <b class="nav-link">{{$pageName}}</b>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <form action="{{ route('logout') }}" method="POST" class="form-inline">
            @csrf
            <li class="nav-item">
                <button class="btn btn-danger" type="submit">
                    <i class="fas fa-sign-out-alt"></i> Çıxış Et
                </button>
            </li>
        </form>
    </ul>

    {{--    <ul class="navbar-nav ml-auto">--}}
{{--        <!-- Navbar Search -->--}}
{{--        <form action="{{Route('logout')}}" method="POST">--}}
{{--            @csrf--}}
{{--            <li class="nav-item">--}}
{{--                <button class="nav-link" type="submit">--}}
{{--                    <i class="fas fa-sign-out-alt"></i>--}}
{{--                </button>--}}
{{--            </li>--}}
{{--        </form>--}}

{{--    </ul>--}}
</nav>
