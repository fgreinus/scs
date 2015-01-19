@extends('layouts.min')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h3><i class="glyphicon glyphicon-warning-sign"></i> An error occurred</h3>

        <div class="alert alert-danger" role="alert">
            {{ $exception->getMessage() }}
        </div>

@stop