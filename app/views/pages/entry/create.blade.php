@extends('layouts.main')

@section('page_title')
<i class="glyphicon glyphicon-plus"></i> Create new entry
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <form role="form" class="form-horizontal" action="{{ URL::route('entry_new') }}" method="post">
            <fieldset>

                <!-- Text input-->
                <div class="control-group">
                    <label class="control-label" for="inputTitle">Titel</label>
                    <div class="controls">
                        <input id="inputTitle" name="title" type="text" placeholder="" class="form-control" required="">

                    </div>
                </div>

                <!-- Text input-->
                <div class="control-group">
                    <label class="control-label" for="inputTicket">Ticket-ID</label>
                    <div class="controls">
                        <input id="inputTicket" name="ticket_id" type="text" placeholder="" class="form-control">

                    </div>
                </div>

                <!-- Select Basic -->
                <div class="control-group">
                    <label class="control-label" for="inputDatabase">Datenbank</label>
                    <div class="controls">
                        <select id="inputDatabase" name="database_id" class="form-control">
                            @foreach($databasesByType as $type => $databases)
                                <optgroup label="{{ $type }}">
                                    @foreach($databases as $database)
                                        <option value="{{ $database->id }}">{{ $database->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Select Basic -->
                <div class="control-group">
                    <label class="control-label" for="inputCategory">Kategorie</label>
                    <div class="controls">
                        <select id="inputCategory" name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="control-group">
                    <label class="control-label" for="inputQueries">Queries</label>
                    <div class="controls">
                        <textarea class="form-control textarea-highlight" data-mode="text/x-mysql" id="inputQueries" name="queries" rows="5"></textarea>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="control-group">
                    <label class="control-label" for="inputRevertQueries">Revert Queries</label>
                    <div class="controls">
                        <textarea class="form-control textarea-highlight" data-mode="text/x-mysql" id="inputRevertQueries" name="revert_queries" rows="5"></textarea>
                    </div>
                </div>

                <!-- Button -->
                <div class="control-group">
                    <label class="control-label" for=""></label>
                    <div class="controls">
                        <button id="" name="" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>
</div>
@stop
