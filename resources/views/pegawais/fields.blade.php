<!-- N I P Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nip', 'N I P:') !!}
    {!! Form::number('nip', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Pangkat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('pangkat', 'Pangkat:') !!}
    {!! Form::text('pangkat', null, ['class' => 'form-control']) !!}
</div>

<!-- Golongan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('golongan', 'Golongan:') !!}
    {!! Form::text('golongan', null, ['class' => 'form-control']) !!}
</div>

<!-- Jabatan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('jabatan', 'Jabatan:') !!}
    {!! Form::text('jabatan', null, ['class' => 'form-control']) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-12">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::text('foto', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('pegawais.index') !!}" class="btn btn-default">Cancel</a>
</div>
