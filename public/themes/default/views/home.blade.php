<!-- Title -->
<div class="row">
    <div class="col-lg-12">
      <h3>Kurs Rupiah Hari ini {{date('Y-m-d')}} - update terakhir tanggal {{ date('Y-m-d',strtotime($updatedDate)) }}</h3>
    </div>
</div>
<!-- /.row -->

<hr>

<!-- Page Features -->
<div class="row text-left">

  <table class="table table-striped">
      <tr>
          <th>Mata Uang</th>
          <th>Bank</th>
          <th>Jual</th>
          <th>Beli</th>
          <th>Tanggal</th>
      </tr>
      @foreach($dataKurs as  $kurs)
      <tr>
          <td>{!!  $kurs['currency_code'] !!} ({!!  $kurs['currency_name'] !!})</td>
          <td>{!!  $kurs['bank_code'] !!} ({!!  $kurs['bank_name'] !!})</td>
          <td>{!!  number_format($kurs['rate_sell'],2) !!}</td>
          <td>{!!  number_format($kurs['rate_buy'],2) !!}</td>
          <td>{!!  $kurs['rate_date'] !!}</td>
      </tr>
      @endforeach
  </table>

</div>
