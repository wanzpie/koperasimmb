@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h4>Tambah Barang</h4>
                </div>
                <div class="card-body">
                 <div class="col-md-2"></div>
                 <div class="col-md-10">
               <section class="content">

    &nbsp;
    {!! Form::model('barang', [
        'method' => 'post',
        'route' => 'barang.store',
    ]) !!}
     <div class="form-group row">
        <label for="name" class="col-sm-6 col-form-label">Nama Barang</label>
        <input class="form-control col-sm-6" type="text" name="nama" id="nama" />
    </div>
    <div class="form-group row">
        <label for="username" class="col-sm-6 col-form-label">Tipe/merk</label>
        <input class="form-control col-sm-6" type="text" name="tipemerek" id="tipemerek"  />
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-6 col-form-label">Satuan</label>
        <input class="form-control col-sm-6" type="text" name="satuan" id="satuan"  />
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-6 col-form-label">Harga</label>
        <input class="form-control col-sm-6" type="number" name="harga" id="harga" />
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
@endsection
