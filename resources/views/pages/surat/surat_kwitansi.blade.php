<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi</title>
     <!-- Favicons -->
  <link href="{{ asset('assets/img/profile/Logo.jpg') }}" rel="icon">
  <link href="{{ asset('assets/img/profile/Logo.jpg') }}" rel="logo">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kwitansi {
            width: 600px;
            border: 2px solid black;
            padding: 20px;
            margin: 70px auto 0 auto;
        }
        .header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            text-decoration: underline;
        }
        .no {
            text-align: right;
            font-weight: bold;
        }
        .content p {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .label {
            display: flex;
            align-items: center;
            flex: 0.4; /* Menyesuaikan lebar label */
            font-style: italic;
            font-weight: bold;
            min-width: 150px; /* Pastikan lebar label tetap */
        }

        .separator {
            margin-left: auto; /* Dorong titik dua ke ujung kanan */
            padding-left: 5px; /* Jarak antara teks dan titik dua */
            padding-right: 10px;
        }

        .box {
            flex: 1;
            border: 1px solid black;
            padding: 8px;
            border-radius: 5px;
            background-color: #f8f9fa;
        }


        .amount {
            margin-top: 50px;
            text-align: center;
            border: 2px solid black;
            padding: 10px;
            width: 150px;
            font-weight: bold;
            border-radius: 8px; /* Membuat kotak jumlah uang lebih estetis */
            background-color: #e9ecef; /* Warna abu-abu terang */
        }
        .signature {
            text-align: right;
            margin-top: 20px;
        }
        .signature p {
            margin: 5px 0;
        }
        .signature .name {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <table width=100%>
        <tr>
          <td width="20%" class="text-center">
            <img src="{{ asset('assets/img/profile/Logo.jpg') }}" alt="Logo IndoKarya" width="175px">
          </td>
          <td width="80%" class="my-0 py-0 text-center">
            <h6 class="text-primary">{{$informasi_perusahaan->nama_perusahaan}}</h6>
            <p style="font-size: 12px;" class="my-0 py-0">
              {{$informasi_perusahaan->bidang}}
            </p>
            <p style="font-size: 10px" class="my-0 py-0">
              Office : {{ $informasi_perusahaan->alamat }} <br>
              42446 Telp. {{ $informasi_perusahaan->no_telpon }} Email : {{ $informasi_perusahaan->email }}
            </p>
          </td>
        </tr>
      </table>

      <hr style="border: 2px solid black">

    <div class="kwitansi">
        <div class="header">KWITANSI</div>
        <div class="no">{{ $kwitansis->no_kwitansi }}</div>
        <hr style="border: 2px solid black">
        <div class="content">
            <p><span class="label">Sudah Terima Dari <span class="separator">:</span></span> <span class="box">{{ $kwitansis->invoice->pemesan->asal_pemesan}}</span></p>
            <p><span class="label">No Invoice <span class="separator">:</span></span> <span class="box">{{ $kwitansis->invoice->no_surat}}</span></p>
            <p><span class="label">Uang Sebesar <span class="separator">:</span></span> <span class="box">{{$harga_terbilang}}</span></p>
        </div>

        <div class="amount">Rp.{{ number_format($total, 0, ',', '.') }}</div>
        <div class="signature">
            <p>Ciwandan, {{ date('d M Y') }}</p>
            <br><br>
            @if ($direktur->tandatangan && $invoice->status_pengajuan == 'Disetujui')
            <img src="{{ asset('assets/img/tandatangan/' . $direktur->tandatangan) }}" alt="Tanda Tangan" class="img-fluid mb-2" style="max-width: 100px; height: auto;">
            @else
                <p class="text-muted">Tanda tangan belum tersedia.</p>
            @endif
            <p class="name">{{ optional($direktur)->name ?? 'Nama Direktur Tidak Tersedia' }}</p>
            <p> {{ optional($direktur->jabatan)->nama_jabatan ?? 'Nama Direktur Tidak Tersedia' }}</p>
        </div>
    </div>


    <script type="text/javascript">
        window.print();
      </script> 
</body>
</html>
