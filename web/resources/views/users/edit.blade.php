@extends('users.main')

@section('title') Benutzer Bearbeiten @stop

@section('content')

<h2>Benutzer bearbeiten</h2>

{!! Form::model($user, ['route' => array('users.update', $user->id), 'method' => 'put', 'class'=>'form-horizontal']) !!}

@include('users.partials.form')

<div class="form-group">
    <div class="col-sm-6">
        <a href="{{ route('users.index') }}" class="btn btn-default form-control">Zurück</a>
    </div>

    <div class="col-sm-6">
        <input type="submit" name="submit" value="Speichern" class="btn btn-primary form-control" />
    </div>
</div>

{!! Form::close() !!}

@stop