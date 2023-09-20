@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h4>Tambah Simpanan Sukarela</h4>
                </div>
                <div class="card-body">
                 <div class="col-md-2"></div>
                 <div class="col-md-10">
               <section class="content">

    &nbsp;
    {!! Form::model('Msimpanpinjam_hd', [
        'method' => 'post',
        'route' => 'simpanan_sr.store',
    ]) !!}
                   <div class="form-group row">
                       <label for="unit" class="col-sm-6 col-form-label">Nama Anggota</label>
                       <div class="col-sm-6">
                           <select name="id_anggota"
                                   class="custom-select select2-info"
                                   id="id_anggota" style="width:100%">
                               <option value="">Anggota</option>

                               @foreach($anggota as $data)
                                   <option
                                       value="{{ $data->id_anggota }}" data-id="{{$data->nama_karyawan}},{{$data->nama_jabatan}},{{$data->nama_divisi}}">{{ $data->nik_karyawan }}--{{$data->nama_karyawan}}</option>
                               @endforeach
                           </select>
                       </div>
                   </div>
    <div class="form-group row">
        <label for="username" class="col-sm-6 col-form-label">Nama karyawan</label>
        <input class="form-control col-sm-6" type="text" name="nama_karyawan" id="nama_karyawan" readonly />
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-6 col-form-label">jabatan</label>
        <input class="form-control col-sm-6" type="text" name="jabatan" id="jabatan"  readonly/>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-6 col-form-label">Departemen</label>
        <input class="form-control col-sm-6" type="text" name="dpt" id="dpt"  readonly/>
    </div>
                   <div class="form-group row">
                       <label for="password" class="col-sm-6 col-form-label">Simpanan Sukarela</label>
                       <input class="form-control col-sm-6" type="number" name="spmhd_nominal" id="spmhd_nominal" placeholder="Maks simp sukarela 200.000"/>
                   </div>

    <div class="form-group col-lg-12">
        <input type="submit" value="Save" class="btn btn-primary" />
        <a class="btn btn-danger" href="{{ route('barang.index') }}">Back</a>
    </div>
    {!! Form::close() !!}
      </section>
    </div>
                </div>
                <div class="card-footer">
                </div>

        </div>
    </div>
</div>
    <script>
        $(document).ready(function () {
            $('#id_anggota').select2();
            $('#id_project').select2();
        });
        $('#id_anggota').change(function() {

            var value=$("#id_anggota").select2().find(":selected").data("id");
            var splitval = value.split(',');


            $('#nama_karyawan').val(splitval[0]);
            $('#jabatan').val(splitval[1]);
            $('#dpt').val(splitval[2]);
            var unsel =$('#id_anggota option:selected').val();
            if(unsel=""){
                $('#nama_karyawan').val('');
                $('#jabatan').val();
                $('#dpt').val();
            }

        });
        
    </script>

@endsection
