@php
    $id = Auth::id();

    if (isset($id)){
        $name = Auth::user()->name;
    }else{
        $name = "Guest";
    }
@endphp
<div class="main-header">
<div class="logo"><a href="{{ url('/') }}"><img src="{{ URL::asset('img/logo.png') }}" alt="" /></a></div>
    <div><a href="{{ url('/') }}"><h4><span class="full-text">Timesheet Lite Data Center</span><span class="short-text">Timesheet Lite DC</span></h4></a></div>
    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div style="margin: auto"></div>
    <div class="header-part-right">
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen=""></i>
        <div class="dropdown">
            <div class="user col align-self-end">
                <img src="{{ URL::asset('img/users.png') }}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                        <i class="i-Lock-User mr-1"></i> Welcome, {{ $name }}
                    </div>
                    <a class="dropdown-item" href="{{ url('/logout') }}">Sign out</a>
                </div>
            </div>
        </div>
    </div>
</div>