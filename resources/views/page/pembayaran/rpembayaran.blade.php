@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3>Report pembayaran</h3>
                </div>
                <div class="card-body">
                    {!! Form::model('shu', [
                        'method' => 'post',
                        'route' => 'vwrpembayaran',
                    ]) !!}
                   <div class="row">
                    @include('layouts.flash-message')
                   </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Start date</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="start_date"  placeholder="masukkan jumlah profit" id="jumlah_profit" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">End date</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="end_data"  placeholder="Total Point" id="totalpoint" >
                                </div>
                            </div>
                         

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3 ">
                            
                            <input type="submit" value="Submit" class="btn btn-primary" />
                            {{-- <a class="btn btn-danger" href="{{ route('pembayaran.index') }}">kembali</a></div> --}}

                    </div>
                    {!! Form::close() !!}

                </div>
         
                <div class="card-footer">
                   
                    <div class="row">
                        @if (isset($spmbayar))
                        <div> <h3>Rekap pembayaran</h3></div>
                       
                        <table class="table table-bordered table-hover dataTable" id="rbayar">
                            <thead>
                            <tr >
                                <th> No</th>
                                <th>No Doc</th>
                                <th >Nama bank</th>
                                <th>Tgl bayar </th>
                                <th >Catatan</th>
                                <th>Jumlah </th>
                                <th>Status</th>
                              
                            </tr>
                            </thead>
                            @foreach($spmbayar as $spmbyr)
                                <tr >
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $spmbyr->spmbayar_nochar }}</td>
                                    <td>{{ $spmbyr->nama_bank }}</td>
                                    <td>{{ $spmbyr->spmbayar_tgl_bayar }}</td>
                                    <td>{{ $spmbyr->spmbayar_catatan }}</td>
                                      <td>{{ $spmbyr->spmbayar_nominal }}</td>
                                      <td>{{$spmbyr->spmbayar_status}}</td>
                                            
                                            
                                </tr>
         
                            @endforeach
         
                        </table>
                        @endif
                       </div>
                </div>

        </div>
    </div>
</div>
    <script>
        $(document).ready(function () {
           $('#periodeshu').select2();

        });
    </script>
<script>
    $(document).ready(function () {
      
        $('#rbayar').DataTable(
            {
                "paging":true,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5',
                    {
            extend: 'print',
            orientation: 'landscape'}
                ]});
      
    });
</script>

@endsection
