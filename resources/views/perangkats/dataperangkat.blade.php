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
      <h1>Daftar Perangkat</h1>
    <table style="padding-top:20px; text-align:center; width:100%;">
        <thead>
            <tr style="border-collapse: collapse;border: 1px solid #000">
                <th rowspan="2" style="width:30px;padding-left:5px;padding-right:5px;border-collapse: collapse;border: 1px solid #000">No</th>
                <th rowspan="2" style="border-collapse: collapse;border: 1px solid #000">id_perangkat</th>
                <th rowspan="2" style="width:50px;border-collapse: collapse;border: 1px solid #000">Nama Perangkat</th>
                <th colspan="2" style="border-collapse: collapse;border: 1px solid #000">Stok Perangkat</th>
                <th rowspan="2" style="text-align:center;width:120px;border-collapse: collapse;border: 1px solid #000">Tahun</th>
                <th rowspan="2" style="text-align:center;width:120px;border-collapse: collapse;border: 1px solid #000">Type Perangkat</th>
            </tr>
        </thead>
        <tbody>
           @foreach($perangkats as $p)
                <tr>
                    <td style="width:30px;padding-left:5px;padding-right:5px;text-align:center;border-collapse: collapse;border: 1px solid #000">{{ $i++ }}</td>
                    <td style="padding-left:10px;border-collapse: collapse;border: 1px solid #000">{{$p->id_perangkat}}</td>
                    <td style="text-align:center;border-collapse: collapse;border: 1px solid #000">{{$p->uraian_perangkat}}</td>
                    <td style="text-align:center;border-collapse: collapse;border: 1px solid #000">{{$p->stok_perangkat}}</td>
                    <td style="padding-left:10px;border-collapse: collapse;border: 1px solid #000">{{$p->tahun_pengadaan_perangkat}}</td>
                    <td style="text-align:center;border-collapse: collapse;border: 1px solid #000">{{$p->type_perangkat}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </body>
</html>
