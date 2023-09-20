@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3>Edit Anggota</h3>
                </div>
                <div class="card-body">
                    {!! Form::model($hasil, [
                        'method' => 'POST',
                        'route' => ['anggota.update', $hasil->id_anggota]
                     ]) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="client" class="col-sm-6 col-form-label">NIK karyawan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" name="nik_karyawan" value="{{$hasil->nik_karyawan}}" placeholder="nik_karyawan"  readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Nama </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" name="nama_karyawan"  value="{{$hasil->nama_karyawan}}" placeholder="nama" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">NIK Atasan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control  form-control-sm" name="nik_atasan" value={{$hasil->nik_atasan}} >
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
                                        value="{{ $prj->project_no_char }}" data-id="{{$prj->project_no_char}}"
                                        @if($prj->project_no_char == $hasil->id_project) selected @endif
                                    >{{ $prj->project_name }}</option>
                                @endforeach
                            </select>
                            
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Tgl Masuk </label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="tanggal_join_karyawan" placeholder="Tgl Masuk Karyawan" value="{{$hasil->tanggal_join_karyawan}}" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Status Karyawan</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" id="status_karyawan" style="width: 100%;" name="status_karyawan">
                                        <option value="">-- Status --</option>
                                        <option value="Tetap" @if($hasil->status_karyawan == "Tetap") selected @endif>Tetap</option>
                                        <option value="Kontrak" @if($hasil->status_karyawan == "Kontrak") selected @endif>Kontrak</option>
                                    </select>
                                    

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Divisi</label>
                                <div class="col-sm-6">
                                    <select name="id_divisi" class="custom-select select2-info" id="id_divisi" style="width:100%">

                                        @foreach($divisi as $dvs)
                                            <option value="{{ $dvs->id_divisi }}" data-id="{{ $dvs->id_divisi }}"
                                                @if($dvs->id_divisi == $hasil->id_divisi) selected @endif
                                            >{{ $dvs->nama_divisi }}</option>
                                        @endforeach
                                    
                                    </select>
                                    
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">


                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Gabung Koperasi</label>
                                <div class="col-sm-6">
                                    <input class="form-control  form-control-sm" NAME="tgl_join_koperasi" type="date" value="{{$hasil->tgl_join_koperasi}}"  placeholder="tgl_join_koperasi e">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">jabatan </label>
                                <div class="col-sm-6">
                                    <select name="jabatan" class="custom-select select2-info" id="jabatan" style="width:100%">
                                        @foreach($jabatan as $jbt)
                                            <option value="{{ $jbt->id_jabatan }}" data-id="{{ $jbt->id_jabatan }}"
                                                @if($jbt->id_jabatan == $hasil->id_jabatan) selected @endif>
                                                {{ $jbt->nama_jabatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Pendidikan Terakhir</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" id="pend_terakhir" style="width: 100%;" name="pend_terakhir">
                                        <option value="">-- Pendidikan --</option>
                                        <option value="SMK" @if($hasil->pend_terakhir == 'SMK') selected @endif>SMK</option>
                                        <option value="D3" @if($hasil->pend_terakhir == 'D3') selected @endif>D3</option>
                                        <option value="S1" @if($hasil->pend_terakhir == 'S1') selected @endif>S1</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Status Kawin</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm" id="status_kawin" style="width: 100%;" name="status_kawin">
                                        <option value="">-- Status --</option>
                                        <option value="1" @if($hasil->status_kawin == '1') selected @endif>Kawin</option>
                                        <option value="2" @if($hasil->status_kawin == '2') selected @endif>Tidak kawin</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label"> Nama Suami/IStri</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="nama_sutri" value="{{$hasil->nama_sutri}}" name="nama_sutri" placeholder="input nama suami /istri" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Pek Suami/Istri</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="pek_sutri" name="pek_sutri" value="{{$hasil->pek_sutri}}" placeholder="Pek Suami/Istri" >
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 "> <input type="submit" value="Simpan" class="btn btn-primary" />
                            <a class="btn btn-danger" href="{{ route('anggota.index') }}">kembali</a></div>

                    </div>

                    {!! Form::close() !!}

                </div>
                <div class="card-footer">
                </div>

        </div>
    </div>
</div>
    <script>
        $(document).ready(function () {
           $('#id_project').select2();
            $('#jabatan').select2();
            $('#pend_terakhir').select2();
            $('#status_kawin').select2();
            $('#id_divisi').select2();
        });
    </script>
@endsection
