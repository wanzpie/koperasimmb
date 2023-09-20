@extends('_main_layout')

@section('content')
<div class="col-lg-12">
    <h1>Bank {!! $bank->name !!}</h1>
    <div class="col-md-12">&nbsp;</div>
    <div class="col-md-6">
        {!! Form::open(['method' => 'delete', 'route' => ['banks.destroy', $bank->id] ]) !!}
        <input type="hidden" name="ip" id="ip" />
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" value="{{ $bank->name }}" disabled="disabled" />
        </div>
        <input type="submit" value="Delete" class="btn btn-danger" />
        <a class="btn btn-success" href="{{ route('banks.index') }}">Back</a>
        {!! Form::close() !!}
    </div>
</div>
@endsection