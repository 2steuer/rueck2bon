@extends('master')

@section('title') Login @stop

@section('content')
<h2>Login</h2>
    {!! Form::open(['route'=>'users.login', 'method' => 'post', 'class'=>'form-horizontal']) !!}

<div class="form-group">
    {!! Form::label('email', 'E-Mail', ['class'=>'col-sm-2 form-label']) !!}

    <div class="col-sm-10">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password', 'Passwort', ['class'=>'col-sm-2 form-label']) !!}

    <div class="col-sm-10">
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('remember', 'Angemeldet bleiben?', ['class'=>'col-sm-2 form-label']) !!}

    <div class="col-sm-10">
        {!! Form::checkbox('remember', '1', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-12">
        {!! Form::submit('Login', ['class'=>'btn btn-primary form-control']) !!}
    </div>
</div>

    {!! Form::close() !!}
@stop