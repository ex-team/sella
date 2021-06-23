<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    html,body{
        width:210mm;
        margin-left: auto;
        margin-right: auto;
    }
    </style>
  </head>
  <body >
      <h1>Daftar Pegawai</h1>
    <table style="padding-top:20px; text-align:center; width:100%;">
        <thead>
            <tr style="border-collapse: collapse;border: 1px solid #000">
                <th rowspan="2" style="width:30px;padding-left:5px;padding-right:5px;border-collapse: collapse;border: 1px solid #000">No</th>
                <th rowspan="2" style="border-collapse: collapse;border: 1px solid #000">NIP</th>
                <th rowspan="2" style="width:50px;border-collapse: collapse;border: 1px solid #000">Nama Pegawai</th>
                <th colspan="2" style="border-collapse: collapse;border: 1px solid #000">Pangkat</th>
                <th rowspan="2" style="text-align:center;width:120px;border-collapse: collapse;border: 1px solid #000">Golongan</th>
                <th rowspan="2" style="text-align:center;width:120px;border-collapse: collapse;border: 1px solid #000">Jabatan</th>
                <th rowspan="2" style="text-align:center;width:120px;border-collapse: collapse;border: 1px solid #000">Foto</th>
            </tr>
        </thead>
        <tbody>
           @foreach($pegawais as $p)
                <tr>
                    <td style="width:30px;padding-left:5px;padding-right:5px;text-align:center;border-collapse: collapse;border: 1px solid #000">{{ $i++ }}</td>
                    <td style="padding-left:10px;border-collapse: collapse;border: 1px solid #000">{{$p->nip}}</td>
                    <td style="text-align:center;border-collapse: collapse;border: 1px solid #000">{{$p->nama}}</td>
                    <td style="text-align:center;border-collapse: collapse;border: 1px solid #000">{{$p->pangkat}}</td>
                    <td style="padding-left:10px;border-collapse: collapse;border: 1px solid #000">{{$p->golongan}}</td>
                    <td style="text-align:center;border-collapse: collapse;border: 1px solid #000">{{$p->jabatan}}</td>
                    <td style="text-align:center;border-collapse: collapse;border: 1px solid #000"><div class="foto" style="width: 70px; height:70px;">
                        <?php if ($p->foto != null) { ?>
                            <img  style="width: 100%; height:100%; object-fit:cover" src="{{ asset('uploads/'.$p->foto) }}"/>
                        <?php } else { ?>
                            <img  style="width: 100%; height:100%; object-fit:cover" src="{{ asset('uploads/no_avatar.jpg') }}"/>
                        <?php } ?>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </body>
</html>
