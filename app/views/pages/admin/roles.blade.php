@extends('......layouts.main')

@section('page_title')
<i class="glyphicon glyphicon-wrench"></i> Administration
@stop

@section('content')
<ul class="nav nav-tabs" role="tablist">
    <li><a href="{{ URL::route('admin') }}" role="tab">Users <span class="badge">{{ count($users) }}</span></a></li>
    <li class="active"><a href="{{ URL::route('admin_roles') }}" role="tab" data-toggle="tab">Roles & Permissions</a></li>
</ul>

<div class="tab-content">
    <div id="states" class="tab-pane active">
        <br>
        {{ Form::open(['route' => 'admin_roles_save']) }}
        {{ Form::token() }}
        <table class="table table-bordered table-striped">
            <tr>
                <th>Role</th>
            @foreach($permissions as $permission)
                <th>
                    <span data-toggle="tooltip" data-original-title="{{ $permission->display_name }}">
                        {{ $permission->name }}
                    </span>
                </th>
            @endforeach
                <th>Actions</th>
            </tr>

            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                @foreach($permissions as $permission)
                <td>
                    <label for="rolepermission_{{ $role->id }}_{{ $permission->id }}" class="role-checkbox-label">
                        <input type="checkbox" id="rolepermission_{{ $role->id }}_{{ $permission->id }}"
                            name="rolepermission_{{ $role->id }}_{{ $permission->id }}"
                            @if($role->hasPermission($permission->id))
                             checked
                            @endif
                            value="1"
                            >
                    </label>
                </td>
                @endforeach
                <td>
                    <button type="button" class="btn btn-info btn-xs check-all"><i class="glyphicon glyphicon-ok-circle"></i></button>
                    <button type="button" class="btn btn-info btn-xs check-none"><i class="glyphicon glyphicon-remove-circle"></i></button>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="{{ count($permissions) + 2 }}">
                    <input class="btn btn-info" type="submit" name="submit" value="Save">
                </td>
            </tr>
        </table>
        {{ Form::close() }}
    </div>
</div>
@stop

@section('custom-js')
<script type="text/javascript">

(function() {

    $('.check-all').click(function() {
        $(this).parents('tr').find('input[type="checkbox"]').prop('checked', true);
    });

    $('.check-none').click(function() {
        $(this).parents('tr').find('input[type="checkbox"]').prop('checked', false);
    });

})();

</script>
@stop