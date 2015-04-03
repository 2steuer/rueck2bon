@extends('users.main')

@section('title') Benutzer anlegen @stop

@section('content')
<h2>Benutzer anlegen</h2>
{!! Form::open(['route' => 'users.store', 'method'=>'post', 'class'=>'form-horizontal']) !!}

@include('users.partials.form')

<div class="form-group">
    <div class="col-sm-6">
        <input type="submit" name="submit_new" value="Anlegen und neu" class="btn btn-default form-control" />
    </div>

    <div class="col-sm-6">
        <input type="submit" name="submit_list" value="Anlegen und auflisten" class="btn btn-primary form-control" />
    </div>
</div>

{!! Form::close() !!}

@stop