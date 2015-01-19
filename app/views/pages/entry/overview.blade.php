@extends('layouts.main')

@section('page_title')
<i class="glyphicon glyphicon-th-list"></i> Overview
@stop

@section('content')
<table class="table table-striped small">
    <th>Id</th>
    <th>Time</th>
    <th>Author</th>
    <th>Database</th>
    <th>Category</th>
    <th>Title</th>
    <th>States</th>
    <th>Actions</th>
    @foreach($queries as $query)
    <tr title="{{ $query->title }}">
        <td>{{ $query->id }}</td>
        <td>{{ HTML::time_elapsed($query->created_at) }} ago</td>
        <td>{{ HTML::username($query->user_id) }}</td>
        <td>{{ $query->database->name }}</td>
        <td>{{ $query->category->name }}</td>
        <td><a href="{{ URL::route('entry_detail', ['id' => $query->id]) }}" title="{{ $query->title }}">{{ Str::limit($query->title, 45) }}</a></td>
        <td>{{ HTML::stateLabel($query->state_id) }}</td>
        <td>
            <a class="btn btn-default btn-xs" href="{{ URL::route('entry_detail', ['id' => $query->id]) }}">
                <i class="glyphicon glyphicon-pencil small"></i> Edit
            </a>
        </td>
    </tr>
    @endforeach
</table>
{{ $queries->links() }}
@stop
