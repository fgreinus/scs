@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form class="form-signin" role="form" action="{{ URL::to('login') }}" method="post">
            <h2 class="form-signin-heading">Please sign in first</h2>
            <div class="form-group">
                <input name="inputUsername" id="inputUsername" type="text" class="form-control" placeholder="Your LDAP-Username" required autofocus
                    data-toggle="popover"
                    data-content="This is <strong>not</strong> your LDAP-DN! It's just your username - somethink like <strong>jeffstrongman</strong>."
                >
            </div>
            <div class="form-group">
                <input name="inputPassword" id="inputPassword" type="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </div>
        </form>
    </div>
</div>
@stop
