<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $pegawai->id !!}</p>
    <hr>
</div>

<!-- N I P Field -->
<div class="form-group">
    {!! Form::label('nip', 'N I P:') !!}
    <p>{!! $pegawai->nip !!}</p>
    <hr>
</div>

<!-- Nama Field -->
<div class="form-group">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{!! $pegawai->nama !!}</p>
    <hr>
</div>

<!-- Pangkat Field -->
<div class="form-group">
    {!! Form::label('pangkat', 'Pangkat:') !!}
    <p>{!! $pegawai->pangkat !!}</p>
    <hr>
</div>

<!-- Golongan Field -->
<div class="form-group">
    {!! Form::label('golongan', 'Golongan:') !!}
    <p>{!! $pegawai->golongan !!}</p>
    <hr>
</div>

<!-- Jabatan Field -->
<div class="form-group">
    {!! Form::label('jabatan', 'Jabatan:') !!}
    <p>{!! $pegawai->jabatan !!}</p>
    <hr>
</div>

<!-- Foto Field -->
<div class="form-group">
    {!! Form::label('foto', 'Foto:') !!}
    <div class="foto" style="width: 70px; height:70px;">
        <?php if ($pegawai->foto != null) { ?>
            <img  style="width: 100%; height:100%; object-fit:cover" src="{{ asset('uploads/'.$pegawai->foto) }}"/>
        <?php } else { ?>
            <img  style="width: 100%; height:100%; object-fit:cover" src="{{ asset('uploads/no_avatar.jpg') }}"/>
        <?php } ?>
    </div>
    <hr>
</div>

