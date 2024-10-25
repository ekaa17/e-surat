<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Invoice</title>
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
          <img src="./LogoIDKY.png" alt="Logo IndoKarya" width="175px">
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

    <div class="d-flex justify-content-between align-items-center" style="font-size: 10px;">
      <div class="w-25">
        <p class="border border-primary py-3 px-2 bg-primary">
          <b> BILL TO </b>
        </p>
        <p> MP-DKD JO <br>
          Jl. ANYER KM 121 KEPUH CIWANDA KOTA CILEGON BANTEN
        </p>
      </div>
      <div class="w-25">
        <h5 class="text-primary text-center">
          <b> INVOICE </b>
        </h5>
        <table>
          <tr>
            <td style="min-width: 75px;"> DATE </td>
            <td style="border: 1px solid red; min-width: 200px;"> 14 Agustus 2023 </td>
          </tr>
          <tr>
            <td style="min-width: 75px;"> INVOICE </td>
            <td style="border: 1px solid red; min-width: 200px;"> 005/IJP-MP-DKD-JO/VIII/2023 </td>
          </tr>
          <tr>
            <td style="min-width: 75px;"> PO NUMBER </td>
            <td style="border: 1px solid red; min-width: 200px;"> 23/JO-DP-MP/LOTTE IJP/VII/2023 </td>
          </tr>
          <tr>
            <td style="min-width: 75px;"> DUE DATE </td>
            <td style="border: 1px solid red; min-width: 200px;" class="text-primary"> 14 Agustus 2023 </td>
          </tr>
        </table>
      </div>
    </div>

    <div style="margin-top: 35px; display: flex; justify-content:center; align-items:center;">
      <table class="table table-striped" style="font-size: 10px">
        <thead>
          <th> Description</th>
          <th> Unit Price</th>
          <th> QTY </th>
          <th> Unit </th>
          <th> Amount </th>
        </thead>
        <tbody>             
            <tr>
              <td>Solar Industry <b> Non subsidi </b></td>
              <td>Rp. 13.200</td>
              <td>8000</td>
              <td>Liter</td>
              <td>Rp. 105.600.000</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td> Subtotal </td>
                <td> Rp. 75.675.680 </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Vat 11%</td>
                <td>Rp. *.324.320</td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td>Total</td>
              <td class="bg-danger">Rp. 84.000.000</td>
            </tr>
        </tbody>
      </table>
    </div>

    <br>

    <div class="w-50 border border-danger" style="font-size: 10px;">
      <p class="border border-primary bg-primary">
        <b> OTHER COMMENTS </b>
      </p>
      <p> 
        Mohon Pembayaran Di Transfer ke : <br>
        PT. INDOKARYA JASA PRIMA <br>
        No. Rek : 163-00-0713799-9 <br>
        Bank Mandiri
      </p>
    </div>
    
    <table style="font-size: 10px; text-align: left; text-align: center;" class="d-flex justify-content-end">
      <tr>
          <td>
              Dipersiapkan Oleh
              <br>
              PT. INDOKARYA JASA PRIMA
              <br><br>

              <img src="./LogoIDKY.png" alt="Tanda Tangan" class="img-fluid mb-2" style="max-width: 100px; height: auto;">
  
              <br><br>
  
              <u> Saeful Anwar S.Kom </u> <br>
              Direktur
          </td>
      </tr>
  </table>
  </div>

  <!-- <script type="text/javascript">
    window.print();
  </script> -->
</body>

</html>
