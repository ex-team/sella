<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $peminjaman->id !!}</p>
    <hr>
</div>

<!-- Tgl Peminjaman Field -->
<div class="form-group">
    {!! Form::label('tgl_peminjaman', 'Tgl Peminjaman:') !!}
    <p>{!! $peminjaman->tgl_peminjaman !!}</p>
    <hr>
</div>

<!-- Tgl Pengembalian Field -->
<div class="form-group">
    {!! Form::label('tgl_pengembalian', 'Tgl Pengembalian:') !!}
    <p>{!! $peminjaman->tgl_pengembalian !!}</p>
    <hr>
</div>

<!-- Keperluan Field -->
<div class="form-group">
    {!! Form::label('keperluan', 'Keperluan:') !!}
    <p>{!! $peminjaman->keperluan !!}</p>
    <hr>
</div>

