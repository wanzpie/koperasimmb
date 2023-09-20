@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <section class="content">
                        <div class="container-fluid">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card card-info mt-3">
                                <div class="card-header">
                                List  Data Anggota Koperasi MMB
                                </div>
                                <div class="card-body ">
                                    <table class="table table-bordered table-hover dataTable nowrap" id="listanggota">
                                        <thead>
                                        <tr >
                                            <th> No</th>
                                            <th >NIK </th>
                                            <th>Nama Anggota </th>
                                            <th>Gabung Perusahaan</th>
                                            <th>Gabung Koperasi</th>
                                            <th>Status</th>
                                            <th >Proyek</th>
                                            <th>Divisi</th>
                                            <th>jabatan</th>
                                            <th>Pnd Terakhir</th>
                                            <th>nama Sutri</th>
                                            <th>Pek Sutri</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($anggota as $agt)
                                            <tr >
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $agt->nik_karyawan }}</td>
                                                <td>{{ $agt->nama_karyawan }}</td>
                                                <td>{{ $agt->tanggal_join_karyawan }}</td>
                                                <td>{{ $agt->tgl_join_koperasi }}</td>
                                                <td>{{ $agt->status_karyawan }}</td>
                                                <td>{{ $agt->project_name }}</td>
                                                <td>{{ $agt->nama_divisi }}</td>
                                                <td>{{ $agt->nama_jabatan }}</td>
                                                <td>{{ $agt->pend_terakhir }}</td>
                                                <td>{{ $agt->nama_sutri }}</td>
                                                <td>{{ $agt->pek_sutri }}</td>
                                            </tr>

                                        @endforeach
                                        </tbody>
                                    </table>

                                   
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function(){
           $('#listanggota').DataTable(
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


