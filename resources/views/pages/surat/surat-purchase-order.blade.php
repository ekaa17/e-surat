<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PURCHASE ORDER (PO)</title>
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
        <td width="80%" class="my-0 py-0 text-center">
          <h6 class="text-primary">PT. INDOKARYA JASA PRIMA</h6>
          <p style="font-size: 12px;" class="my-0 py-0">
            CONTRACTOR, TRADING & SUPPLIER
          </p>
          <p style="font-size: 10px" class="my-0 py-0">
            Office : Jln. Link Warungkara RT/RW 005/001 Randakari Ciwanda Kota Cilegon Provinsi Banten kode pos <br>
            42446 Telp. 081234567890 Email : ptindokaryajasaprima@gmail.com
          </p>
        </td>
      </tr>
    </table>

    <hr style="border: 2px solid black">

    <p class="text-center mt-2 mb-5" style="font-size: 12px;">
      <b> PURCHASE ORDER (PO) </b> <br>
      {{ $order->nomor_surat }}
    </p>
    <div class="m-0 p-0">
      <p style="font-size: 10px">
        Kepada / TO : <br>
          <b> {{ $order->perusahaan->nama_perusahaan }} </b> <br>
          Date : {{ $order->created_at->format('d F Y') }} <br>
          Berdasarkan permintaan pembelian : <br> <i> Basic of purchase requesition </i> <br>
          Harap Kirim Barang Tersebut Di :{{ $order->lokasi_gudang }}

      </p>
    </div>

    <div style="margin-top: 35px; display: flex; justify-content:center; align-items:center;">
      <table class="table" style="font-size: 10px">
        <thead>
          <th>NO</th>
          <th>Banyak <br> Quantity</th>
          <th>Uraian <br> Description</th>
          <th>Harga Satuan <br> Unit Price (Rp)</th>
          <th>Jumlah <br> Amount</th>
        </thead>
        <tbody>
          @foreach ($detail_order as $item)              
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->produk->nama_produk }}</td>
                <td>{{ number_format($item->produk->harga_produk, 0, ',', '.') }}</td>
                <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                <td></td>
            </tr>         
            @endforeach   
            
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                  <b> Jumlah </b> <br> PPN 11&
                </td>
                <td>
                  {{ number_format($jumlah, 0, ',', '.') }} <br>
                  {{ number_format($ppn, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total</b></td>
                <td>{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
      </table>
    </div>
    <p style="font-size: 10px;">
      <i> Terbilang : {{ $terbilang }} </i>
    </p>

    <table style="font-size: 10px;">
      <tr>
        <td colspan="2"> Lain-lain / Miscellaneous </td>
      </tr>
      <tr>
        <td> A. Keterangan Harga </td>
        <td>: Harga Franco Proyek </td>
      </tr>
      <tr>
        <td> B. Waktu Penyerahan </td>
        <td>:  {{ \Carbon\Carbon::parse($order->waktu_penyerahan_barang)->format('d F Y') }}</td>
      </tr>
      <tr>
        <td> C. Cara Pembayaran </td>
        <td>:  Pembayaran Selama 15 hari Kerja. Pembayaran tanggal {{ \Carbon\Carbon::parse($order->waktu_pembayaran)->format('d F Y') }} Melalui ATM Perusahaan <b> PT. INDOKARYA JASA PRIMA </b> </td>
      </tr>
      <tr>
        <td> D. Syarat - Syarat </td>
        <td> <i>:  Mohon Quantity Disesuaikan Dengan Jumlah Pemesanan, Apabila Barang Yang Datang Tidak Sesuai Spesifikasi Dan Quantity Akan Ditolak Dan Dikembalikan Segala Resiko Yang Timbul Menjadi Tanggung Jawab Suppliyer </i> </td>
      </tr>
    </table>

    <br>
    
    <table style="font-size: 10px; text-align: left; text-align: center;" class="d-flex justify-content-end">
      <tr>
          <td>
              Dipersiapkan Oleh
              <br>
              {{ optional($informasi_perusahaan)->nama_perusahaan ?? 'Nama Perusahaan Tidak Tersedia' }}
              <br><br>

              @if ($direktur->tandatangan && $order->status_pengajuan == 'Disetujui')
                 <img src="{{ asset('assets/img/tandatangan/' . $direktur->tandatangan) }}" alt="Tanda Tangan" class="img-fluid mb-2" style="max-width: 100px; height: auto;">
              @else
                 <p class="text-muted">Tanda tangan belum tersedia.</p>
              @endif
  
              <br><br>
  
              <u> {{ optional($direktur)->name ?? 'Nama Direktur Tidak Tersedia' }} </u> <br>
              <i> {{ optional($direktur->jabatan)->nama_jabatan ?? 'Nama Direktur Tidak Tersedia' }}</i>
          </td>
      </tr>
  </table>
  </div>

  <script type="text/javascript">
    window.print();
  </script>
</body>

</html>
