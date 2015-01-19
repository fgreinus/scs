<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
@include('includes.header')
<!-- Main -->
<div class="container">
@foreach($errors->get('error') as $msg)
    {{ Toastr::error($msg) }}
@endforeach
@foreach($errors->get('warning') as $msg)
    {{ Toastr::warning($msg) }}
@endforeach
@foreach($errors->get('info') as $msg)
    {{ Toastr::info($msg) }}
@endforeach
@foreach($errors->get('success') as $msg)
    {{ Toastr::success($msg) }}
@endforeach

@if (Auth::check())
<!-- upper section -->
<div class="row">
    @if(!isset($sidebarDisabled) || !$sidebarDisabled)
    <div class="col-sm-8">
    @else
    <div class="col-sm-12">
    @endif
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
    @if(!isset($sidebarDisabled) || !$sidebarDisabled)
    <div class="col-sm-4">
        <h3><i class="glyphicon glyphicon-time"></i> Changelog</h3>
        <br>
        @include('includes.sidebar')
        <br>
        @if(isset($redmineInfoEnabled) && $redmineInfoEnabled)
            @include('includes.redmineInfo')
        @endif
    </div>
    @endif

</div><!--/row-->
<!-- /upper section -->
@else
    @yield('content')
@endif

</div><!--/container-->
<!-- /Main -->

@include('includes.footer')

</body>
</html>
