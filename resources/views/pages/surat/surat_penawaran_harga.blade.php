<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Surat Penawaran Harga</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/profile/Logo.jpg') }}" rel="icon">
  <link href="{{ asset('assets/img/profile/Logo.jpg') }}" rel="logo">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

  <div>
    <table width=100%>
      <tr>
        <td width="20%" class="text-center">
          <img src="{{ asset('assets/img/profile/Logo.jpg') }}" alt="Logo IndoKarya" width="175px">
        </td>
        <td width="80%" class="my-0 py-0">
          <h6 class="text-primary">{{ $informasi_perusahaan->nama_perusahaan }}</h6>
          <p style="font-size: 12px; text-align: justify;" class="my-0 py-0">
            DISTRIBUTOR OF VALCE, PIPES & FITTING, ELECTRICAL, PNEUMTAUC, CONTRAKTOR & SAFETY EQUIPMENT (TRADING & SUPPLIER)
          </p>
          <p style="font-size: 10px" class="my-0 py-0">
            Office : {{ $informasi_perusahaan->alamat }} kode pos 42423 tlp. {{ $informasi_perusahaan->no_telpon }}
          </p>
        </td>
      </tr>
    </table>

    <hr style="border: 2px solid black">

    <div class="d-flex text-align-center justify-content-between">
        <div>
            <b style="font-size: 10px">
                To : {{ $data->pemesan->nama_pemesan }} <br>
                {{-- PT. HUTAMAKARYA --}}
            </b>
        </div>
        <div class="m-0 p-0">
            <b style="font-size: 10px">
                {{ $informasi_perusahaan->nama_perusahaan }} <br>
                {{ $informasi_perusahaan->alamat }}<br>
                TELP : {{ $informasi_perusahaan->no_telpon }} <br>
                FAX : {{ $informasi_perusahaan->fax }} <br>

                ATT : {{ $direktur->name }} <br><br>
                QTC :  {{ $data->no_surat }}
            </b>
        </div>
    </div>

    <div style="margin-top: 35px; display: flex; justify-content:center; align-items:center;">
      <table class="table" style="font-size: 10px">
        <thead>
          <th>NO</th>
          <th>NAMA BARANG</th>
          <th>QTY</th>
          <th>UNIT</th>
          <th>PRICE</th>
          <th>TOTAL</th>
        </thead>
        <tbody>
          @foreach ($detail_data as $item)              
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->produk->nama_produk }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->produk->unit }}</td>
                <td>{{ number_format($item->produk->harga_produk, 0, ',', '.') }}</td>
                <td>{{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
          @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
      </table>
    </div>

    <b style="font-size: 10px">
        SYARAT & KETENTUAN <br>
        <u>
            PENGIRIMAN & PEMBAYARAN : 3 HARI KERJA SETELAH KONFIRMASI ORDER & DP CASH 50%
        </u> <br>
                                    PELUNASAN CASH SEBELUM BARANG KAMI KONFIRMASI <br>
        VALIDITY : 1 MINGGU SETELAH TANGGAL PENAWARAN <br>
        HARGA BELUM TERMASUK TAX 11% <br> <br>
        PEMBAYARAN :   {{ $informasi_perusahaan->no_rek }} ( INDOKARYA JASA PRIMA )
    </b>

    <br>
    
    <table style="font-size: 10px; text-align: left;">
      <tr>
          <td>
              CILEGON, {{ date('d M Y') }}
              <br><br><br>
              BEST REGARDS,
              <br><br>
  
              @if(optional($direktur)->tandatangan)
                  <img src="{{ asset('assets/img/tandatangan/' . $direktur->tandatangan) }}" alt="Tanda Tangan {{ optional($direktur)->name }}" class="img-fluid mb-2" style="max-width: 100px; height: auto;">
              @else
                  <p>Tanda tangan tidak tersedia</p>
              @endif
  
              <br><br>
              <p style="margin: 0; padding: 0;">
                  <u>{{ optional($informasi_perusahaan)->nama_perusahaan ?? 'Nama Perusahaan Tidak Tersedia' }}</u> <br>
                  {{ optional($direktur)->name ?? 'Nama Direktur Tidak Tersedia' }} ({{ optional($direktur)->no_telepon ?? 'No Telepon Tidak Tersedia' }}) <br>
                  Email: {{ optional($informasi_perusahaan)->email ?? 'Email Tidak Tersedia' }}
              </p>
  
              <br>
              <b> ______________ </b>
          </td>
      </tr>
  </table>
  </div>

  <script type="text/javascript">
    window.print();
  </script>
</body>

</html>
