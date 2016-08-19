<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
@include('includes.header')
<!-- Main -->
<div class="container">
<!-- upper section -->
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="pull-left">@yield('page_title')</h3>
                <div class="text-right">
                @yield('menu_actions')
                </div>
            </div>
        </div>
        <br>
        <div class="clearfix"></div>
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>

</div>

@include('includes.footer')

</body>
</html>
