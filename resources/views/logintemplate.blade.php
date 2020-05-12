<!DOCTYPE html>
<html lang="en" dir="">

@include('head')
@yield('additionalcss')

<body class="text-left" style="background-color: #10B3B6;">
@yield('loading-bar')
    <div class="app-admin-wrap layout-horizontal-bar">
        <div class="main-content-wrap d-flex flex-column" style="background-color: #10B3B6;">
            <div class="main-content">
                @yield('content')
            </div>
        </div>
    </div>
    @include('allscript')
    @yield('additionalscript')
</body>

</html>

@yield('script')
@yield('scriptmodal')