@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3>Tambah Anggota</h3>
                </div>
                <div class="card-body">
                    {!! Form::model('anggota', [
       'method' => 'post',
       'route' => 'anggota.store',
   ]) !!}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="client" class="col-sm-6 col-form-label">NIK karyawan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" name="nik_karyawan" placeholder="nik_karyawan"  required>
                                    <div class="invalid-tooltip">
                                        Masukkan  NIK yang Unik
                                      </div>                        
                                        </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Nama </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" name="nama_karyawan"  placeholder="nama" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">NIK Atasan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control  form-control-sm" name="nik_atasan"  required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Project</label>
                                <div class="col-sm-6">
                                    <select name="id_project"
                                            class="custom-select select2-info"
                                            id="id_project" style="width:100%" required>
                                            <option value="">Pilih</option>

                                        @foreach($project as $prj)
                                            <option
                                                value="{{ $prj->project_no_char }}" data-id="{{$prj->project_no_char}}">{{ $prj->project_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Tgl Masuk </label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-sm" name="tanggal_join_karyawan" placeholder="Tgl Masuk Karyawan" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Status Karyawan</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm " id="status_karyawan" style="width: 100%;" name="status_karyawan"required>
                                        <option value="">-- Status --</option>
                                        <option value="Tetap">Tetap</option>
                                        <option value="Kontrak">Kontrak</option>

                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Divisi</label>
                                <div class="col-sm-6">
                                    <select name="id_divisi"
                                            class="custom-select select2-info"
                                            id="id_divisi" style="width:100%" required>

                                        @foreach($divisi as $dvs)
                                            <option
                                                value="{{ $dvs->id_divisi }}" data-id="{{$dvs->id_divisi}}">{{ $dvs->nama_divisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">


                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Gabung Koperasi</label>
                                <div class="col-sm-6">
                                    <input class="form-control  form-control-sm" NAME="tgl_join_koperasi" type="date" placeholder="tgl_join_koperasi e" required>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">jabatan </label>
                                <div class="col-sm-6">
                                    <select name="jabatan"
                                            class="custom-select select2-info"
                                            id="jabatan" style="width:100%" required>

                                        @foreach($jabatan as $jbt)
                                            <option
                                                value="{{ $jbt->id_jabatan }}" data-id="{{$jbt->id_jabatan}}">{{ $jbt->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Pendidikan Terakhir</label>
                                <div class="col-sm-6">
                                      <select class="form-control form-control-sm " id="pend_terakhir" style="width: 100%;" name="pend_terakhir" required>
                                        <option value="">-- Pndidikan --</option>
                                        <option value="SMK">SMK</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label">Status Kawin</label>
                                <div class="col-sm-6">
                                    <select class="form-control form-control-sm " id="status_kawin" style="width: 100%;" name="status_kawin" required>
                                    <option value="" >-- Status --</option>
                                     <option value="1">Kawin</option>
                                     <option value="2">Tidak kawin</option>

                                    </select></div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-6 col-form-label"> Nama Suami/IStri</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="nama_sutri" name="nama_sutri" placeholder="input nama suami /istri" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="unit" class="col-sm-6 col-form-label">Pek Suami/Istri</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" id="pek_sutri" name="pek_sutri" placeholder="Pek Suami/Istri" >
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
