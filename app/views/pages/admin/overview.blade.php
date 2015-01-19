@extends('layouts.main')

@section('page_title')
<i class="glyphicon glyphicon-wrench"></i> Administration
@stop

@section('content')
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#users" role="tab" data-toggle="tab">Users <span class="badge">{{ count($users) }}</span></a></li>
    <li><a href="{{ URL::route('admin_roles') }}" role="tab">Roles & Permissions</a></li>
</ul>

<div class="tab-content">
    <div id="users" class="tab-pane active">
        <br>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First login</th>
                <th>LDAP-DN</th>
                <th>Roles</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ HTML::username($user->id)}}</td>
                <td>{{ $user->created_at }}</td>
                <td><span class="small">{{ $user->ldapdn }}</span></td>
                <td>
                    {{ Form::open(['route' => ['admin_userroles_save', $user->id]]) }}
                    <select class="selectpicker" name="roles[]" multiple>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            @if($user->hasRole($role->name))
                             selected
                            @endif
                        >{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success btn-sm" type="submit" name="submit"><i class="glyphicon glyphicon-ok"></i></button>
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </table>

    </div>
</div>
@stop
