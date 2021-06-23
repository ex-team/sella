<div class="form-group col-sm-12">
    {!! Form::label('perangkat_id', 'ID Perangkat :') !!}
    <select class="form-control select2" title="Pilih perangkat..." id="perangkat_id" name="perangkat_id">
            <option value="">Pilih perangkat...</option>
            @foreach ($perangkat as $item)
            <option value="{{$item->id}}" >{{$item->id_perangkat}} -  {{$item->uraian_perangkat}} ( Stok : {{$item->stok_perangkat}})</option>
            @endforeach
    </select>
</div>

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
