<!-- Id Perangkat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('id_perangkat', 'Id Perangkat:') !!}
    {!! Form::number('id_perangkat', null, ['class' => 'form-control']) !!}
</div>

<!-- Uraian Perangkat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('uraian_perangkat', 'Uraian Perangkat:') !!}
    {!! Form::text('uraian_perangkat', null, ['class' => 'form-control']) !!}
</div>

<!-- Stok Perangkat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('stok_perangkat', 'Stok Perangkat:') !!}
    {!! Form::number('stok_perangkat', null, ['class' => 'form-control']) !!}
</div>

<!-- Tahun Pengadaan Perangkat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tahun_pengadaan_perangkat', 'Tahun Pengadaan Perangkat:') !!}
    {!! Form::date('tahun_pengadaan_perangkat', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Perangkat Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type_perangkat', 'Type Perangkat:') !!}
    {!! Form::text('type_perangkat', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('perangkats.index') !!}" class="btn btn-default">Cancel</a>
</div>
