<!DOCTYPE html>
<html lang="en" dir="">

@include('head')
@yield('additionalcss')

<body class="text-left">
    <div id="loadingcontainer">
        <div id="innercontainer">
            <center>
                <span id="loaders" class="spinner-glow spinner-glow-dark mr-5"></span>  
                <h2>Loading...</h2>
            </center>
        </div>
    </div>
    <div class="app-admin-wrap layout-horizontal-bar">
        @include('mainheader')
        @include('horizontalbar')
        <div class="main-content-wrap d-flex flex-column" style="background-color: #ededed;">
            <div class="main-content">
                @yield('content')
            </div>
            @include('footer')
        </div>
    </div>
    @include('allscript')
    @yield('additionalscript')
</body>

</html>

@yield('script')
@yield('scriptmodal')