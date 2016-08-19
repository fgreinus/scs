<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-toggle"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('overview') }}">
                SQL Contribution System
            </a>
        </div>
    </div><!-- /container -->
</div>
<!-- /Header -->

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

@yield('content')

</div><!--/container-->
<!-- /Main -->

@include('includes.footer')

</body>
</html>
