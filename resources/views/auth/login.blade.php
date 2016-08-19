@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form class="form-signin" role="form" action="{{ route('auth.login') }}" method="post">
                <h2 class="form-signin-heading">Please sign in first</h2>
                <div class="form-group">
                    <input name="inputUsername" id="inputUsername" type="text" class="form-control"
                           placeholder="{{ trans('auth.login.placeholder.username') }}" required autofocus
                           data-toggle="popover">
                </div>
                <div class="form-group">
                    <input name="inputPassword" id="inputPassword" type="password" class="form-control"
                           placeholder="{{ trans('auth.login.placeholder.password') }}" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block"
                            type="submit">{{ trans('auth.login.button.login') }}</button>
                </div>
            </form>
        </div>
    </div>
@stop
