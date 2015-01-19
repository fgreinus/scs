@extends('layouts.main')

@section('page_title')
<i class="glyphicon glyphicon-search"></i> Search results for '{{ $query }}'
@stop

@section('content')

<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#entries" role="tab" data-toggle="tab">Entries <span class="badge">{{ count($entries) }}</span></a></li>
    <li><a href="#changes" role="tab" data-toggle="tab">Changes  <span class="badge">{{ count($entryLogs) }}</span></a></li>
</ul>

<div class="tab-content">
    <div id="entries" class="tab-pane active">
        <br>
        <table class="table table-striped small">
            <tr>
                <th>Id</th>
                <th>Time</th>
                <th>Author</th>
                <th>Database</th>
                <th>Category</th>
                <th>Title</th>
                <th>States</th>
                <th>Actions</th>
            </tr>
            @forelse($entries as $query)
                <tr title="{{ $query->title }}">
                    <td>{{ $query->id }}</td>
                    <td>{{ HTML::time_elapsed($query->created_at) }} ago</td>
                    <td>{{ HTML::username($query->user_id) }}</td>
                    <td>{{ $query->database->name }}</td>
                    <td>{{ $query->category->name }}</td>
                    <td>{{ Str::limit($query->title, 45) }}</td>
                    <td>{{ HTML::stateLabel($query->state_id) }}</td>
                    <td>
                        <a class="btn btn-default btn-xs" href="{{ URL::route('entry_detail', ['id' => $query->id]) }}">
                            <i class="glyphicon glyphicon-pencil small"></i> Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">No related entries found.</td>
                </tr>
            @endforelse
        </table>
    </div>

    <div id="changes" class="tab-pane">
        <br>
        <table class="table table-striped small">
            <tr>
                <th>Id</th>
                <th>Time</th>
                <th>Changer</th>
                <th>Note</th>
                <th>Title</th>
                <th>Action</th>
                <th>Actions</th>
            </tr>
            @forelse($entryLogs as $log)
                <tr title="{{ $log->note }}">
                    <td>{{ $log->entry->id }}</td>
                    <td>{{ HTML::time_elapsed($log->created_at) }} ago</td>
                    <td>{{ HTML::username($log->user_id) }}</td>
                    <td>{{ $log->note }}</td>
                    <td>{{ Str::limit($log->entry->title, 45) }}</td>
                    <td>{{ HTML::actionLabel($log->action_id) }}</td>
                    <td>
                        @if($log->entry->trashed())
                        Entry deleted
                        @else
                        <a class="btn btn-default btn-xs" href="{{ URL::route('entry_detail', ['id' => $log->entry->id]) }}">
                            <i class="glyphicon glyphicon-pencil small"></i> Edit
                        </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">No related logs found.</td>
                </tr>
            @endforelse
        </table>
    </div>
</div>

@stop