<!-- Tgl Peminjaman Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tgl_peminjaman', 'Tgl Peminjaman:') !!}
    {!! Form::date('tgl_peminjaman', null, ['class' => 'form-control']) !!}
</div>

<!-- Tgl Pengembalian Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tgl_pengembalian', 'Tgl Pengembalian:') !!}
    {!! Form::date('tgl_pengembalian', null, ['class' => 'form-control']) !!}
</div>

<!-- Keperluan Field -->
<div class="form-group col-sm-12">
    {!! Form::label('keperluan', 'Keperluan:') !!}
    {!! Form::text('keperluan', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('peminjaman.index') !!}" class="btn btn-default">Cancel</a>
</div>
