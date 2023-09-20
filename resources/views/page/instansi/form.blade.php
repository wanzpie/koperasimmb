@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header"></div>
                          <div class="card-body  card-info">
                    <div class="row">
                        <div class="col-md-2"></div>
                      <div class="col-md-6">

    <h1>{!!  'Create Bank' !!}</h1>
    &nbsp;
      <form method="post" action="{{ route('bank.store') }}">
      @csrf
    <input type="hidden" name="ip" id="ip" />
    <div class="form-group">
        <label for="name">Name</label>
        <input class="form-control form-control-sm" type="text" name="NAME" id="name"  />
    </div>
    <div class="form-group">
        <label for="name">Location</label>
        <input class="form-control form-control-sm" type="text" name="LOCATION" id="LOCATION"  />
    </div>
    <div class="form-group">
        <label for="name">Coa No</label>
        <input class="form-control form-control-sm" type="text" name="COA_NO" id="COA_NO"  />
    </div>
    <div class="form-group">
        <label for="name">Coa Name</label>
        <input class="form-control form-control-sm" type="text"  name="COA_NAME" id="COA_NAME"  />
    </div>
                          <div class="form-group">
                              <label for="name">STATUS</label>
                          <SELECT name="status">
                              <OPTION VALUE="1">Active</OPTION>
                              <OPTION VALUE="0">Not Active</OPTION>
                          </SELECT>
                          </div>
                          <div class="form-group">
                              <label for="name">Bank Group</label>
                              <SELECT name="GROUP">
                                  <OPTION VALUE="1">MANDIRI</OPTION>
                                  <OPTION VALUE="2">BRI</OPTION>
                                  <OPTION VALUE="3">BTN</OPTION>
                                  <OPTION VALUE="4">BCA</OPTION>
                                  <OPTION VALUE="5">BNI</OPTION>
                                  <OPTION VALUE="6">UOB</OPTION>
                              </SELECT>
                          </div>

    <div class="form-group col-lg-12">
        <input type="submit" value="Save" class="btn btn-sm btn-primary" id="addTblBtn"/>
        <a class="btn btn-danger btn-sm" href="{{ route('bank.index') }}">Back</a>
    </div>
    {!! Form::close() !!}
                </div>
                    </div>
                   </div>
                        </div>
                </div>
               </div>
        </div>
</div>
    <script>
        $(document).ready(function(){

            $('#optutility_list').dataTable();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
       $('#addTblBtn').on('click',function() {
           if ($('#name').val() === '') {
               Toast.fire({
                   type: 'error',
                   title: 'Name  cannot be empty'
               })
               $('#name').focus();
               return false;
           }
           if ($('#LOCATION').val() === '') {
               Toast.fire({
                   type: 'error',
                   title: 'Fill location !'
               })
               $('#LOCATION').focus();
               return false;
           }
           if ($('#COA_NO').val() === '') {
               Toast.fire({
                   type: 'error',
                   title: 'Choose COA NO'
               })
               $('#COA_NO').focus();
               return false;
           }
           if ($('#COA_NAME').val() === '') {
               Toast.fire({
                   type: 'error',
                   title: 'Fill Coa Name'
               })
               $('#COA_NAME').focus();
               return false;
           }
       });


        });


    </script>
@endsection
