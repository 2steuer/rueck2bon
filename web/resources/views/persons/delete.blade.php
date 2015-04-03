@extends('persons.main')

@section('content')
<p class="text-danger">Die Person <b>{{ $person->name }}</b> wirklich aus dem System löschen?</p>
{!! Form::open(['route' => ['persons.destroy', $person->id], 'method' => 'delete', 'class'=>'form-horizontal']) !!}

<div class="form-group">
    <div class="col-sm-6">
        <input type="submit" class="btn btn-default form-control" name="submit" value="Ja, löschen!" />
    </div>

    <div class="col-sm-6">
        <a href="{{ route('persons.index') }}" class="btn btn-primary form-control">Nein, zurück</a>
    </div>
</div>

{!! Form::close() !!}

@stop