@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h4>Form Pinjaman</h4>
                </div>
                <div class="card-body">
                    {!! Form::model('Msimpanpinjam_hd', [
         'method' => 'post',
         'route' => 'peminjaman.spmsimpan',
     ]) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Nama Anggota</label>
                                <div class="col-sm-6">
                                    <select name="id_anggota"
                                            class="custom-select select2-info"
                                            id="id_anggota" style="width:100%">

                                        @foreach($anggota as $data)
                                            <option
                                                value="{{ $data->id_anggota }}" data-id="{{$data->nama_karyawan}}">{{ $data->nik_karyawan }}--{{$data->nama_karyawan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Nama </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" name="nama_karyawan"  placeholder="nama" id="nama_karyawan" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Project</label>
                                <div class="col-sm-6">
                                    <select name="id_project"
                                            class="custom-select select2-info"
                                            id="id_project" style="width:100%">

                                        @foreach($project as $prj)
                                            <option
                                                value="{{ $prj->project_no_char }}" data-id="{{$prj->project_no_char}}">{{ $prj->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Status Karyawan</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm " id="status_karyawan" style="width: 100%;" name="status_karyawan">
                                        <option value="">-- Status --</option>
                                        <option value="1">Tetap</option>
                                        <option value="2">Kontrak</option>
                                        <option value="3">Daily</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Tanggal pengajuan </label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="tanggal_join_karyawan" placeholder="Tgl Masuk Karyawan" >
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">


                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Jenis Simpanpinjam</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm " id="jenis_spmhd" style="width: 100%;" name="jenis_spmhd">
                                        <option value="0" >-- Jenis Pinjaman --</option>
                                        <option value="KRU">Pinjaman uang</option>
                                        <option value="KRB">Kredit barang</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Nama barang</label>
                                <div class="col-sm-6">
                                    <select name="id_barang"
                                            class="custom-select select2-info"
                                            id="id_barang" style="width:100%">
                                        <option value="0" >-- nama Barang --</option>

                                        @foreach($barang as $brg)
                                            <option value="{{ $brg->id_barang }}" data-id="{{$brg->harga_barang}}">{{ $brg->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Catatan </label>
                                <div class="col-sm-6">
                                    <textarea id="spm_catatan" name="spm_catatan" >

                                    </textarea>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Nominal </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="spmhd_nominal" name="spmhd_nominal" placeholder="Nominal" >

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Periode</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control form-control-sm" id="spm_period" name="spm_period" placeholder="bulan" >
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 "> <input type="submit" value="Simpan" class="btn btn-primary" />
                            <a class="btn btn-danger" href="{{ route('anggota.index') }}">kembali</a></div>

                    </div>

                    {!! Form::close() !!}
                <div class="card-footer">
                </div>

        </div>
    </div>
</div>
        <script>
            $(document).ready(function () {
                $('#id_anggota').select2();
                $('#id_project').select2();
                $('#id_barang').select2();
                $('#jenis_spmhd').val()

                $('#jenis_spmhd').change(function(){
                   var isi = $(this).val();
                   if(isi=='KRU'){
                       $("#id_barang").prop("disabled", true);
                   }else{
                       $("#id_barang").prop("disabled", false);
                   }
                });




                $('#id_anggota').change(function() {

                    var value=$("#id_anggota").select2().find(":selected").data("id");

                    $('#nama_karyawan').val(value);

                });
                $('#id_barang').change(function() {

                    var value=$("#id_barang").select2().find(":selected").data("id");

                    $('#spmhd_nominal').val(value);

                });
            });
        </script>
        
@endsection
