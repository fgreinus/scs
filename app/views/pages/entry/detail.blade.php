@extends('layouts.main')

@section('page_title')
<i class="glyphicon glyphicon-edit"></i> Entry details
@stop

@section('menu_actions')
<div class="btn-group">
    @if($canEdit)
    <a class="btn btn-info" onclick="$('#entry_form').submit();return false;"><i class="glyphicon glyphicon-save small"></i> Save</a>
    @endif
    @if($canDelete)
    <a class="btn btn-danger confirm" data-confirm="Really want to delete this entry?" href="{{ URL::route('entry_remove', $entry->id) }}"><i class="glyphicon glyphicon-remove small"></i> Delete</a>
    @endif
    <div class="btn-group">
        <button type="button"
            @if($canManage)
                class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-tag small"></i> Change state {{ HTML::stateLabel($entry->state_id) }}
                <span class="caret"></span>
            @else
                class="btn btn-default">
                <i class="glyphicon glyphicon-tag small"></i> State is {{ HTML::stateLabel($entry->state_id) }}
            @endif
        </button>
        @if($canManage)
            <ul class="dropdown-menu" role="menu">
            @foreach($states as $state)
                <li role="presentation"@if($entry->state->id == $state->id)class="active"@endif>
                    <a role="menuitem" tabindex="-1" href="{{ URL::route('entry_changestate', ['id' => $entry->id, 'state' => $state->id]) }}">
                        {{ HTML::stateLabel($state->id) }}
                    </a>
                </li>
            @endforeach
            </ul>
        @endif
    </div>
</div>
@stop

@section('content')
<ul class="pager small">
    <li class="previous
        @if(empty($olderUrl))
         disabled
        @endif">
        <a
            @if(!empty($olderUrl))
                href="{{ $olderUrl }}"
            @endif
            >&larr; Older
        </a>
    </li>
    <li class="next
        @if(empty($newerUrl))
         disabled
        @endif
        ">
        <a
            @if(!empty($newerUrl))
                href="{{ $newerUrl }}"
            @endif
            >Newer &rarr;
        </a>
    </li>
</ul>
{{ Form::open(['route' => ['entry_save', $entry->id], 'id' => 'entry_form']) }}
<table class="table table-striped">
    <tr>
        <td>ID:</td>
        <td>{{{ $entry->id }}}</td>
    </tr>
    <tr>
        <td><label for="title">Title:</label></td>
        @if($canEdit)
            <td><input type="text" id="title" class="form-control input-sm" name="title" value="{{{ $entry->title }}}"></td>
        @else
            <td>{{{ $entry->title }}}</td>
        @endif
    </tr>
    <tr>
        <td><label for="ticket_id">Ticket:</label></td>
        @if($canEdit)
            <td><input type="text" id="ticket_id" class="form-control input-sm" name="ticket_id" value="{{{ $entry->ticket_id }}}"></td>
        @else
            <td><span class="form-control-static">{{{ $entry->ticket_id }}}</span></td>
        @endif
    </tr>
    <tr>
        <td><label for="author">Author:</label></td>
        <td>
            @if($canEdit)
                <select name="author" id="author">
                @foreach($userList as $user)
                    <option value="{{ $user->id }}"@if($entry->user_id == $user->id) selected @endif>{{ $user->username }}</option>
                @endforeach
                </select>
            @else
                {{ $entry->user->username }}
            @endif
            &nbsp;&lt;<a href="xmpp:{{ $entry->user->username }}@jabber.rising-gods.de">{{ $entry->user->username }}@jabber.rising-gods.de</a>&gt;
        </td>
    </tr>
    <!-- Select Basic -->
    <tr>
        <td><label class="control-label" for="database_id">Datenbank</label></td>
        <td>
            @if($canEdit)
                <select id="database_id" name="database_id">
                    @foreach($databasesByType as $type => $databases)
                        <optgroup label="{{ $type }}">
                            @foreach($databases as $database)
                                <option value="{{ $database->id }}"
                                    @if($database->id == $entry->database->id)
                                     selected
                                    @endif
                                >{{ $database->name }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            @else
                {{ $entry->database->name }}
            @endif
        </td>
    </tr>

    <!-- Select Basic -->
    <tr>
        <td><label class="control-label" for="category_id">Kategorie</label></td>
        <td>
            @if($canEdit)
                <select id="category_id" name="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                             @if($category->id == $entry->category->id)
                              selected
                             @endif
                        >{{ $category->name }}</option>
                    @endforeach
                </select>
            @else
                {{ $entry->category->name }}
            @endif
        </td>
    </tr>
    <tr>
        <td>Created at:</td>
        <td>{{{ \Carbon\Carbon::parse( $entry->created_at )->format('d.m.Y H:i:s') }}}</td>
    </tr>
    <tr>
        <td>Last update:</td>
        <td>{{{ \Carbon\Carbon::parse( $entry->updated_at_at )->format('d.m.Y H:i:s') }}}</td>
    </tr>
</table>

<div class="clearfix"></div>

<div class="panel panel-default">
    <div class="panel-heading">
        <label class="control-label" for="queries">Queries</label>
    </div>
    <div class="panel-collapse collapse in">
        <div class="panel-body">
            <div class="controls">
                <textarea class="form-control textarea-highlight" data-mode="text/x-mysql"
                @if(!$canEdit)
                 data-conf="readOnly"
                @endif
                id="queries" name="queries" rows="5">{{ $entry->queries }}</textarea>
            </div>
        </div>
    </div>
</div>
<br>
<div class="panel panel-default">
    <div class="panel-heading">
        <label class="control-label" for="revert_queries">Revert Queries</label>
        <button type="button" class="btn btn-default btn-xs spoiler-trigger" data-toggle="collapse">Toggle show</button>
    </div>
    <div class="panel-collapse collapse out">
        <div class="panel-body">
            <div class="controls">
                <textarea class="form-control textarea-highlight" data-mode="text/x-mysql" id="revert_queries"
                @if(!$canEdit)
                 data-conf="readOnly"
                @endif
                 name="revert_queries" rows="5">{{ $entry->revert_queries }}</textarea>
            </div>
        </div>
    </div>
</div>
@stop