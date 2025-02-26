<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Laporan Penawaran Harga</title>
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



    <p class="text-center mt-2 mb-2" style="font-size: 18px;"><b>Laporan Surat Penawaran Harga</b></p>
    <div class="text-center mb-5">
        <p class="mb-1">{{ request('bulan') ? \Carbon\Carbon::create()->month(request('bulan'))->translatedFormat('F') : 'Semua Bulan' }}  {{ request('tahun') ? request('tahun') : 'Semua Tahun' }}</p>
        {{-- <p class="mb-1">Tahun: {{ request('tahun') ? request('tahun') : 'Semua Tahun' }}</p> --}}
    </div>

    <div style="margin-top: 35px; display: flex; justify-content:center; align-items:center;">
      <table class="table table-striped table-bordered text-center" style="font-size: 12px">
        <thead class="thead-dark">
            <tr>
                <th>Tanggal</th>
                <th>NO PH</th>
                <th>Asal Klien</th>
                <th>Nama Supplier</th>
                <th>Produk</th>
                <th>Quantity</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach ($data as $item)
                @php $subTotal = 0; @endphp
                @foreach ($data_show->where('id_penawaran', $item->id) as $data)
                    @php 
                        $jumlah = $data->quantity * $data->produk->harga_produk;
                        $subTotal += $jumlah;
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                        <td>{{ $item->no_surat }}</td>
                        <td>{{ $item->pemesan->asal_pemesan }}</td>
                        <td>{{ $item->pemesan->nama_pemesan }}</td>
                        <td>{{ $data->produk->nama_produk }}</td>
                        <td>{{ $data->quantity }} {{ $data->unit }}</td>
                        <td>Rp. {{ number_format($data->produk->harga_produk, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($jumlah, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="bg-light font-weight-bold">
                    <td colspan="6"></td>
                    <td class="text-right">Sub Total:</td>
                    <td>Rp. {{ number_format($subTotal, 0, ',', '.') }}</td>
                </tr>
                @php $grandTotal += $subTotal; @endphp
            @endforeach
            <tr class="bg-danger text-white font-weight-bold">
                <td colspan="6"></td>
                <td class="text-right">Grand Total:</td>
                <td>Rp. {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    
    </div>
  </div>

  <script type="text/javascript">
    window.print();
  </script> 
</body>

</html>

