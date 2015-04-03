<div class="form-group">
    {!! Form::label('name', 'Name', ['class'=>'col-sm-2 form-label']) !!}

    <div class="col-sm-10">
        {!! Form::text('name', null, ['placeholder'=>'Name', 'class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('number', 'Telefonnummer', ['class'=>'col-sm-2 form-label']) !!}

    <div class="col-sm-10">
        {!! Form::text('number', null, ['class'=>'form-control', 'placeholder'=>'Telefonnummer']) !!}
    </div>
</div>