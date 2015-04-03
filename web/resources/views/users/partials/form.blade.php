<div class="form-group">
    {!! Form::label('name', 'Name', ['class'=>'col-sm-2 form-label']) !!}

    <div class="col-sm-10">
        {!! Form::text('name', null, ['placeholder'=>'Name', 'class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('email', 'E-Mail', ['class'=>'col-sm-2 form-label']) !!}

    <div class="col-sm-10">
        {!! Form::email('email', null, ['class'=>'form-control', 'placeholder'=>'E-Mail']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('password_u', 'Passwort', ['class'=>'col-sm-2 form-label']) !!}

    <div class="col-sm-10">
        {!! Form::password('password_u', ['class' => 'form-control']) !!}
    </div>
</div>
